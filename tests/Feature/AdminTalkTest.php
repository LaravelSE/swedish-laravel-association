<?php

use App\Livewire\Admin\TalkList;
use App\Livewire\Admin\TalkReview;
use App\Models\Talk;
use App\Models\User;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('guests cannot access admin talk list', function () {
    $this->get('/admin/talks')
        ->assertRedirect(route('login'));
});

test('non-admin users cannot access admin talk list', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/admin/talks')
        ->assertForbidden();
});

test('admin can access talk list', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get('/admin/talks')
        ->assertSuccessful()
        ->assertSeeLivewire(TalkList::class);
});

test('admin can see all talks in the list', function () {
    $admin = User::factory()->admin()->create();
    Talk::factory()->create(['title' => 'Pending Talk']);
    Talk::factory()->interested()->create(['title' => 'Interested Talk']);

    Livewire::actingAs($admin)
        ->test(TalkList::class)
        ->assertSee('Pending Talk')
        ->assertSee('Interested Talk');
});

test('admin can filter talks by status', function () {
    $admin = User::factory()->admin()->create();
    Talk::factory()->create(['title' => 'Pending Talk']);
    Talk::factory()->interested()->create(['title' => 'Interested Talk']);

    Livewire::actingAs($admin)
        ->test(TalkList::class)
        ->set('statusFilter', 'interested')
        ->assertSee('Interested Talk')
        ->assertDontSee('Pending Talk');
});

test('guests cannot access admin talk review', function () {
    $talk = Talk::factory()->create();

    $this->get('/admin/talks/'.$talk->id)
        ->assertRedirect(route('login'));
});

test('non-admin users cannot access talk review', function () {
    $user = User::factory()->create();
    $talk = Talk::factory()->create();

    $this->actingAs($user)
        ->get('/admin/talks/'.$talk->id)
        ->assertForbidden();
});

test('admin can access talk review page', function () {
    $admin = User::factory()->admin()->create();
    $talk = Talk::factory()->create(['title' => 'Review This Talk']);

    $this->actingAs($admin)
        ->get('/admin/talks/'.$talk->id)
        ->assertSuccessful()
        ->assertSeeLivewire(TalkReview::class);
});

test('admin can mark talk as interested', function () {
    $admin = User::factory()->admin()->create();
    $talk = Talk::factory()->create();

    Livewire::actingAs($admin)
        ->test(TalkReview::class, ['talk' => $talk])
        ->set('adminNotes', 'Looks promising!')
        ->call('markInterested')
        ->assertRedirect(route('admin.talks'));

    $talk->refresh();
    expect($talk->status)->toBe('interested');
    expect($talk->admin_notes)->toBe('Looks promising!');
});

test('admin can schedule a talk', function () {
    $admin = User::factory()->admin()->create();
    $talk = Talk::factory()->interested()->create();

    Livewire::actingAs($admin)
        ->test(TalkReview::class, ['talk' => $talk])
        ->call('schedule')
        ->assertRedirect(route('admin.talks'));

    expect($talk->fresh()->status)->toBe('scheduled');
});

test('admin can mark talk as done', function () {
    $admin = User::factory()->admin()->create();
    $talk = Talk::factory()->scheduled()->create();

    Livewire::actingAs($admin)
        ->test(TalkReview::class, ['talk' => $talk])
        ->call('markDone')
        ->assertRedirect(route('admin.talks'));

    expect($talk->fresh()->status)->toBe('done');
});

test('admin can reject a talk', function () {
    $admin = User::factory()->admin()->create();
    $talk = Talk::factory()->create();

    Livewire::actingAs($admin)
        ->test(TalkReview::class, ['talk' => $talk])
        ->set('adminNotes', 'Not a fit right now.')
        ->call('reject')
        ->assertRedirect(route('admin.talks'));

    $talk->refresh();
    expect($talk->status)->toBe('rejected');
    expect($talk->admin_notes)->toBe('Not a fit right now.');
});

test('admin can save notes without changing status', function () {
    $admin = User::factory()->admin()->create();
    $talk = Talk::factory()->create();

    Livewire::actingAs($admin)
        ->test(TalkReview::class, ['talk' => $talk])
        ->set('adminNotes', 'Follow up in March.')
        ->call('saveNotes');

    $talk->refresh();
    expect($talk->status)->toBe('pending');
    expect($talk->admin_notes)->toBe('Follow up in March.');
});

test('non-admin cannot call talk actions directly', function () {
    $user = User::factory()->create();
    $talk = Talk::factory()->create();

    Livewire::actingAs($user)
        ->test(TalkReview::class, ['talk' => $talk])
        ->call('markInterested')
        ->assertForbidden();
});

test('status is not mass assignable on talk model', function () {
    $talk = Talk::factory()->create(['title' => 'Test Talk']);

    $talk->fill(['status' => 'scheduled']);

    expect($talk->status)->toBe('pending');
});
