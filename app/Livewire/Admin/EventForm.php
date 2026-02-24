<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Illuminate\View\View;
use Livewire\Component;

class EventForm extends Component
{
    public ?Event $event = null;

    public string $title = '';

    public string $datetimeInput = '';

    public string $location = '';

    public string $description = '';

    public string $link = '';

    public string $closing = '';

    /** @var list<string> */
    public array $details = [''];

    /** @var list<array{time: string, activity: string}> */
    public array $schedule = [['time' => '', 'activity' => '']];

    /** @var list<string> */
    public array $footer = [''];

    /** @var list<array{name: string, description: string}> */
    public array $organizers = [['name' => '', 'description' => '']];

    public function mount($event = null): void
    {
        if ($event) {
            $this->event = $event instanceof Event
                ? $event
                : Event::findOrFail($event);
            $this->title = $this->event->title;
            $this->datetimeInput = $this->event->datetime->format('Y-m-d\TH:i');
            $this->location = $this->event->location;
            $this->description = $this->event->description;
            $this->link = $this->event->link ?? '';
            $this->closing = $this->event->closing ?? '';
            $this->details = $this->event->details ?: [''];
            $this->schedule = $this->event->schedule ?: [['time' => '', 'activity' => '']];
            $this->footer = $this->event->footer ?: [''];
            $this->organizers = $this->event->organizers ?: [['name' => '', 'description' => '']];
        }
    }

    protected function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'datetimeInput' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url|max:255',
            'closing' => 'nullable|string',
            'details' => 'array',
            'details.*' => 'nullable|string',
            'schedule' => 'array',
            'schedule.*.time' => 'nullable|string|max:10',
            'schedule.*.activity' => 'nullable|string|max:255',
            'footer' => 'array',
            'footer.*' => 'nullable|string',
            'organizers' => 'array',
            'organizers.*.name' => 'nullable|string|max:255',
            'organizers.*.description' => 'nullable|string',
        ];
    }

    public function save(): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $this->validate();

        $data = [
            'title' => $this->title,
            'datetime' => $this->datetimeInput,
            'location' => $this->location,
            'description' => $this->description,
            'link' => $this->link ?: null,
            'closing' => $this->closing ?: null,
            'details' => array_values(array_filter($this->details)),
            'schedule' => array_values(array_filter($this->schedule, fn ($row) => filled($row['time']) || filled($row['activity']))),
            'footer' => array_values(array_filter($this->footer)),
            'organizers' => array_values(array_filter($this->organizers, fn ($row) => filled($row['name']))),
        ];

        if ($this->event?->exists) {
            $this->event->update($data);
            session()->flash('message', 'Event updated.');
        } else {
            Event::create($data);
            session()->flash('message', 'Event created.');
        }

        $this->redirect(route('admin.events'), navigate: true);
    }

    public function addDetailRow(): void
    {
        $this->details[] = '';
    }

    public function removeDetailRow(int $index): void
    {
        array_splice($this->details, $index, 1);
        if (empty($this->details)) {
            $this->details = [''];
        }
    }

    public function addScheduleRow(): void
    {
        $this->schedule[] = ['time' => '', 'activity' => ''];
    }

    public function removeScheduleRow(int $index): void
    {
        array_splice($this->schedule, $index, 1);
        if (empty($this->schedule)) {
            $this->schedule = [['time' => '', 'activity' => '']];
        }
    }

    public function addFooterRow(): void
    {
        $this->footer[] = '';
    }

    public function removeFooterRow(int $index): void
    {
        array_splice($this->footer, $index, 1);
        if (empty($this->footer)) {
            $this->footer = [''];
        }
    }

    public function addOrganizerRow(): void
    {
        $this->organizers[] = ['name' => '', 'description' => ''];
    }

    public function removeOrganizerRow(int $index): void
    {
        array_splice($this->organizers, $index, 1);
        if (empty($this->organizers)) {
            $this->organizers = [['name' => '', 'description' => '']];
        }
    }

    public function render(): View
    {
        $title = $this->event?->exists ? 'Edit: '.$this->event->title : 'New Event';

        return view('livewire.admin.event-form')
            ->layout('components.layouts.app', ['title' => 'Admin: '.$title.' - Swedish Laravel Association']);
    }
}
