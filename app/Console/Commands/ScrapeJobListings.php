<?php

namespace App\Console\Commands;

use App\Services\LinkedInJobScraper;
use Illuminate\Console\Command;

class ScrapeJobListings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jobs:scrape {--days=30 : Only include postings from the last N days (0 = no filter)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape Laravel/PHP job postings from LinkedIn into the pending review queue';

    public function handle(LinkedInJobScraper $scraper): int
    {
        $days = (int) $this->option('days');

        $this->info('Scraping LinkedIn job postings'.($days > 0 ? " (last {$days} days)" : '').'...');

        $stats = $scraper->run($days);

        $this->newLine();
        $this->table(['Found', 'New (pending)', 'Duplicates in run', 'Skipped (not PHP/Laravel)'], [[
            $stats['found'],
            $stats['new'],
            $stats['duplicates'],
            $stats['skipped_irrelevant'],
        ]]);

        if ($stats['found'] === 0) {
            $this->warn('No job cards were parsed from any search — LinkedIn markup may have changed or requests were blocked.');
        }

        return self::SUCCESS;
    }
}
