<?php

use App\Livewire\Admin\UserDetail;
use App\Models\Company;
use App\Models\Talk;
use App\Models\User;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('guests cannot access user detail page', function () {
    $user = User::factory()->create();

    $this->get('/admin/users/'.$user->id)
        ->assertRedirect(route('login'));
});

test('non-admin cannot access user detail page', function () {
    $actor = User::factory()->create();
    $target = User::factory()->create();

    $this->actingAs($actor)
        ->get('/admin/users/'.$target->id)
        ->assertForbidden();
});

test('admin can access user detail page', function () {
    $admin = User::factory()->admin()->create();
    $target = User::factory()->create();

    $this->actingAs($admin)
        ->get('/admin/users/'.$target->id)
        ->assertSuccessful()
        ->assertSeeLivewire(UserDetail::class);
});

test('detail page shows user profile info', function () {
    $admin = User::factory()->admin()->create();
    $target = User::factory()->create([
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
        'city' => 'Stockholm',
    ]);

    Livewire::actingAs($admin)
        ->test(UserDetail::class, ['user' => $target])
        ->assertSee('Jane Doe')
        ->assertSee('jane@example.com')
        ->assertSee('Stockholm');
});

test('detail page shows submitted talks', function () {
    $admin = User::factory()->admin()->create();
    $target = User::factory()->create();
    Talk::factory()->create(['user_id' => $target->id, 'title' => 'My Great Talk']);

    Livewire::actingAs($admin)
        ->test(UserDetail::class, ['user' => $target])
        ->assertSee('My Great Talk');
});

test('detail page shows submitted companies', function () {
    $admin = User::factory()->admin()->create();
    $target = User::factory()->create();
    Company::factory()->create(['user_id' => $target->id, 'name' => 'Acme Corp']);

    Livewire::actingAs($admin)
        ->test(UserDetail::class, ['user' => $target])
        ->assertSee('Acme Corp');
});

test('admin can promote user to admin from detail page', function () {
    $admin = User::factory()->admin()->create();
    $target = User::factory()->create();

    Livewire::actingAs($admin)
        ->test(UserDetail::class, ['user' => $target])
        ->call('promoteToAdmin');

    expect($target->fresh()->isAdmin())->toBeTrue();
});

test('admin can demote another admin from detail page', function () {
    $admin = User::factory()->admin()->create();
    $target = User::factory()->admin()->create();

    Livewire::actingAs($admin)
        ->test(UserDetail::class, ['user' => $target])
        ->call('demoteFromAdmin');

    expect($target->fresh()->isAdmin())->toBeFalse();
});

test('admin cannot demote themselves from detail page', function () {
    $admin = User::factory()->admin()->create();

    Livewire::actingAs($admin)
        ->test(UserDetail::class, ['user' => $admin])
        ->call('demoteFromAdmin');

    expect($admin->fresh()->isAdmin())->toBeTrue();
});

test('non-admin cannot promote via detail page directly', function () {
    $user = User::factory()->create();
    $target = User::factory()->create();

    Livewire::actingAs($user)
        ->test(UserDetail::class, ['user' => $target])
        ->call('promoteToAdmin')
        ->assertForbidden();
});
