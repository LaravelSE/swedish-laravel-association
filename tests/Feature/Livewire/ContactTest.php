<?php

use App\Livewire\Contact;
use App\Mail\ContactFormSubmission;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Contact::class)
        ->assertStatus(200);
});

it('validates required fields', function () {
    Livewire::test(Contact::class)
        ->call('submitForm')
        ->assertHasErrors(['name', 'email', 'message']);
});

it('validates email format', function () {
    Livewire::test(Contact::class)
        ->set('email', 'invalid-email')
        ->call('submitForm')
        ->assertHasErrors(['email' => 'email']);
});

it('validates minimum name length', function () {
    Livewire::test(Contact::class)
        ->set('name', 'A')
        ->call('submitForm')
        ->assertHasErrors(['name' => 'min']);
});

it('validates minimum message length', function () {
    Livewire::test(Contact::class)
        ->set('message', 'Short')
        ->call('submitForm')
        ->assertHasErrors(['message' => 'min']);
});

it('submits form successfully with valid data', function () {
    Mail::fake();

    Livewire::test(Contact::class)
        ->set('name', 'John Doe')
        ->set('email', 'john@example.com')
        ->set('message', 'This is a test message with enough length.')
        ->call('submitForm')
        ->assertHasNoErrors()
        ->assertSet('showSuccessMessage', true);

    Mail::assertSent(ContactFormSubmission::class, function ($mail) {
        return $mail->hasTo('hello@laravelsweden.org');
    });
});

it('handles array email value defensively', function () {
    Livewire::test(Contact::class)
        ->set('email', ['test@example.com', 'other@example.com'])
        ->assertSet('email', 'test@example.com');
});

it('shows loading state when submitting', function () {
    Mail::fake();

    Livewire::test(Contact::class)
        ->set('name', 'John Doe')
        ->set('email', 'john@example.com')
        ->set('message', 'This is a test message.')
        ->call('submitForm')
        ->assertSee('Sending...');
});
