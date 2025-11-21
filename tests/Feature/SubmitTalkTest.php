<?php

use App\Livewire\SubmitTalk;
use App\Models\Talk;
use App\Models\User;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('submit talk page can be rendered', function () {
    $response = $this->get('/submit-talk');

    $response->assertStatus(200);
    $response->assertSeeLivewire(SubmitTalk::class);
});

test('guest users see registration fields', function () {
    Livewire::test(SubmitTalk::class)
        ->assertSee('Create Account')
        ->assertSee('Name')
        ->assertSee('Email')
        ->assertSee('Password');
});

test('logged in users do not see registration fields', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubmitTalk::class)
        ->assertDontSee('Create Account')
        ->assertSee('Submitting as');
});

test('guest user can submit talk and create account', function () {
    Livewire::test(SubmitTalk::class)
        ->set('name', 'Test Speaker')
        ->set('email', 'speaker@example.com')
        ->set('phone', '+46701234567')
        ->set('password', 'password123')
        ->set('password_confirmation', 'password123')
        ->set('title', 'Building Scalable APIs with Laravel')
        ->set('description', 'In this talk, we will explore how to build scalable APIs with Laravel, covering topics like rate limiting, caching, and optimization strategies.')
        ->set('cities', ['Stockholm', 'Malmö'])
        ->set('position', 'Senior Developer')
        ->set('company', 'Tech Corp')
        ->set('twitter', 'https://twitter.com/testuser')
        ->set('github', 'https://github.com/testuser')
        ->call('submit')
        ->assertSet('submitted', true);

    // Check user was created
    $this->assertDatabaseHas('users', [
        'name' => 'Test Speaker',
        'email' => 'speaker@example.com',
        'phone' => '+46701234567',
    ]);

    // Check talk was created
    $this->assertDatabaseHas('talks', [
        'title' => 'Building Scalable APIs with Laravel',
        'position' => 'Senior Developer',
        'company' => 'Tech Corp',
        'twitter' => 'https://twitter.com/testuser',
        'github' => 'https://github.com/testuser',
    ]);

    // Check cities are stored correctly
    $talk = Talk::first();
    expect($talk->cities)->toBe(['Stockholm', 'Malmö']);
});

test('logged in user can submit talk', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubmitTalk::class)
        ->set('title', 'Laravel Performance Tips')
        ->set('description', 'Learn the best practices for optimizing Laravel applications, including database queries, caching strategies, and queue handling.')
        ->set('cities', ['Gothenburg'])
        ->set('position', 'Lead Developer')
        ->call('submit')
        ->assertSet('submitted', true);

    $this->assertDatabaseHas('talks', [
        'user_id' => $user->id,
        'title' => 'Laravel Performance Tips',
        'position' => 'Lead Developer',
    ]);

    $talk = Talk::first();
    expect($talk->cities)->toBe(['Gothenburg']);
});

test('title is required', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubmitTalk::class)
        ->set('description', 'A description that is long enough to pass validation requirements for the form.')
        ->set('cities', ['Stockholm'])
        ->set('position', 'Developer')
        ->call('submit')
        ->assertHasErrors(['title' => 'required']);
});

test('description is required', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubmitTalk::class)
        ->set('title', 'My Talk')
        ->set('cities', ['Stockholm'])
        ->set('position', 'Developer')
        ->call('submit')
        ->assertHasErrors(['description' => 'required']);
});

test('description must be at least 50 characters', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubmitTalk::class)
        ->set('title', 'My Talk')
        ->set('description', 'Too short')
        ->set('cities', ['Stockholm'])
        ->set('position', 'Developer')
        ->call('submit')
        ->assertHasErrors(['description' => 'min']);
});

test('at least one city must be selected', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubmitTalk::class)
        ->set('title', 'My Talk')
        ->set('description', 'A description that is long enough to pass validation requirements for the form.')
        ->set('cities', [])
        ->set('position', 'Developer')
        ->call('submit')
        ->assertHasErrors(['cities']);
});

test('position is required', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubmitTalk::class)
        ->set('title', 'My Talk')
        ->set('description', 'A description that is long enough to pass validation requirements for the form.')
        ->set('cities', ['Stockholm'])
        ->call('submit')
        ->assertHasErrors(['position' => 'required']);
});

test('guest user must provide name and email', function () {
    Livewire::test(SubmitTalk::class)
        ->set('title', 'My Talk')
        ->set('description', 'A description that is long enough to pass validation requirements for the form.')
        ->set('cities', ['Stockholm'])
        ->set('position', 'Developer')
        ->set('password', 'password123')
        ->set('password_confirmation', 'password123')
        ->call('submit')
        ->assertHasErrors(['name' => 'required', 'email' => 'required']);
});

test('guest user must confirm password', function () {
    Livewire::test(SubmitTalk::class)
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('password', 'password123')
        ->set('password_confirmation', 'different')
        ->set('title', 'My Talk')
        ->set('description', 'A description that is long enough to pass validation requirements for the form.')
        ->set('cities', ['Stockholm'])
        ->set('position', 'Developer')
        ->call('submit')
        ->assertHasErrors(['password' => 'confirmed']);
});

test('social urls must be valid urls', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubmitTalk::class)
        ->set('title', 'My Talk')
        ->set('description', 'A description that is long enough to pass validation requirements for the form.')
        ->set('cities', ['Stockholm'])
        ->set('position', 'Developer')
        ->set('twitter', 'not-a-url')
        ->call('submit')
        ->assertHasErrors(['twitter' => 'url']);
});

test('only valid cities can be selected', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(SubmitTalk::class)
        ->set('title', 'My Talk')
        ->set('description', 'A description that is long enough to pass validation requirements for the form.')
        ->set('cities', ['InvalidCity'])
        ->set('position', 'Developer')
        ->call('submit')
        ->assertHasErrors(['cities.0']);
});

test('email must be unique when registering through talk submission', function () {
    User::factory()->create(['email' => 'existing@example.com']);

    Livewire::test(SubmitTalk::class)
        ->set('name', 'Test User')
        ->set('email', 'existing@example.com')
        ->set('password', 'password123')
        ->set('password_confirmation', 'password123')
        ->set('title', 'My Talk')
        ->set('description', 'A description that is long enough to pass validation requirements for the form.')
        ->set('cities', ['Stockholm'])
        ->set('position', 'Developer')
        ->call('submit')
        ->assertHasErrors(['email' => 'unique']);
});

test('talk model has user relationship', function () {
    $user = User::factory()->create();
    $talk = Talk::factory()->create(['user_id' => $user->id]);

    expect($talk->user)->toBeInstanceOf(User::class);
    expect($talk->user->id)->toBe($user->id);
});

test('talk cities are cast to array', function () {
    $talk = Talk::factory()->create(['cities' => ['Stockholm', 'Malmö']]);

    expect($talk->cities)->toBeArray();
    expect($talk->cities)->toBe(['Stockholm', 'Malmö']);
});
