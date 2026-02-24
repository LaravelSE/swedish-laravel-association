<?php

namespace App\Livewire\Admin;

use App\Models\Company;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyList extends Component
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
        $query = Company::query()
            ->with('user')
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 WHEN status = 'approved' THEN 1 ELSE 2 END")
            ->latest();

        if ($this->statusFilter && in_array($this->statusFilter, Company::STATUSES)) {
            $query->where('status', $this->statusFilter);
        }

        return view('livewire.admin.company-list', [
            'companies' => $query->paginate(25),
        ])->layout('components.layouts.app', ['title' => 'Admin: Companies - Swedish Laravel Association']);
    }
}
