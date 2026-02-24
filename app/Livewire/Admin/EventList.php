<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class EventList extends Component
{
    use WithPagination;

    #[Url(as: 'filter')]
    public string $timeFilter = 'upcoming';

    public function updatedTimeFilter(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $query = Event::query()->orderBy('datetime');

        if ($this->timeFilter === 'upcoming') {
            $query->upcoming();
        } elseif ($this->timeFilter === 'past') {
            $query->past()->orderByDesc('datetime');
        }

        return view('livewire.admin.event-list', [
            'events' => $query->paginate(25),
        ])->layout('components.layouts.app', ['title' => 'Admin: Events - Swedish Laravel Association']);
    }
}
