<?php

namespace App\Livewire\Admin;

use App\Models\Company;
use App\Models\Talk;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'pendingCompaniesCount' => Company::pending()->count(),
            'approvedCount' => Company::approved()->count(),
            'rejectedCount' => Company::rejected()->count(),
            'pendingTalksCount' => Talk::pending()->count(),
            'totalUsers' => User::count(),
            'recentPendingCompanies' => Company::pending()->with('user')->latest()->limit(5)->get(),
            'recentPendingTalks' => Talk::pending()->with('user')->latest()->limit(5)->get(),
        ])->layout('components.layouts.app', ['title' => 'Admin: Dashboard - Swedish Laravel Association']);
    }
}
