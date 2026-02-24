<?php

use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('unverified users can access member area', function () {
    $user = User::factory()->unverified()->create();

    $response = $this->actingAs($user)->get('/member');

    $response->assertOk();
});

test('verified users can access member area', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/member');

    $response->assertStatus(200);
});
