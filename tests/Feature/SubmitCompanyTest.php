<?php

use App\Livewire\SubmitCompany;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('submit company page can be rendered', function () {
    $response = $this->get('/submit-company');

    $response->assertStatus(200);
    $response->assertSeeLivewire(SubmitCompany::class);
});

test('guest users see registration fields', function () {
    Livewire::test(SubmitCompany::class)
        ->assertSee('create-account')
        ->assertSee('name')
        ->assertSee('email')
        ->assertSee('password');
});

test('logged in users do not see registration fields', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubmitCompany::class)
        ->assertDontSee('create-account')
        ->assertSee('submitting-as');
});

test('guest user can submit company and create account', function () {
    Livewire::test(SubmitCompany::class)
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('userPhone', '+46701234567')
        ->set('password', 'password123')
        ->set('password_confirmation', 'password123')
        ->set('companyName', 'Laravel AB')
        ->set('city', 'Stockholm')
        ->set('website', 'https://laravel.se')
        ->set('industry', 'SaaS')
        ->set('size', '11-50')
        ->set('submitterRelationship', 'I work there')
        ->call('submit')
        ->assertSet('submitted', true);

    $this->assertDatabaseHas('users', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'phone' => '+46701234567',
    ]);

    $this->assertDatabaseHas('companies', [
        'name' => 'Laravel AB',
        'city' => 'Stockholm',
        'website' => 'https://laravel.se',
        'industry' => 'SaaS',
        'size' => '11-50',
        'status' => 'pending',
        'submitter_relationship' => 'I work there',
    ]);
});

test('logged in user can submit company', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubmitCompany::class)
        ->set('companyName', 'Tech Corp AB')
        ->set('city', 'Gothenburg')
        ->set('submitterRelationship', 'Public information')
        ->call('submit')
        ->assertSet('submitted', true);

    $this->assertDatabaseHas('companies', [
        'user_id' => $user->id,
        'name' => 'Tech Corp AB',
        'city' => 'Gothenburg',
        'status' => 'pending',
        'submitter_relationship' => 'Public information',
    ]);
});

test('company name is required', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubmitCompany::class)
        ->set('city', 'Stockholm')
        ->set('submitterRelationship', 'I work there')
        ->call('submit')
        ->assertHasErrors(['companyName' => 'required']);
});

test('city is required', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubmitCompany::class)
        ->set('companyName', 'Test Company')
        ->set('submitterRelationship', 'I work there')
        ->call('submit')
        ->assertHasErrors(['city' => 'required']);
});

test('submitter relationship is required', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubmitCompany::class)
        ->set('companyName', 'Test Company')
        ->set('city', 'Stockholm')
        ->call('submit')
        ->assertHasErrors(['submitterRelationship' => 'required']);
});

test('submitter relationship must be valid', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubmitCompany::class)
        ->set('companyName', 'Test Company')
        ->set('city', 'Stockholm')
        ->set('submitterRelationship', 'Invalid option')
        ->call('submit')
        ->assertHasErrors(['submitterRelationship' => 'in']);
});

test('website must be a valid url', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubmitCompany::class)
        ->set('companyName', 'Test Company')
        ->set('city', 'Stockholm')
        ->set('submitterRelationship', 'I work there')
        ->set('website', 'not-a-url')
        ->call('submit')
        ->assertHasErrors(['website' => 'url']);
});

test('social urls must be valid urls', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubmitCompany::class)
        ->set('companyName', 'Test Company')
        ->set('city', 'Stockholm')
        ->set('submitterRelationship', 'I work there')
        ->set('linkedin', 'not-a-url')
        ->call('submit')
        ->assertHasErrors(['linkedin' => 'url']);
});

test('size must be a valid option', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubmitCompany::class)
        ->set('companyName', 'Test Company')
        ->set('city', 'Stockholm')
        ->set('submitterRelationship', 'I work there')
        ->set('size', 'invalid-size')
        ->call('submit')
        ->assertHasErrors(['size' => 'in']);
});

test('guest user must provide name and email', function () {
    Livewire::test(SubmitCompany::class)
        ->set('companyName', 'Test Company')
        ->set('city', 'Stockholm')
        ->set('submitterRelationship', 'I work there')
        ->set('password', 'password123')
        ->set('password_confirmation', 'password123')
        ->call('submit')
        ->assertHasErrors(['name' => 'required', 'email' => 'required']);
});

test('guest user must confirm password', function () {
    Livewire::test(SubmitCompany::class)
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('password', 'password123')
        ->set('password_confirmation', 'different')
        ->set('companyName', 'Test Company')
        ->set('city', 'Stockholm')
        ->set('submitterRelationship', 'I work there')
        ->call('submit')
        ->assertHasErrors(['password' => 'confirmed']);
});

test('email must be unique when registering through company submission', function () {
    User::factory()->create(['email' => 'existing@example.com']);

    Livewire::test(SubmitCompany::class)
        ->set('name', 'Test User')
        ->set('email', 'existing@example.com')
        ->set('password', 'password123')
        ->set('password_confirmation', 'password123')
        ->set('companyName', 'Test Company')
        ->set('city', 'Stockholm')
        ->set('submitterRelationship', 'I work there')
        ->call('submit')
        ->assertHasErrors(['email' => 'unique']);
});

test('company is created with pending status by default', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubmitCompany::class)
        ->set('companyName', 'Pending Corp')
        ->set('city', 'Malmö')
        ->set('submitterRelationship', 'I know someone')
        ->call('submit');

    $company = Company::where('name', 'Pending Corp')->first();
    expect($company->status)->toBe('pending');
});

test('logo can be uploaded with company submission', function () {
    Storage::fake('public');
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubmitCompany::class)
        ->set('companyName', 'Logo Corp')
        ->set('city', 'Stockholm')
        ->set('submitterRelationship', 'I work there')
        ->set('logo', UploadedFile::fake()->image('logo.png', 200, 200))
        ->call('submit')
        ->assertSet('submitted', true);

    $company = Company::where('name', 'Logo Corp')->first();
    expect($company->logo_path)->not->toBeNull();
    Storage::disk('public')->assertExists($company->logo_path);
});

test('company model has user relationship', function () {
    $user = User::factory()->create();
    $company = Company::factory()->create(['user_id' => $user->id]);

    expect($company->user)->toBeInstanceOf(User::class);
    expect($company->user->id)->toBe($user->id);
});

test('optional fields can be left empty', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubmitCompany::class)
        ->set('companyName', 'Minimal Corp')
        ->set('city', 'Stockholm')
        ->set('submitterRelationship', 'Public information')
        ->call('submit')
        ->assertSet('submitted', true);

    $company = Company::where('name', 'Minimal Corp')->first();
    expect($company->website)->toBeNull();
    expect($company->industry)->toBeNull();
    expect($company->size)->toBeNull();
    expect($company->description)->toBeNull();
});
