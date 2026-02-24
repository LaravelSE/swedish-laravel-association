<?php

namespace App\Livewire\Admin;

use App\Models\Talk;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TalkList extends Component
{
    use WithPagination;

    #[Url(as: 'status')]
    public string $statusFilter = '';

    public function updatedStatusFilter(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $query = Talk::query()
            ->with('user')
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 WHEN status = 'interested' THEN 1 WHEN status = 'scheduled' THEN 2 WHEN status = 'done' THEN 3 ELSE 4 END")
            ->latest();

        if ($this->statusFilter && in_array($this->statusFilter, Talk::STATUSES)) {
            $query->where('status', $this->statusFilter);
        }

        return view('livewire.admin.talk-list', [
            'talks' => $query->paginate(25),
        ])->layout('components.layouts.app', ['title' => 'Admin: Talks - Swedish Laravel Association']);
    }
}
