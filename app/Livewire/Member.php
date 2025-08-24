<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Member extends Component
{
    public function logout()
    {
        Auth::logout();

        session()->invalidate();
        session()->regenerateToken();

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.member', [
            'user' => Auth::user(),
        ])->layout('components.layouts.app', ['title' => 'Member Area - Swedish Laravel Association']);
    }
}
