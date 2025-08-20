<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/welcome2', function () {
    return view('welcome2');
})->name('welcome2');

Route::post('/contact', function () {
    $validated = request()->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'company' => 'nullable|string|max:255',
        'message' => 'required|string|max:2000',
    ]);

    // Send email using Laravel's Mail facade
    try {
        Mail::raw("
Nytt meddelande från kontaktformuläret på Swedish Laravel Association

Namn: {$validated['name']}
E-post: {$validated['email']}
Företag: " . ($validated['company'] ?? 'Inget angivet') . "

Meddelande:
{$validated['message']}
        ", function ($message) use ($validated) {
            $message->to('hej@laravelsweden.org')
                    ->subject('Kontaktformulär - Swedish Laravel Association')
                    ->replyTo($validated['email'], $validated['name']);
        });

        return back()->with('success', 'Tack för ditt meddelande! Vi kommer att höra av oss så snart som möjligt.');
    } catch (\Exception $e) {
        return back()->with('error', 'Något gick fel när meddelandet skulle skickas. Prova igen senare eller skicka ett e-postmeddelande direkt till hej@laravelsweden.org');
    }
})->name('contact');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
