<?php

namespace App\Livewire\Admin;

use App\Models\BoardMember;
use Livewire\Component;
use Livewire\WithFileUploads;

class BoardMemberForm extends Component
{
    use WithFileUploads;

    public ?BoardMember $boardMember = null;

    public string $name = '';

    public string $role = '';

    public string $company = '';

    public int $sortOrder = 0;

    public $photo = null;

    public function mount($boardMember = null): void
    {
        if ($boardMember) {
            $this->boardMember = $boardMember instanceof BoardMember
                ? $boardMember
                : BoardMember::findOrFail($boardMember);
            $this->name = $this->boardMember->name;
            $this->role = $this->boardMember->role;
            $this->company = $this->boardMember->company ?? '';
            $this->sortOrder = $this->boardMember->sort_order;
        }
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'sortOrder' => 'required|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
        ];
    }

    public function save(): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $this->validate();

        $data = [
            'name' => $this->name,
            'role' => $this->role,
            'company' => $this->company ?: null,
            'sort_order' => $this->sortOrder,
        ];

        if ($this->photo) {
            $imagePath = $this->photo->store('board-members', 'public');
            if ($imagePath === false) {
                $this->addError('photo', 'Failed to upload the photo. Please try again.');

                return;
            }
            $data['image_path'] = $imagePath;
        }

        if ($this->boardMember?->exists) {
            $this->boardMember->update($data);
            session()->flash('message', '"'.$this->name.'" has been updated.');
        } else {
            BoardMember::create($data);
            session()->flash('message', '"'.$this->name.'" has been added.');
        }

        $this->redirect(route('admin.board-members'), navigate: true);
    }

    public function render(): \Illuminate\View\View
    {
        $title = $this->boardMember?->exists ? 'Edit: '.$this->boardMember->name : 'New Board Member';

        return view('livewire.admin.board-member-form')
            ->layout('components.layouts.app', ['title' => 'Admin: '.$title.' - Swedish Laravel Association']);
    }
}
