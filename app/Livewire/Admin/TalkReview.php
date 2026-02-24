<?php

namespace App\Livewire\Admin;

use App\Models\Talk;
use Illuminate\View\View;
use Livewire\Component;

class TalkReview extends Component
{
    public Talk $talk;

    public string $adminNotes = '';

    public function mount(Talk $talk): void
    {
        $this->talk = $talk->load('user');
        $this->adminNotes = $talk->admin_notes ?? '';
    }

    public function markInterested(): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $this->talk->status = 'interested';
        $this->talk->admin_notes = $this->adminNotes ?: null;
        $this->talk->save();

        session()->flash('message', '"'.$this->talk->title.'" marked as interested.');

        $this->redirect(route('admin.talks'), navigate: true);
    }

    public function schedule(): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $this->talk->status = 'scheduled';
        $this->talk->admin_notes = $this->adminNotes ?: null;
        $this->talk->save();

        session()->flash('message', '"'.$this->talk->title.'" marked as scheduled.');

        $this->redirect(route('admin.talks'), navigate: true);
    }

    public function markDone(): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $this->talk->status = 'done';
        $this->talk->admin_notes = $this->adminNotes ?: null;
        $this->talk->save();

        session()->flash('message', '"'.$this->talk->title.'" marked as done.');

        $this->redirect(route('admin.talks'), navigate: true);
    }

    public function reject(): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $this->talk->status = 'rejected';
        $this->talk->admin_notes = $this->adminNotes ?: null;
        $this->talk->save();

        session()->flash('message', '"'.$this->talk->title.'" has been rejected.');

        $this->redirect(route('admin.talks'), navigate: true);
    }

    public function saveNotes(): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $this->talk->admin_notes = $this->adminNotes ?: null;
        $this->talk->save();

        session()->flash('message', 'Notes saved.');
    }

    public function render(): View
    {
        return view('livewire.admin.talk-review')
            ->layout('components.layouts.app', ['title' => 'Admin: Review Talk - Swedish Laravel Association']);
    }
}
