<?php

use App\Livewire\EditProfile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('password can be updated', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(EditProfile::class)
        ->call('toggleChangePassword')
        ->set('current_password', 'password')
        ->set('password', 'new-password')
        ->set('password_confirmation', 'new-password')
        ->call('save')
        ->assertRedirect(route('member'));

    expect(Hash::check('new-password', $user->refresh()->password))->toBeTrue();
});

test('correct password must be provided to update password', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(EditProfile::class)
        ->call('toggleChangePassword')
        ->set('current_password', 'wrong-password')
        ->set('password', 'new-password')
        ->set('password_confirmation', 'new-password')
        ->call('save')
        ->assertHasErrors('current_password');
});
