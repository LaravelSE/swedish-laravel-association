<?php

use App\Livewire\Admin\EventForm;
use App\Livewire\Admin\EventList;
use App\Models\Event;
use App\Models\User;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('guests cannot access admin event list', function () {
    $this->get('/admin/events')
        ->assertRedirect(route('login'));
});

test('non-admin cannot access admin event list', function () {
    $this->actingAs(User::factory()->create())
        ->get('/admin/events')
        ->assertForbidden();
});

test('admin can access event list', function () {
    $this->actingAs(User::factory()->admin()->create())
        ->get('/admin/events')
        ->assertSuccessful()
        ->assertSeeLivewire(EventList::class);
});

test('event list shows upcoming events by default', function () {
    $admin = User::factory()->admin()->create();
    Event::factory()->upcoming()->create(['title' => 'Future Event']);
    Event::factory()->past()->create(['title' => 'Past Event']);

    Livewire::actingAs($admin)
        ->test(EventList::class)
        ->assertSee('Future Event')
        ->assertDontSee('Past Event');
});

test('event list can filter to past events', function () {
    $admin = User::factory()->admin()->create();
    Event::factory()->upcoming()->create(['title' => 'Future Event']);
    Event::factory()->past()->create(['title' => 'Past Event']);

    Livewire::actingAs($admin)
        ->test(EventList::class)
        ->set('timeFilter', 'past')
        ->assertSee('Past Event')
        ->assertDontSee('Future Event');
});

test('guests cannot access create event page', function () {
    $this->get('/admin/events/create')
        ->assertRedirect(route('login'));
});

test('non-admin cannot access create event page', function () {
    $this->actingAs(User::factory()->create())
        ->get('/admin/events/create')
        ->assertForbidden();
});

test('admin can access create event page', function () {
    $this->actingAs(User::factory()->admin()->create())
        ->get('/admin/events/create')
        ->assertSuccessful()
        ->assertSeeLivewire(EventForm::class);
});

test('admin can create an event', function () {
    $admin = User::factory()->admin()->create();

    Livewire::actingAs($admin)
        ->test(EventForm::class)
        ->set('title', 'Laravel Meetup Gothenburg')
        ->set('datetimeInput', '2026-06-01T18:00')
        ->set('location', 'Some Venue, Gothenburg')
        ->set('description', 'A great meetup.')
        ->set('schedule', [['time' => '18:00', 'activity' => 'Doors open']])
        ->call('save')
        ->assertRedirect(route('admin.events'));

    expect(Event::where('title', 'Laravel Meetup Gothenburg')->exists())->toBeTrue();
});

test('admin can edit an event', function () {
    $admin = User::factory()->admin()->create();
    $event = Event::factory()->create(['title' => 'Old Title']);

    Livewire::actingAs($admin)
        ->test(EventForm::class, ['event' => $event])
        ->set('title', 'New Title')
        ->call('save')
        ->assertRedirect(route('admin.events'));

    expect($event->fresh()->title)->toBe('New Title');
});

test('event form requires title, datetime, location and description', function () {
    $admin = User::factory()->admin()->create();

    Livewire::actingAs($admin)
        ->test(EventForm::class)
        ->call('save')
        ->assertHasErrors(['title', 'datetimeInput', 'location', 'description']);
});

test('non-admin cannot save event form directly', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(EventForm::class)
        ->call('save')
        ->assertForbidden();
});

test('admin can access edit event page', function () {
    $admin = User::factory()->admin()->create();
    $event = Event::factory()->create();

    $this->actingAs($admin)
        ->get('/admin/events/'.$event->id.'/edit')
        ->assertSuccessful()
        ->assertSeeLivewire(EventForm::class);
});
