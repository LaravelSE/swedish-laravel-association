<?php

namespace App\Livewire;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class CompaniesListing extends Component
{
    public string $cityFilter = '';

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

        /** @var Collection<int, Company> $companies */
        $companies = $query->get();

        return view('livewire.companies-listing', [
            'companies' => $companies,
            'cities' => $cities,
        ])->layout('components.layouts.app', ['title' => 'Companies Using Laravel in Sweden - Swedish Laravel Association']);
    }
}
