<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Component;

class Register extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $city = '';

    public string $company = '';

    public string $password = '';

    public string $password_confirmation = '';

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:150',
            'company' => 'nullable|string|max:150',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    protected $messages = [
        'name.required' => 'Please enter your name.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already registered.',
        'password.required' => 'Please enter a password.',
        'password.confirmed' => 'The password confirmation does not match.',
    ];

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city,
            'company' => $this->company,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('member');
    }

    public function render()
    {
        return view('livewire.auth.register')
            ->layout('components.layouts.app', ['title' => 'Register - Swedish Laravel Association']);
    }
}
