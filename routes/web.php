<?php

use App\Livewire\EditProfile;
use App\Livewire\Member;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/welcome2', function () {
    return redirect()->route('home');
})->name('welcome2');

Route::get('/{city}', function () {
    return redirect()->route('home');
})->whereIn('city', ['stockholm', 'malmo', 'gothenburg', 'gbg', 'sthlm', 'norrkoping'])
    ->name('events');

Route::get('member', Member::class)
    ->middleware(['auth', 'verified'])
    ->name('member');

Route::get('member/edit', EditProfile::class)
    ->middleware(['auth', 'verified'])
    ->name('member.edit');

// require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
