<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class UserList extends Component
{
    public string $roleFilter = '';

    public function promoteToAdmin(User $user): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $user->is_admin = true;
        $user->save();

        session()->flash('message', $user->name.' has been promoted to admin.');
    }

    public function demoteFromAdmin(User $user): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        if ($user->id === auth()->id()) {
            session()->flash('error', 'You cannot remove your own admin privileges.');

            return;
        }

        $user->is_admin = false;
        $user->save();

        session()->flash('message', $user->name.' is no longer an admin.');
    }

    public function render(): View
    {
        $query = User::query()->latest();

        if ($this->roleFilter === 'admin') {
            $query->where('is_admin', true);
        } elseif ($this->roleFilter === 'regular') {
            $query->where('is_admin', false);
        }

        return view('livewire.admin.user-list', [
            'users' => $query->get(),
        ])->layout('components.layouts.app', ['title' => 'Admin: Users - Swedish Laravel Association']);
    }
}
