<?php

use App\Livewire\Admin\CompanyList;
use App\Livewire\Admin\EventList;
use App\Livewire\Admin\JobList;
use App\Livewire\Admin\TalkList;
use App\Livewire\Admin\UserList;
use App\Models\Company;
use App\Models\Event;
use App\Models\JobListing;
use App\Models\Talk;
use App\Models\User;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('admin lists paginate with the terminal midnight theme', function (string $component, callable $seed) {
    $admin = User::factory()->admin()->create();
    $seed();

    Livewire::actingAs($admin)
        ->test($component)
        ->assertSee('tm-pagination', escape: false)
        ->assertSee('next &raquo;', escape: false)
        ->assertDontSee('Showing', escape: false);
})->with([
    'companies' => [CompanyList::class, fn () => Company::factory()->count(30)->create()],
    'users' => [UserList::class, fn () => User::factory()->count(30)->create()],
    'events' => [EventList::class, fn () => Event::factory()->count(30)->create()],
    'talks' => [TalkList::class, fn () => Talk::factory()->count(30)->create()],
    'jobs' => [JobList::class, fn () => JobListing::factory()->count(30)->create()],
]);
