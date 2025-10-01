<?php

use App\Livewire\EditProfile;
use App\Livewire\Member;
use App\Livewire\Subscription\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Cashier\Http\Controllers\WebhookController;

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

if (config('stripe.features.subscriptions')) {
    Route::post('stripe/webhook', [WebhookController::class, 'handleWebhook'])
        ->name('cashier.webhook');
}

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('member', Member::class)
        ->name('member');

    Route::get('member/edit', EditProfile::class)
        ->name('member.edit');

    // Subscription routes - only register if subscriptions are enabled
    if (config('stripe.features.subscriptions')) {
        // Subscription Checkout
        Route::get('member/subscription/checkout', Checkout::class)
            ->name('subscription.checkout');

        // Stripe Customer Portal
        Route::get('member/billing', function (Request $request) {
            return $request->user()->redirectToBillingPortal(route('member'));
        })->name('member.billing');
    }
});

// require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::fallback(function () {
    return view('404');
});
