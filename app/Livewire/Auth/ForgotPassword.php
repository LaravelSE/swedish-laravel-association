<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public string $email = '';

    public bool $emailSentMessage = false;

    protected function rules()
    {
        return [
            'email' => 'required|email',
        ];
    }

    protected $messages = [
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
    ];

    public function sendResetLink()
    {
        $this->validate();

        $status = Password::sendResetLink(
            ['email' => $this->email]
        );

        if ($status === Password::RESET_LINK_SENT || $status === Password::INVALID_USER) {
            $this->emailSentMessage = true;
            $this->email = '';
        } else {
            $this->addError('email', __($status));
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password')
            ->layout('components.layouts.app', ['title' => 'Forgot Password - Swedish Laravel Association']);
    }
}
