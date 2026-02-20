<?php

use App\Livewire\Admin\BoardMemberForm;
use App\Livewire\Admin\BoardMemberList;
use App\Livewire\Admin\CompanyList;
use App\Livewire\Admin\CompanyReview;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\EventForm;
use App\Livewire\Admin\EventList;
use App\Livewire\Admin\TalkList;
use App\Livewire\Admin\TalkReview;
use App\Livewire\Admin\UserDetail;
use App\Livewire\Admin\UserList;
use App\Livewire\CompaniesListing;
use App\Livewire\EditProfile;
use App\Livewire\Member;
use App\Livewire\SubmitCompany;
use App\Livewire\SubmitTalk;
use App\Livewire\Subscription\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Cashier\Http\Controllers\WebhookController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/submit-talk', SubmitTalk::class)
    ->name('submit-talk');

Route::get('/companies', CompaniesListing::class)
    ->name('companies');

Route::get('/submit-company', SubmitCompany::class)
    ->name('submit-company');

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

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', Dashboard::class)
        ->name('admin.dashboard');

    Route::get('companies', CompanyList::class)
        ->name('admin.companies');

    Route::get('companies/{company}', CompanyReview::class)
        ->name('admin.companies.review');

    Route::get('events', EventList::class)
        ->name('admin.events');

    Route::get('events/create', EventForm::class)
        ->name('admin.events.create');

    Route::get('events/{event}/edit', EventForm::class)
        ->name('admin.events.edit');

    Route::get('talks', TalkList::class)
        ->name('admin.talks');

    Route::get('talks/{talk}', TalkReview::class)
        ->name('admin.talks.review');

    Route::get('users', UserList::class)
        ->name('admin.users');

    Route::get('users/{user}', UserDetail::class)
        ->name('admin.users.show');

    Route::get('board-members', BoardMemberList::class)
        ->name('admin.board-members');

    Route::get('board-members/create', BoardMemberForm::class)
        ->name('admin.board-members.create');

    Route::get('board-members/{boardMember}/edit', BoardMemberForm::class)
        ->name('admin.board-members.edit');
});

// require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::fallback(function () {
    return view('404');
});
