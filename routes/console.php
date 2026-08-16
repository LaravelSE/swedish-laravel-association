<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Scrape LinkedIn job postings into the pending review queue every morning.
Schedule::command('jobs:scrape')
    ->dailyAt('06:00')
    ->withoutOverlapping();
