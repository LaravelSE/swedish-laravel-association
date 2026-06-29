<?php

namespace App\Jobs;

use App\Models\JobListing;
use App\Services\SlackNotifier;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class PostJobToSlack implements ShouldQueue
{
    use Queueable;

    public function __construct(public JobListing $listing) {}

    /**
     * Post the approved job to Slack, unless it was already posted.
     */
    public function handle(SlackNotifier $slack): void
    {
        if ($this->listing->posted_to_slack_at !== null) {
            return;
        }

        if ($slack->postJob($this->listing)) {
            $this->listing->posted_to_slack_at = now();
            $this->listing->save();
        }
    }
}
