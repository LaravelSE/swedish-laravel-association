<?php

namespace App\Livewire;

use App\Mail\ContactFormSubmission;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Contact extends Component
{
    public string $name = '';

    public string|array $email = '';

    public string $message = '';

    public bool $showSuccessMessage = false;

    protected $rules = [
        'name' => 'required|min:2',
        'email' => 'required|email',
        'message' => 'required|min:10',
    ];

    protected $messages = [
        'name.required' => 'Please enter your name.',
        'name.min' => 'Your name should be at least 2 characters.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'message.required' => 'Please enter your message.',
        'message.min' => 'Your message should be at least 10 characters.',
    ];

    public function updatedEmail($value): void
    {
        // Defensive: ensure email is always a string, not an array
        if (is_array($value)) {
            $this->email = $value[0] ?? '';
        }
    }

    public function submitForm()
    {
        $this->validate();

        Mail::to('hello@laravelsweden.org')->send(new ContactFormSubmission($this->name, $this->email, $this->message));

        // Show success message
        $this->showSuccessMessage = true;
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
