# LinkedIn Job Feed

An admin-curated feed of Laravel/PHP job postings scraped from LinkedIn. A daily
command pulls postings into a review queue; an admin approves, rejects, or
imports the employer into the company listing. Approved jobs are posted to Slack.

## How it works

1. **Scrape** — `jobs:scrape` runs a set of single-keyword searches against
   LinkedIn's public `jobs-guest` endpoint and stores new postings in
   `job_listings` with status `pending`.
2. **Verify relevance** — LinkedIn's keyword search is fuzzy and pads sparse
   result sets with unrelated "backend" roles, so each posting's full
   description is fetched and kept only if it mentions one of the stack terms
   (`laravel`, `php`, `symfony`). Everything else is skipped.
3. **Review** — admins manage the queue at `/admin/jobs`. Approving queues a
   Slack post (see *Queue worker* below); rejecting hides it; "Add to companies"
   creates a pending `Company` from the employer.

Single-keyword searches are used deliberately: LinkedIn's `OR` operator falls
back to loose relevance matching and returns fewer, muddier results than
separate searches.

## Setup

```bash
composer require symfony/dom-crawler symfony/css-selector
php artisan migrate
```

Both packages are required — the scraper parses HTML with `DomCrawler` and uses
CSS selectors (`css-selector`).

### Environment

Slack posting reuses `config/services.php` → `slack.notifications`. Set in `.env`:

```dotenv
SLACK_BOT_USER_OAUTH_TOKEN=xoxb-…         # bot token, needs chat:write scope
SLACK_BOT_USER_DEFAULT_CHANNEL=C3M6W0G4B  # #job-postings (channel ID is more robust than name)
```

The Slack app's bot must be installed in the workspace and **invited to the
channel** (`/invite @yourbot`). After changing `.env`, run `php artisan config:clear`.

If Slack isn't configured, Approve still marks the job approved — it just skips
the post and flashes a notice.

### Queue worker

Approving dispatches a queued `PostJobToSlack` job rather than posting inline, so
the admin request returns immediately. The post only actually fires when a queue
worker is running:

```bash
php artisan queue:work
```

With `QUEUE_CONNECTION=sync` the job runs inline (the old blocking behaviour). On
any real queue connection (`database`, `redis`, …) a worker **must** be running or
approved jobs will never reach Slack. The job is idempotent — it no-ops if the
listing already has `posted_to_slack_at`.

## Running

```bash
php artisan jobs:scrape            # default: postings from the last 30 days
php artisan jobs:scrape --days=7   # last 7 days
php artisan jobs:scrape --days=0   # no date filter
```

The command prints a summary: Found / New (pending) / Duplicates in run /
Skipped (not PHP/Laravel). It warns when a run parses zero cards at all — the
signal that LinkedIn changed their markup or blocked the requests.

### Scheduling

`routes/console.php` schedules a daily run at 06:00 (`->withoutOverlapping()`).
For it to fire in production, the Laravel scheduler must be running, e.g. cron:

```
* * * * * cd /path/to/website && php artisan schedule:run >> /dev/null 2>&1
```

## Configuring searches

Searches are defined in `LinkedInJobScraper::searches()`. Each entry is one
location + one keyword:

```php
['label' => 'Sweden — Laravel', 'keywords' => 'laravel', 'geoId' => self::GEO_SWEDEN],
['label' => 'Copenhagen — PHP', 'keywords' => 'php', 'location' => 'Copenhagen, Denmark'],
['label' => 'Remote EU — Laravel', 'keywords' => 'laravel', 'location' => 'European Union', 'remote' => true],
```

- `geoId` — precise LinkedIn location id (e.g. Sweden = `105117694`). Find one by
  running a search on linkedin.com and copying `geoId` from the URL.
- `location` — free-text, geocoded by LinkedIn. Simpler but less exact.
- `remote` — `true` adds the remote filter (`f_WT=2`).

The `label` should follow the `Region — Keyword` shape: the admin list derives
the displayed keyword from the part after the em dash (`—`).

If you add or remove a search, update the hard-coded counts in
`tests/Feature/JobScraperTest.php` (the parse test asserts exact Found/Duplicate
totals across the 7 searches, on purpose, so the suite fails loudly when the
search set changes).

### Relevance terms

Controlled by `LinkedInJobScraper::RELEVANCE_TERMS` (`laravel`, `php`, `symfony`).
A posting is kept if its description contains any term; if the description can't
be fetched, the title is used as a fallback. Widen this list to catch adjacent
ecosystems (e.g. `wordpress`, `magento`, `drupal`).

## Admin UI

`/admin/jobs` (auth + admin middleware). Pending jobs sort first, then Swedish
jobs ahead of the rest, then newest. Each row's `⋯` menu offers Approve & post to
Slack, Reject, Add to companies, and View on LinkedIn. Filter by status with the
dropdown.

## Data model

`job_listings`:

- `external_id` — LinkedIn posting id, `unique`. The dedup key: the same ad
  matching several searches is stored once (tagged with the first search's
  label). Re-posts under a new LinkedIn id are treated as new jobs.
- `status` — `pending` | `approved` | `rejected`.
- `company_id` — set when the employer is imported into the listing.
- `description`, `posted_date`, `approved_at`, `posted_to_slack_at`, `search_label`, `source`.

## Audit log (who approved/rejected)

Status changes are recorded with [spatie/laravel-activitylog](https://spatie.be/docs/laravel-activitylog).
The `JobListing`, `Company`, and `Talk` models use the `LogsActivity` trait
configured to log only the `status` field; the causer (the acting admin) is
resolved automatically from the authenticated user. Records land in one shared
`activity_log` table.

Install (required — the app won't boot without the package once the models
reference its trait):

```bash
composer require spatie/laravel-activitylog
php artisan migrate   # auto-registers create_activity_log_table; no vendor:publish needed
```

v5 requires PHP 8.4+ and Laravel 12, and moved the trait namespace to
`Spatie\Activitylog\Models\Concerns\LogsActivity` (with `LogOptions` under
`Spatie\Activitylog\Support`). The admin job list shows "by {name}" under
the status of any reviewed job (`JobListing::last_reviewer` accessor reads the
latest activity's causer). Scraper inserts use `insertOrIgnore`, which bypasses
Eloquent events, so automated scraping doesn't create log noise.

## Files

- `app/Services/LinkedInJobScraper.php` — scraping, pagination, relevance filter.
- `app/Services/SlackNotifier.php` — posts an approved job to Slack.
- `app/Jobs/PostJobToSlack.php` — queued job that posts an approved listing to Slack.
- `app/Console/Commands/ScrapeJobListings.php` — the `jobs:scrape` command.
- `app/Livewire/Admin/JobList.php` + `resources/views/livewire/admin/job-list.blade.php` — admin UI.
- `app/Models/JobListing.php` — model, `pending` scope, `keyword` / `short_location` accessors.
- `database/migrations/2026_06_27_000001_create_job_listings_table.php`
- `routes/console.php` (schedule), `routes/web.php` (route), `resources/views/components/admin-nav.blade.php` (nav link)
- Tests: `tests/Feature/JobScraperTest.php`, `AdminJobTest.php`, `JobListingModelTest.php`; factory `database/factories/JobListingFactory.php`.

## Testing

```bash
php artisan test --filter='JobScraperTest|AdminJobTest|JobListingModelTest'
```

All HTTP is faked — tests never hit LinkedIn or Slack. Note: `Http::fake()`
*appends* stubs (first match wins), so each test installs its own fake exactly
once. This means the tests verify parsing/dedup/relevance logic, not LinkedIn's
live markup — if LinkedIn changes their HTML, the live scraper can break while
tests still pass. The zero-cards warning in `jobs:scrape` is the runtime signal
for that.

## Troubleshooting

- **`Class "Symfony\Component\DomCrawler\Crawler" not found`** — run the
  `composer require` above.
- **Jobs approved but nothing in Slack** — check the two `.env` vars, that the
  bot has `chat:write`, and that it's invited to the channel; then `config:clear`.
- **Mostly irrelevant jobs** — expected upstream noise; the relevance filter
  drops them. Check the "Skipped" count in the command output.
- **A run finds cards but stores none** — likely a LinkedIn markup change or a
  block; inspect `storage/logs` for the scrape warnings.

## Legal note

This scrapes LinkedIn, which is against their ToS, and republishing job/company
data publicly can raise GDPR questions. Keeping the feed as an internal,
admin-curated queue (rather than auto-publishing) is the lower-risk pattern.
