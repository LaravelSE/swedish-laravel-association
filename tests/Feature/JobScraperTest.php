<?php

use App\Models\JobListing;
use App\Services\LinkedInJobScraper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

/**
 * Minimal slice of LinkedIn's jobs-guest response: two job cards.
 */
function sampleJobCardsHtml(): string
{
    return <<<'HTML'
    <ul class="jobs-search__results-list">
      <li>
        <div class="base-card relative job-search-card" data-entity-urn="urn:li:jobPosting:4159232303">
          <a class="base-card__full-link" href="https://www.linkedin.com/jobs/view/backend-developer-at-acme-4159232303?trackingId=abc&amp;refId=xyz">link</a>
          <h3 class="base-search-card__title">Backend Developer</h3>
          <h4 class="base-search-card__subtitle">Acme AB</h4>
          <span class="job-search-card__location">Stockholm, Stockholm County, Sweden</span>
          <time class="job-search-card__listdate" datetime="2026-06-01">1 week ago</time>
        </div>
      </li>
      <li>
        <div class="base-card relative job-search-card" data-entity-urn="urn:li:jobPosting:4159999999">
          <a class="base-card__full-link" href="https://www.linkedin.com/jobs/view/php-developer-at-globex-4159999999">link</a>
          <h3 class="base-search-card__title">PHP Developer</h3>
          <h4 class="base-search-card__subtitle">Globex</h4>
          <span class="job-search-card__location">Copenhagen, Denmark</span>
          <time class="job-search-card__listdate" datetime="2026-06-10">3 days ago</time>
        </div>
      </li>
    </ul>
    HTML;
}

/**
 * Fake LinkedIn so the first page of every search returns the two sample cards
 * (later pages empty, which stops pagination) and each job-detail request
 * returns the given description HTML.
 *
 * NB: call this exactly once per test. Http::fake() appends stubs rather than
 * replacing them, and the first matching stub wins — so a second call would be
 * shadowed by the first.
 */
function fakeLinkedIn(string $descriptionHtml): void
{
    Http::fake(function ($request) use ($descriptionHtml) {
        $url = $request->url();

        if (str_contains($url, '/jobPosting/')) {
            return Http::response($descriptionHtml, 200);
        }
        if (str_contains($url, 'start=0')) {
            return Http::response(sampleJobCardsHtml(), 200);
        }

        return Http::response('', 200);
    });
}

const RELEVANT_DESCRIPTION = '<section class="description"><div class="description__text">We are hiring a Laravel / PHP developer. Symfony experience a plus.</div></section>';

const IRRELEVANT_DESCRIPTION = '<div class="description__text">We need a Java and Kotlin backend engineer.</div>';

test('scraper parses job cards into pending listings', function () {
    fakeLinkedIn(RELEVANT_DESCRIPTION);

    $stats = (new LinkedInJobScraper)->run(30);

    expect(JobListing::count())->toBe(2);

    $job = JobListing::where('external_id', '4159232303')->first();
    expect($job)->not->toBeNull();
    expect($job->title)->toBe('Backend Developer');
    expect($job->company_name)->toBe('Acme AB');
    expect($job->location)->toBe('Stockholm, Stockholm County, Sweden');
    expect($job->status)->toBe('pending');
    expect($job->posted_date->format('Y-m-d'))->toBe('2026-06-01');
    expect($job->description)->toContain('Laravel');

    // Tracking query string is stripped from the URL.
    expect($job->url)->toBe('https://www.linkedin.com/jobs/view/backend-developer-at-acme-4159232303');

    // 7 searches each see the same 2 cards: 2 inserted, the rest deduped.
    expect($stats['new'])->toBe(2);
    expect($stats['found'])->toBe(14);
    expect($stats['duplicates'])->toBe(12);
    expect($stats['skipped_irrelevant'])->toBe(0);
});

test('scraper skips jobs whose description does not mention the stack', function () {
    fakeLinkedIn(IRRELEVANT_DESCRIPTION);

    $stats = (new LinkedInJobScraper)->run(30);

    expect(JobListing::count())->toBe(0);
    expect($stats['new'])->toBe(0);
    expect($stats['skipped_irrelevant'])->toBe(2);
});

test('scraper does not duplicate jobs already in the database', function () {
    fakeLinkedIn(RELEVANT_DESCRIPTION);
    JobListing::factory()->create(['external_id' => '4159232303', 'title' => 'Existing']);

    (new LinkedInJobScraper)->run(30);

    // The pre-existing job is not re-inserted; only the second card is new.
    expect(JobListing::count())->toBe(2);
    expect(JobListing::where('external_id', '4159232303')->value('title'))->toBe('Existing');
});

test('scraper requests the last-30-days time filter', function () {
    fakeLinkedIn(RELEVANT_DESCRIPTION);

    (new LinkedInJobScraper)->run(30);

    Http::assertSent(fn ($request) => str_contains($request->url(), 'f_TPR=r2592000'));
});

/**
 * A single card with the given posting id and href, served on the first page of
 * every search; the job-detail request returns a relevant description.
 */
function fakeLinkedInCard(string $urn, string $href): void
{
    $html = <<<HTML
    <ul class="jobs-search__results-list">
      <li>
        <div class="base-card relative job-search-card" data-entity-urn="{$urn}">
          <a class="base-card__full-link" href="{$href}">link</a>
          <h3 class="base-search-card__title">Laravel Developer</h3>
          <h4 class="base-search-card__subtitle">Acme AB</h4>
          <span class="job-search-card__location">Stockholm, Sweden</span>
        </div>
      </li>
    </ul>
    HTML;

    Http::fake(function ($request) use ($html) {
        $url = $request->url();
        if (str_contains($url, '/jobPosting/')) {
            return Http::response(RELEVANT_DESCRIPTION, 200);
        }
        if (str_contains($url, 'start=0')) {
            return Http::response($html, 200);
        }

        return Http::response('', 200);
    });
}

test('scraper ignores a non-https job url and stores a safe linkedin fallback', function () {
    fakeLinkedInCard('urn:li:jobPosting:4150000001', 'javascript:alert(document.cookie)');

    (new LinkedInJobScraper)->run(30);

    $job = JobListing::where('external_id', '4150000001')->first();
    expect($job)->not->toBeNull();
    expect($job->url)->toBe('https://www.linkedin.com/jobs/view/4150000001');
});

test('scraper ignores an off-site job url and stores a safe linkedin fallback', function () {
    fakeLinkedInCard('urn:li:jobPosting:4150000002', 'https://evil-linkedin.com/steal');

    (new LinkedInJobScraper)->run(30);

    expect(JobListing::where('external_id', '4150000002')->value('url'))
        ->toBe('https://www.linkedin.com/jobs/view/4150000002');
});

test('scraper skips a card whose posting id is not numeric', function () {
    fakeLinkedInCard('urn:li:jobPosting:not-a-number', 'https://www.linkedin.com/jobs/view/x');

    $stats = (new LinkedInJobScraper)->run(30);

    expect(JobListing::count())->toBe(0);
    expect($stats['found'])->toBe(0);
});

test('the scrape command warns when no job cards are parsed', function () {
    Http::fake(['*' => Http::response('', 200)]);

    $this->artisan('jobs:scrape')
        ->expectsOutputToContain('No job cards were parsed')
        ->assertSuccessful();
});

test('the scrape command does not false-alarm when parsed jobs are all duplicates', function () {
    fakeLinkedIn(RELEVANT_DESCRIPTION);
    JobListing::factory()->create(['external_id' => '4159232303']);
    JobListing::factory()->create(['external_id' => '4159999999']);

    $this->artisan('jobs:scrape')
        ->doesntExpectOutputToContain('markup may have changed')
        ->assertSuccessful();
});
