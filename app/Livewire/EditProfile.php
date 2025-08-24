<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class EditProfile extends Component
{
    public User $user;

    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $city = '';

    public string $company = '';

    public string $current_password = '';

    public string $password = '';

    public string $password_confirmation = '';

    public bool $change_password = false;

    public function mount()
    {
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone ?? '';
        $this->city = $this->user->city ?? '';
        $this->company = $this->user->company ?? '';
    }

    public function toggleChangePassword()
    {
        $this->change_password = ! $this->change_password;
        $this->resetPasswordFields();
    }

    public function resetPasswordFields()
    {
        $this->current_password = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->resetErrorBag(['current_password', 'password', 'password_confirmation']);
    }

    public function save()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'city' => ['nullable', 'string', 'max:150'],
            'company' => ['nullable', 'string', 'max:150'],
        ]);

        if ($this->change_password) {
            $this->validate([
                'current_password' => ['required', 'current_password'],
                'password' => ['required', Password::defaults(), 'confirmed'],
            ]);

            $this->user->password = Hash::make($this->password);
        }

        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $this->user->phone = $this->phone;
        $this->user->city = $this->city;
        $this->user->company = $this->company;
        $this->user->save();

        session()->flash('message', 'Profile updated successfully.');

        return redirect()->route('member');
    }

    public function render()
    {
        return view('livewire.edit-profile');
    }
}
