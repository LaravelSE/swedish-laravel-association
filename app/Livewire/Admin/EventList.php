<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Livewire\Attributes\Url;
use Livewire\Component;

class EventList extends Component
{
    #[Url(as: 'filter')]
    public string $timeFilter = 'upcoming';

    public function render()
    {
        $query = Event::query()->orderBy('datetime');

        if ($this->timeFilter === 'upcoming') {
            $query->upcoming();
        } elseif ($this->timeFilter === 'past') {
            $query->past()->orderByDesc('datetime');
        }

        return view('livewire.admin.event-list', [
            'events' => $query->get(),
        ])->layout('components.layouts.app', ['title' => 'Admin: Events - Swedish Laravel Association']);
    }
}
