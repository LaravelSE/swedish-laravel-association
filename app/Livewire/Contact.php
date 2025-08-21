<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Contact extends Component
{
    public string $name = '';

    public string $email = '';

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

    public function submitForm()
    {
        $this->validate();

        // In a real application, you would send an email here
        // Mail::to('hello@laravelsweden.org')->send(new \App\Mail\ContactFormSubmission($this->name, $this->email, $this->message));

        $this->showSuccessMessage = true;
        $this->reset(['name', 'email', 'message']);
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
