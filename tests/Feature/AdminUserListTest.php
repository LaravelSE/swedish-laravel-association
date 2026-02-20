<?php

use App\Livewire\Admin\UserList;
use App\Models\User;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('guests cannot access admin user list', function () {
    $this->get('/admin/users')
        ->assertRedirect(route('login'));
});

test('non-admin users cannot access admin user list', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/admin/users')
        ->assertForbidden();
});

test('admin can access user list', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get('/admin/users')
        ->assertSuccessful()
        ->assertSeeLivewire(UserList::class);
});

test('admin can see all users', function () {
    $admin = User::factory()->admin()->create(['name' => 'Admin User']);
    User::factory()->create(['name' => 'Regular User']);

    Livewire::actingAs($admin)
        ->test(UserList::class)
        ->assertSee('Admin User')
        ->assertSee('Regular User');
});

test('admin can filter users by admin role', function () {
    $admin = User::factory()->admin()->create(['name' => 'Admin User']);
    User::factory()->create(['name' => 'Regular User']);

    Livewire::actingAs($admin)
        ->test(UserList::class)
        ->set('roleFilter', 'admin')
        ->assertSee('Admin User')
        ->assertDontSee('Regular User');
});

test('admin can filter users by regular role', function () {
    $admin = User::factory()->admin()->create(['name' => 'Admin User']);
    User::factory()->create(['name' => 'Regular User']);

    Livewire::actingAs($admin)
        ->test(UserList::class)
        ->set('roleFilter', 'regular')
        ->assertSee('Regular User')
        ->assertDontSee('Admin User');
});

test('admin can promote a user to admin', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create();

    Livewire::actingAs($admin)
        ->test(UserList::class)
        ->call('promoteToAdmin', $user)
        ->assertHasNoErrors();

    expect($user->fresh()->isAdmin())->toBeTrue();
});

test('admin can demote another admin', function () {
    $admin = User::factory()->admin()->create();
    $otherAdmin = User::factory()->admin()->create();

    Livewire::actingAs($admin)
        ->test(UserList::class)
        ->call('demoteFromAdmin', $otherAdmin)
        ->assertHasNoErrors();

    expect($otherAdmin->fresh()->isAdmin())->toBeFalse();
});

test('admin cannot demote themselves', function () {
    $admin = User::factory()->admin()->create();

    Livewire::actingAs($admin)
        ->test(UserList::class)
        ->call('demoteFromAdmin', $admin);

    expect($admin->fresh()->isAdmin())->toBeTrue();
});

test('non-admin cannot call promote action directly', function () {
    $user = User::factory()->create();
    $target = User::factory()->create();

    Livewire::actingAs($user)
        ->test(UserList::class)
        ->call('promoteToAdmin', $target)
        ->assertForbidden();
});

test('non-admin cannot call demote action directly', function () {
    $user = User::factory()->create();
    $admin = User::factory()->admin()->create();

    Livewire::actingAs($user)
        ->test(UserList::class)
        ->call('demoteFromAdmin', $admin)
        ->assertForbidden();
});
