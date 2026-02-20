<?php

namespace App\Livewire;

use App\Models\Event;
use Illuminate\Support\Collection;
use Livewire\Component;

class Events extends Component
{
    /** @var array<int> */
    public array $expandedEvents = [];

    public Collection $upcomingEvents;

    public Collection $pastEvents;

    public function mount(): void
    {
        $this->upcomingEvents = Event::upcoming()->orderBy('datetime')->get();
        $this->pastEvents = Event::past()->orderByDesc('datetime')->get();
    }

    public function toggleEvent(int $eventId): void
    {
        if (in_array($eventId, $this->expandedEvents)) {
            $this->expandedEvents = array_values(array_diff($this->expandedEvents, [$eventId]));
        } else {
            $this->expandedEvents[] = $eventId;
        }
    }

    public function isExpanded(int $eventId): bool
    {
        return in_array($eventId, $this->expandedEvents);
    }

    public function render()
    {
        return view('livewire.events');
    }
}
