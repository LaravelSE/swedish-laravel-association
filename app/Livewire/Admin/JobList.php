<?php

namespace App\Livewire\Admin;

use App\Jobs\PostJobToSlack;
use App\Models\Company;
use App\Models\JobListing;
use App\Services\SlackNotifier;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class JobList extends Component
{
    use WithPagination;

    #[Url(as: 'status')]
    public string $statusFilter = 'pending';

    /**
     * Reset to the first page whenever the status filter changes.
     */
    public function updatedStatusFilter(): void
    {
        $this->resetPage();
    }

    /**
     * Approve a job: mark approved and queue the Slack post.
     */
    public function approve(int $id, SlackNotifier $slack): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $job = JobListing::findOrFail($id);

        if ($job->status === 'approved') {
            return;
        }

        $job->status = 'approved';
        $job->approved_at = now();
        $job->save();

        if ($slack->isConfigured()) {
            PostJobToSlack::dispatch($job);
            session()->flash('message', "Approved — posting to Slack: {$job->title}");
        } else {
            session()->flash('message', "Approved (Slack not configured — post skipped): {$job->title}");
        }
    }

    /**
     * Reject a job so it never shows in the pending queue again.
     */
    public function reject(int $id): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $job = JobListing::findOrFail($id);
        $job->status = 'rejected';
        $job->save();

        session()->flash('message', "Rejected: {$job->title}");
    }

    /**
     * Create a pending Company in the listing from this job's employer,
     * and link the job to it.
     */
    public function addToCompanies(int $id): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $job = JobListing::findOrFail($id);

        if ($job->company_id) {
            session()->flash('message', "Already linked to a company: {$job->company_name}");

            return;
        }

        // Best-effort city from the location string ("Stockholm, Stockholm County, Sweden").
        $city = trim(explode(',', (string) $job->location)[0]) ?: 'Unknown';

        $company = Company::create([
            'user_id' => auth()->id(),
            'name' => $job->company_name,
            'city' => $city,
            'description' => "Added from a LinkedIn job posting: {$job->title}.",
            'submitter_relationship' => 'Public information',
        ]);

        // admin_notes is not mass-assignable on Company; set it directly.
        $company->admin_notes = "Imported from job listing #{$job->id} ({$job->search_label}).";
        $company->save();

        $job->company_id = $company->id;
        $job->save();

        session()->flash('message', "Added \"{$company->name}\" to the company listing (pending review).");
    }

    public function render(): View
    {
        $query = JobListing::query()
            ->with('activitiesAsSubject.causer')
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 WHEN status = 'approved' THEN 1 ELSE 2 END")
            ->orderByRaw("CASE WHEN location LIKE '%Sweden%' THEN 0 ELSE 1 END")
            ->orderByDesc('posted_date')
            ->latest();

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        return view('livewire.admin.job-list', [
            'jobs' => $query->paginate(25),
            'pendingCount' => JobListing::pending()->count(),
        ])->layout('components.layouts.app', ['title' => 'Admin: Jobs - Swedish Laravel Association']);
    }
}
