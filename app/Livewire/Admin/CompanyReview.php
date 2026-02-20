<?php

namespace App\Livewire\Admin;

use App\Models\Company;
use Livewire\Component;

class CompanyReview extends Component
{
    public Company $company;

    public string $adminNotes = '';

    public function mount(Company $company): void
    {
        $this->company = $company->load('user');
        $this->adminNotes = $company->admin_notes ?? '';
    }

    public function approve(): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $this->company->status = 'approved';
        $this->company->admin_notes = $this->adminNotes ?: null;
        $this->company->save();

        session()->flash('message', 'Company "'.$this->company->name.'" has been approved.');

        $this->redirect(route('admin.companies'), navigate: true);
    }

    public function reject(): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $this->company->status = 'rejected';
        $this->company->admin_notes = $this->adminNotes ?: null;
        $this->company->save();

        session()->flash('message', 'Company "'.$this->company->name.'" has been rejected.');

        $this->redirect(route('admin.companies'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.company-review')
            ->layout('components.layouts.app', ['title' => 'Review: '.$this->company->name.' - Swedish Laravel Association']);
    }
}
