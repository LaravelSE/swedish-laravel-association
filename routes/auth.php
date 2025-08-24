<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', Register::class)
        ->name('register');

    Route::post('register', Register::class);

    Route::get('login', Login::class)
        ->name('login');

    Route::post('login', Login::class);

    Route::get('forgot-password', ForgotPassword::class)
        ->name('password.request');

    Route::post('forgot-password', ForgotPassword::class)
        ->name('password.email');

    Route::get('reset-password/{token}', ResetPassword::class)
        ->name('password.reset');

    Route::post('reset-password', ResetPassword::class)
        ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
