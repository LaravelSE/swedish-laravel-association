<?php

namespace App\Models;

use Database\Factories\JobListingFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class JobListing extends Model
{
    /** @use HasFactory<JobListingFactory> */
    use HasFactory;

    use LogsActivity;

    /**
     * Log status changes (who approved/rejected) to the activity_log table.
     * The causer is resolved automatically from the authenticated user.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status'])
            ->logOnlyDirty()
            ->dontLogEmptyChanges()
            ->useLogName('job_listing')
            ->setDescriptionForEvent(fn (string $event): string => "job status {$event}");
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'external_id',
        'source',
        'search_label',
        'title',
        'company_name',
        'location',
        'url',
        'description',
        'posted_date',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'posted_date' => 'date',
            'approved_at' => 'datetime',
            'posted_to_slack_at' => 'datetime',
        ];
    }

    /**
     * Scope to only pending jobs.
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    /**
     * Get the curated company this job is linked to, if any.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * The search keyword (e.g. "laravel") derived from the search label
     * (e.g. "Sweden — Laravel").
     */
    protected function keyword(): Attribute
    {
        return Attribute::get(function (): ?string {
            if (! $this->search_label) {
                return null;
            }
            $parts = explode('—', $this->search_label);

            return strtolower(trim(end($parts)));
        });
    }

    /**
     * Name of the admin who last changed this job's status, from the activity log.
     */
    protected function lastReviewer(): Attribute
    {
        return Attribute::get(function (): ?string {
            // Order by id (insertion order) — created and updated activities can
            // share the same created_at second, making created_at ordering a
            // coin-flip on ties.
            $activity = $this->relationLoaded('activitiesAsSubject')
                ? $this->activitiesAsSubject->sortByDesc('id')->first(fn ($a) => $a->causer !== null)
                : $this->activitiesAsSubject()->whereNotNull('causer_id')->latest('id')->first();

            return $activity?->causer?->name;
        });
    }

    /**
     * A concise location: "Stockholm, Stockholm County, Sweden" -> "Stockholm, Sweden".
     */
    protected function shortLocation(): Attribute
    {
        return Attribute::get(function (): ?string {
            if (! $this->location) {
                return $this->location;
            }
            $parts = array_values(array_filter(array_map('trim', explode(',', $this->location)), fn ($p) => $p !== ''));

            if (count($parts) >= 2) {
                return $parts[0].', '.end($parts);
            }

            return $parts[0] ?? $this->location;
        });
    }
}
