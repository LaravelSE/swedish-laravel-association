<?php

namespace App\Livewire;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CompaniesListing extends Component
{
    public string $cityFilter = '';

    public function render()
    {
        $query = Company::query()->approved()->orderBy('name');

        if ($this->cityFilter) {
            $query->where('city', $this->cityFilter);
        }

        /** @var Collection<int, Company> $companies */
        $companies = $query->get();

        $cities = Company::query()->approved()
            ->select('city')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');

        return view('livewire.companies-listing', [
            'companies' => $companies,
            'cities' => $cities,
        ])->layout('components.layouts.app', ['title' => 'Companies Using Laravel in Sweden - Swedish Laravel Association']);
    }
}
