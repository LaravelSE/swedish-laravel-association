<?php

namespace App\Services;

use App\Models\JobListing;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Scrapes Laravel/PHP job postings from LinkedIn's public "jobs-guest" endpoint
 * and stores new ones in the job_listings table with status "pending".
 *
 * Native PHP port of the original Python scraper. Single-keyword searches are
 * used deliberately: LinkedIn's "OR" operator falls back to loose relevance
 * matching and returns fewer, muddier results than separate searches.
 */
class LinkedInJobScraper
{
    private const GUEST_API = 'https://www.linkedin.com/jobs-guest/jobs/api/seeMoreJobPostings/search';

    private const DETAIL_API = 'https://www.linkedin.com/jobs-guest/jobs/api/jobPosting/';

    private const GEO_SWEDEN = '105117694';

    /**
     * A job is kept only if its description (or, if that can't be fetched, its
     * title) mentions one of these terms. LinkedIn's keyword search is fuzzy and
     * pads results with unrelated "backend" roles, so we verify relevance here.
     *
     * @var list<string>
     */
    private const RELEVANCE_TERMS = ['laravel', 'php', 'symfony'];

    private const USER_AGENT = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0 Safari/537.36';

    private const MAX_PAGES = 10;             // safety cap per search (~10 cards/page)

    private const DELAY_BETWEEN_PAGES = 1;    // seconds

    private const DELAY_BETWEEN_SEARCHES = 3; // seconds

    /**
     * One entry per (location, keyword). geoId is precise; location is geocoded
     * free text. 'remote' => true filters to remote roles (f_WT=2).
     *
     * @return array<int, array<string, mixed>>
     */
    public static function searches(): array
    {
        return [
            // Priority: Sweden
            ['label' => 'Sweden — Laravel',     'keywords' => 'laravel', 'geoId' => self::GEO_SWEDEN],
            ['label' => 'Sweden — PHP',         'keywords' => 'php',     'geoId' => self::GEO_SWEDEN],
            ['label' => 'Sweden — Symfony',     'keywords' => 'symfony', 'geoId' => self::GEO_SWEDEN],

            // Priority: Copenhagen (close to Malmö)
            ['label' => 'Copenhagen — Laravel', 'keywords' => 'laravel', 'location' => 'Copenhagen, Denmark'],
            ['label' => 'Copenhagen — PHP',     'keywords' => 'php',     'location' => 'Copenhagen, Denmark'],
            ['label' => 'Copenhagen — Symfony', 'keywords' => 'symfony', 'location' => 'Copenhagen, Denmark'],

            // Alternative: remote Laravel across the EU
            ['label' => 'Remote EU — Laravel',  'keywords' => 'laravel', 'location' => 'European Union', 'remote' => true],
        ];
    }

    /**
     * Run all searches.
     *
     * @return array{found:int,new:int,duplicates:int,skipped_irrelevant:int}
     */
    public function run(int $days = 30): array
    {
        $seen = [];
        $stats = ['found' => 0, 'new' => 0, 'duplicates' => 0, 'skipped_irrelevant' => 0];
        $searches = self::searches();

        foreach ($searches as $i => $search) {
            if ($i > 0) {
                $this->pause(self::DELAY_BETWEEN_SEARCHES);
            }
            $this->runSearch($search, $days, $seen, $stats);
        }

        return $stats;
    }

    /**
     * Polite pause between requests, skipped while running tests.
     */
    private function pause(int $seconds): void
    {
        if (! app()->runningUnitTests()) {
            sleep($seconds);
        }
    }

    /**
     * Run a single search across paginated result pages.
     *
     * @param  array<string, mixed>  $search
     * @param  array<string, bool>  $seen  Job ids already handled this run (by reference)
     * @param  array<string, int>  $stats  Aggregate counters (by reference)
     */
    private function runSearch(array $search, int $days, array &$seen, array &$stats): void
    {
        $start = 0;

        for ($page = 0; $page < self::MAX_PAGES; $page++) {
            try {
                $response = Http::withHeaders(['User-Agent' => self::USER_AGENT])
                    ->retry(3, 2000, throw: false)
                    ->timeout(20)
                    ->get(self::GUEST_API, $this->params($search, $days, $start));
            } catch (\Throwable $e) {
                Log::warning("LinkedIn scrape failed for [{$search['label']}] page {$page}: {$e->getMessage()}");
                break;
            }

            if (! $response->successful()) {
                Log::warning("LinkedIn scrape HTTP {$response->status()} for [{$search['label']}] page {$page}");
                break;
            }

            $cards = (new Crawler($response->body()))->filter('div.base-card');
            if ($cards->count() === 0) {
                break; // no more results
            }

            $cards->each(function (Crawler $card) use ($search, &$seen, &$stats): void {
                $job = $this->parseCard($card, $search);
                if ($job === null) {
                    return;
                }
                $stats['found']++;

                if (isset($seen[$job['external_id']])) {
                    $stats['duplicates']++;

                    return;
                }
                $seen[$job['external_id']] = true;

                // Already stored from a previous run: skip without re-fetching detail.
                if (JobListing::query()->where('external_id', $job['external_id'])->exists()) {
                    $stats['duplicates']++;

                    return;
                }

                // Verify the posting genuinely concerns our stack before storing.
                $description = $this->fetchDescription($job['external_id']);
                if (! $this->isRelevant($description, $job['title'])) {
                    $stats['skipped_irrelevant']++;

                    return;
                }
                $job['description'] = $description;

                // insertOrIgnore relies on the unique external_id index for dedup
                // against jobs already in the database.
                $inserted = JobListing::query()->insertOrIgnore(array_merge($job, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));

                if ($inserted) {
                    $stats['new']++;
                }
            });

            $start += $cards->count();
            $this->pause(self::DELAY_BETWEEN_PAGES);
        }
    }

    /**
     * Build query parameters for a search + pagination offset.
     *
     * @param  array<string, mixed>  $search
     * @return array<string, string>
     */
    private function params(array $search, int $days, int $start): array
    {
        $params = [
            'keywords' => $search['keywords'],
            'start' => (string) $start,
        ];

        if (! empty($search['geoId'])) {
            $params['geoId'] = $search['geoId'];
        }
        if (! empty($search['location'])) {
            $params['location'] = $search['location'];
        }
        if ($days > 0) {
            $params['f_TPR'] = 'r'.($days * 86400); // seconds
        }
        if (! empty($search['remote'])) {
            $params['f_WT'] = '2'; // Remote
        }

        return $params;
    }

    /**
     * Parse a single job card into a row, or null if it should be skipped.
     *
     * @param  array<string, mixed>  $search
     * @return array<string, mixed>|null
     */
    private function parseCard(Crawler $card, array $search): ?array
    {
        $urn = $card->attr('data-entity-urn') ?? '';
        $externalId = Str::afterLast($urn, ':');
        if (! ctype_digit($externalId)) {
            return null; // missing or non-numeric posting id — not a usable card
        }

        $text = static function (Crawler $node, string $selector): ?string {
            $el = $node->filter($selector);

            return $el->count() ? trim($el->first()->text()) : null;
        };

        $title = $text($card, 'h3.base-search-card__title') ?? 'Unknown Title';
        $company = $text($card, 'h4.base-search-card__subtitle') ?? 'Unknown Company';
        $location = $text($card, 'span.job-search-card__location');

        $link = $card->filter('a.base-card__full-link');
        $href = $link->count() ? ($link->first()->attr('href') ?? '') : '';
        $url = $this->safeJobUrl($href, $externalId);

        $timeEl = $card->filter('time');
        $postedDate = null;
        if ($timeEl->count()) {
            $dt = $timeEl->first()->attr('datetime');
            $postedDate = $dt ?: null;
        }

        return [
            'external_id' => $externalId,
            'source' => 'linkedin',
            'search_label' => $search['label'],
            'title' => $title,
            'company_name' => $company,
            'location' => $location,
            'url' => $url,
            'posted_date' => $postedDate,
            'status' => 'pending',
        ];
    }

    /**
     * Accept the scraped href only if it is an https LinkedIn URL; otherwise fall
     * back to the canonical job-view URL. Guards against javascript:/data: or
     * off-site hrefs from changed/hostile markup ending up in an admin-clicked link.
     */
    private function safeJobUrl(string $href, string $externalId): string
    {
        $fallback = "https://www.linkedin.com/jobs/view/{$externalId}";

        if ($href === '') {
            return $fallback;
        }

        $href = Str::before($href, '?'); // strip tracking query string
        $host = strtolower((string) parse_url($href, PHP_URL_HOST));
        $isLinkedIn = $host === 'linkedin.com' || str_ends_with($host, '.linkedin.com');

        return (parse_url($href, PHP_URL_SCHEME) === 'https' && $isLinkedIn) ? $href : $fallback;
    }

    /**
     * Fetch the full text of a single job posting, or null if it can't be loaded.
     */
    private function fetchDescription(string $externalId): ?string
    {
        try {
            $response = Http::withHeaders(['User-Agent' => self::USER_AGENT])
                ->retry(2, 1500, throw: false)
                ->timeout(20)
                ->get(self::DETAIL_API.$externalId);
        } catch (\Throwable $e) {
            Log::warning("LinkedIn detail fetch failed for {$externalId}: {$e->getMessage()}");

            return null;
        } finally {
            $this->pause(1);
        }

        if (! $response->successful()) {
            return null;
        }

        $text = trim((new Crawler($response->body()))->text(''));

        return $text !== '' ? $text : null;
    }

    /**
     * A job is relevant if its description mentions one of the stack terms.
     * If the description is unavailable, fall back to the title.
     */
    private function isRelevant(?string $description, string $title): bool
    {
        return Str::contains($description ?: $title, self::RELEVANCE_TERMS, ignoreCase: true);
    }
}
