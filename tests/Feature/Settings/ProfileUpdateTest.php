<?php

use App\Livewire\EditProfile;
use App\Models\User;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('profile edit page is displayed', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/member/edit');

    $response->assertOk();
});

test('profile information can be updated', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(EditProfile::class)
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->call('save')
        ->assertRedirect(route('member'));

    $user->refresh();

    expect($user->name)->toBe('Test User');
    expect($user->email)->toBe('test@example.com');
});

test('email must be valid', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(EditProfile::class)
        ->set('email', 'invalid-email')
        ->call('save')
        ->assertHasErrors('email');
});

test('name is required', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(EditProfile::class)
        ->set('name', '')
        ->call('save')
        ->assertHasErrors('name');
});
