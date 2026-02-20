<?php

namespace App\Livewire\Admin;

use App\Models\Company;
use Livewire\Attributes\Url;
use Livewire\Component;

class CompanyList extends Component
{
    #[Url(as: 'status')]
    public string $statusFilter = '';

    public function render()
    {
        $query = Company::query()
            ->with('user')
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 WHEN status = 'approved' THEN 1 ELSE 2 END")
            ->latest();

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        return view('livewire.admin.company-list', [
            'companies' => $query->get(),
        ])->layout('components.layouts.app', ['title' => 'Admin: Companies - Swedish Laravel Association']);
    }
}
