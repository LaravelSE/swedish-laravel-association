<?php

use App\Livewire\Admin\CompanyList;
use App\Livewire\Admin\CompanyReview;
use App\Models\Company;
use App\Models\User;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('non-admin users cannot access admin company list', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/admin/companies')
        ->assertForbidden();
});

test('guests cannot access admin company list', function () {
    $this->get('/admin/companies')
        ->assertRedirect(route('login'));
});

test('admin can access company list', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get('/admin/companies')
        ->assertSuccessful()
        ->assertSeeLivewire(CompanyList::class);
});

test('admin can see all companies in the list', function () {
    $admin = User::factory()->admin()->create();
    $pending = Company::factory()->create(['name' => 'Pending Corp']);
    $approved = Company::factory()->approved()->create(['name' => 'Approved Corp']);

    Livewire::actingAs($admin)
        ->test(CompanyList::class)
        ->assertSee('Pending Corp')
        ->assertSee('Approved Corp');
});

test('admin can filter companies by status', function () {
    $admin = User::factory()->admin()->create();
    Company::factory()->create(['name' => 'Pending Corp']);
    Company::factory()->approved()->create(['name' => 'Approved Corp']);

    Livewire::actingAs($admin)
        ->test(CompanyList::class)
        ->set('statusFilter', 'approved')
        ->assertSee('Approved Corp')
        ->assertDontSee('Pending Corp');
});

test('non-admin users cannot access company review', function () {
    $user = User::factory()->create();
    $company = Company::factory()->create();

    $this->actingAs($user)
        ->get('/admin/companies/'.$company->id)
        ->assertForbidden();
});

test('admin can access company review page', function () {
    $admin = User::factory()->admin()->create();
    $company = Company::factory()->create(['name' => 'Review Me Corp']);

    $this->actingAs($admin)
        ->get('/admin/companies/'.$company->id)
        ->assertSuccessful()
        ->assertSeeLivewire(CompanyReview::class);
});

test('admin can approve a company', function () {
    $admin = User::factory()->admin()->create();
    $company = Company::factory()->create();

    Livewire::actingAs($admin)
        ->test(CompanyReview::class, ['company' => $company])
        ->set('adminNotes', 'Looks good!')
        ->call('approve')
        ->assertRedirect(route('admin.companies'));

    $company->refresh();
    expect($company->status)->toBe('approved');
    expect($company->admin_notes)->toBe('Looks good!');
});

test('admin can reject a company', function () {
    $admin = User::factory()->admin()->create();
    $company = Company::factory()->create();

    Livewire::actingAs($admin)
        ->test(CompanyReview::class, ['company' => $company])
        ->set('adminNotes', 'Not relevant')
        ->call('reject')
        ->assertRedirect(route('admin.companies'));

    $company->refresh();
    expect($company->status)->toBe('rejected');
    expect($company->admin_notes)->toBe('Not relevant');
});

test('non-admin cannot approve company directly', function () {
    $user = User::factory()->create();
    $company = Company::factory()->create();

    Livewire::actingAs($user)
        ->test(CompanyReview::class, ['company' => $company])
        ->call('approve')
        ->assertForbidden();

    expect($company->fresh()->status)->toBe('pending');
});

test('non-admin cannot reject company directly', function () {
    $user = User::factory()->create();
    $company = Company::factory()->create();

    Livewire::actingAs($user)
        ->test(CompanyReview::class, ['company' => $company])
        ->call('reject')
        ->assertForbidden();

    expect($company->fresh()->status)->toBe('pending');
});

test('status is not mass assignable on company model', function () {
    $company = Company::factory()->create();

    $company->fill(['status' => 'approved']);

    expect($company->status)->toBe('pending');
});
