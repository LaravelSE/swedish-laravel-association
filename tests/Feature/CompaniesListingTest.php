<?php

use App\Livewire\CompaniesListing;
use App\Models\Company;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('companies listing page can be rendered', function () {
    $response = $this->get('/companies');

    $response->assertStatus(200);
    $response->assertSeeLivewire(CompaniesListing::class);
});

test('only approved companies are shown in listing', function () {
    Company::factory()->approved()->create(['name' => 'Approved Corp']);
    Company::factory()->create(['name' => 'Pending Corp']);
    Company::factory()->rejected()->create(['name' => 'Rejected Corp']);

    Livewire::test(CompaniesListing::class)
        ->assertSee('Approved Corp')
        ->assertDontSee('Pending Corp')
        ->assertDontSee('Rejected Corp');
});

test('companies can be filtered by city', function () {
    Company::factory()->approved()->create(['name' => 'Stockholm Corp', 'city' => 'Stockholm']);
    Company::factory()->approved()->create(['name' => 'Gothenburg Corp', 'city' => 'Gothenburg']);

    Livewire::test(CompaniesListing::class)
        ->set('cityFilter', 'Stockholm')
        ->assertSee('Stockholm Corp')
        ->assertDontSee('Gothenburg Corp');
});

test('empty state is shown when no companies match filter', function () {
    Company::factory()->approved()->create(['city' => 'Stockholm']);

    Livewire::test(CompaniesListing::class)
        ->set('cityFilter', 'Gothenburg')
        ->assertSee('No companies found');
});

test('submit company link is shown on listing page', function () {
    Livewire::test(CompaniesListing::class)
        ->assertSee('Submit it!');
});
