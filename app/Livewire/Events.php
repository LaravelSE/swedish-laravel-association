<?php

namespace App\Livewire;

use App\Models\Events\Event;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;

class Events extends Component
{

    /** @var Collection<int,Event> */
    public Collection $upcomingEvents;

    /** @var Collection<int,Event> */
    public Collection $pastEvents;

    /** @var Collection<int,bool> */
    public Collection $expandedEvents;

    public function mount()
    {
        $this->expandedEvents = collect();
        $this->upcomingEvents = Event::upcoming()->get();
        $this->pastEvents = Event::past()->get();
    }

    public function toggleEvent($eventId)
    {
        if ($this->expandedEvents->has($eventId)) {
            $this->expandedEvents = $this->expandedEvents->except($eventId);
            return;
        }

        $this->expandedEvents->put($eventId, true);
    }

    public function isExpanded($eventId)
    {
        return $this->expandedEvents->has($eventId);
    }

    public function render()
    {
        return view('livewire.events');
    }
}
