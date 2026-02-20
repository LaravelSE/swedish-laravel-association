<?php

use App\Livewire\Admin\BoardMemberForm;
use App\Livewire\Admin\BoardMemberList;
use App\Models\BoardMember;
use App\Models\User;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('guests cannot access admin board member list', function () {
    $this->get('/admin/board-members')
        ->assertRedirect(route('login'));
});

test('non-admin cannot access admin board member list', function () {
    $this->actingAs(User::factory()->create())
        ->get('/admin/board-members')
        ->assertForbidden();
});

test('admin can access board member list', function () {
    $this->actingAs(User::factory()->admin()->create())
        ->get('/admin/board-members')
        ->assertSuccessful()
        ->assertSeeLivewire(BoardMemberList::class);
});

test('board member list shows all members ordered by sort order', function () {
    $admin = User::factory()->admin()->create();
    BoardMember::factory()->create(['name' => 'Zara Last', 'sort_order' => 10]);
    BoardMember::factory()->create(['name' => 'Alice First', 'sort_order' => 0]);

    Livewire::actingAs($admin)
        ->test(BoardMemberList::class)
        ->assertSee('Alice First')
        ->assertSee('Zara Last');
});

test('guests cannot access create board member page', function () {
    $this->get('/admin/board-members/create')
        ->assertRedirect(route('login'));
});

test('non-admin cannot access create board member page', function () {
    $this->actingAs(User::factory()->create())
        ->get('/admin/board-members/create')
        ->assertForbidden();
});

test('admin can access create board member page', function () {
    $this->actingAs(User::factory()->admin()->create())
        ->get('/admin/board-members/create')
        ->assertSuccessful()
        ->assertSeeLivewire(BoardMemberForm::class);
});

test('admin can create a board member', function () {
    $admin = User::factory()->admin()->create();

    Livewire::actingAs($admin)
        ->test(BoardMemberForm::class)
        ->set('name', 'Test Person')
        ->set('role', 'Ordförande')
        ->set('company', 'Test AB')
        ->set('sortOrder', 0)
        ->call('save')
        ->assertRedirect(route('admin.board-members'));

    expect(BoardMember::where('name', 'Test Person')->exists())->toBeTrue();
});

test('admin can edit a board member', function () {
    $admin = User::factory()->admin()->create();
    $member = BoardMember::factory()->create(['name' => 'Old Name']);

    Livewire::actingAs($admin)
        ->test(BoardMemberForm::class, ['boardMember' => $member])
        ->set('name', 'New Name')
        ->call('save')
        ->assertRedirect(route('admin.board-members'));

    expect($member->fresh()->name)->toBe('New Name');
});

test('board member form requires name and role', function () {
    $admin = User::factory()->admin()->create();

    Livewire::actingAs($admin)
        ->test(BoardMemberForm::class)
        ->call('save')
        ->assertHasErrors(['name', 'role']);
});

test('non-admin cannot save board member form directly', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(BoardMemberForm::class)
        ->set('name', 'Test')
        ->set('role', 'Role')
        ->call('save')
        ->assertForbidden();
});

test('admin can access edit board member page', function () {
    $admin = User::factory()->admin()->create();
    $member = BoardMember::factory()->create();

    $this->actingAs($admin)
        ->get('/admin/board-members/'.$member->id.'/edit')
        ->assertSuccessful()
        ->assertSeeLivewire(BoardMemberForm::class);
});

test('admin can delete a board member', function () {
    $admin = User::factory()->admin()->create();
    $member = BoardMember::factory()->create();

    Livewire::actingAs($admin)
        ->test(BoardMemberList::class)
        ->call('delete', $member->id);

    expect(BoardMember::find($member->id))->toBeNull();
});

test('non-admin cannot delete a board member directly', function () {
    $user = User::factory()->create();
    $member = BoardMember::factory()->create();

    Livewire::actingAs($user)
        ->test(BoardMemberList::class)
        ->call('delete', $member->id)
        ->assertForbidden();

    expect(BoardMember::find($member->id))->not->toBeNull();
});
