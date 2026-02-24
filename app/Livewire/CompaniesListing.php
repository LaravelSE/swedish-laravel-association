<?php

namespace App\Livewire;

use App\Models\Company;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class CompaniesListing extends Component
{
    use WithPagination;

    public string $cityFilter = '';

    public function updatedCityFilter(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $query = Company::query()->approved()->orderBy('name');

        $cities = Company::query()->approved()
            ->select('city')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');

        if ($this->cityFilter) {
            $query->where('city', $this->cityFilter);
        }

        return view('livewire.companies-listing', [
            'companies' => $query->paginate(24),
            'cities' => $cities,
        ])->layout('components.layouts.app', ['title' => 'Companies Using Laravel in Sweden - Swedish Laravel Association']);
    }
}
