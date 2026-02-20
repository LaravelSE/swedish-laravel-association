<?php

use App\Livewire\Admin\Dashboard;
use App\Models\Company;
use App\Models\User;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('guests cannot access admin dashboard', function () {
    $this->get('/admin/dashboard')
        ->assertRedirect(route('login'));
});

test('non-admin users cannot access admin dashboard', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/admin/dashboard')
        ->assertForbidden();
});

test('admin can access dashboard', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get('/admin/dashboard')
        ->assertSuccessful()
        ->assertSeeLivewire(Dashboard::class);
});

test('dashboard shows correct company counts', function () {
    $admin = User::factory()->admin()->create();
    Company::factory()->count(3)->create();
    Company::factory()->count(2)->approved()->create();
    Company::factory()->count(1)->rejected()->create();

    Livewire::actingAs($admin)
        ->test(Dashboard::class)
        ->assertSee('3')
        ->assertSee('2')
        ->assertSee('1');
});

test('dashboard shows pending companies in needs review list', function () {
    $admin = User::factory()->admin()->create();
    $pending = Company::factory()->create(['name' => 'Pending Corp']);
    Company::factory()->approved()->create(['name' => 'Approved Corp']);

    Livewire::actingAs($admin)
        ->test(Dashboard::class)
        ->assertSee('Pending Corp')
        ->assertDontSee('Approved Corp');
});

test('dashboard does not show needs review section when no pending companies', function () {
    $admin = User::factory()->admin()->create();
    Company::factory()->approved()->create(['name' => 'Approved Corp']);

    Livewire::actingAs($admin)
        ->test(Dashboard::class)
        ->assertDontSee('Needs review');
});
