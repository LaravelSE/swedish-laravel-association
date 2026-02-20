<?php

namespace App\Livewire;

use App\Models\BoardMember;
use Illuminate\Support\Collection;
use Livewire\Component;

class BoardMembers extends Component
{
    public Collection $boardMembers;

    public function mount(): void
    {
        $this->boardMembers = BoardMember::orderBy('sort_order')->get();
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.board-members');
    }
}
