<?php

use App\Livewire\EditProfile;
use App\Models\User;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('password can be changed via edit profile', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(EditProfile::class)
        ->call('toggleChangePassword')
        ->set('current_password', 'password')
        ->set('password', 'new-password')
        ->set('password_confirmation', 'new-password')
        ->call('save')
        ->assertRedirect(route('member'));

    expect(\Illuminate\Support\Facades\Hash::check('new-password', $user->fresh()->password))->toBeTrue();
});

test('password is not changed with incorrect current password', function () {
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
