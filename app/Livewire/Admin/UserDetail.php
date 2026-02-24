<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class UserDetail extends Component
{
    public User $user;

    public function promoteToAdmin(): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $this->user->is_admin = true;
        $this->user->save();

        session()->flash('message', $this->user->name.' has been promoted to admin.');
    }

    public function demoteFromAdmin(): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        if ($this->user->id === auth()->id()) {
            session()->flash('error', 'You cannot remove your own admin privileges.');

            return;
        }

        $this->user->is_admin = false;
        $this->user->save();

        session()->flash('message', $this->user->name.' is no longer an admin.');
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.admin.user-detail', [
            'talks' => $this->user->talks()->latest()->get(),
            'companies' => $this->user->companies()->latest()->get(),
        ])->layout('components.layouts.app', ['title' => 'Admin: '.$this->user->name.' - Swedish Laravel Association']);
    }
}
