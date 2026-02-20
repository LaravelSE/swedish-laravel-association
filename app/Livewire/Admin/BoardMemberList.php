<?php

namespace App\Livewire\Admin;

use App\Models\BoardMember;
use Livewire\Component;

class BoardMemberList extends Component
{
    public function delete(BoardMember $boardMember): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $boardMember->delete();

        session()->flash('message', '"'.$boardMember->name.'" has been removed.');
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.admin.board-member-list', [
            'boardMembers' => BoardMember::orderBy('sort_order')->get(),
        ])->layout('components.layouts.app', ['title' => 'Admin: Board Members - Swedish Laravel Association']);
    }
}
