<?php

namespace App\Models;

use Database\Factories\TalkFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Talk extends Model
{
    /** @use HasFactory<TalkFactory> */
    use HasFactory;

    use LogsActivity;

    public const STATUSES = ['pending', 'interested', 'scheduled', 'done', 'rejected'];

    /**
     * Log status changes (who moved the talk through the pipeline) to the
     * activity_log table. The causer is resolved automatically from the
     * authenticated user.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status'])
            ->logOnlyDirty()
            ->dontLogEmptyChanges()
            ->useLogName('talk')
            ->setDescriptionForEvent(fn (string $event): string => "talk status {$event}");
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'cities',
        'position',
        'company',
        'twitter',
        'linkedin',
        'github',
        'bluesky',
        'facebook',
        'instagram',
        'notes',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'cities' => 'array',
        ];
    }

    /**
     * Get the user who submitted the talk.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function setStatusAttribute(string $value): void
    {
        if (! in_array($value, self::STATUSES)) {
            throw new \InvalidArgumentException("Invalid talk status: {$value}");
        }

        $this->attributes['status'] = $value;
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeInterested(Builder $query): Builder
    {
        return $query->where('status', 'interested');
    }

    public function scopeScheduled(Builder $query): Builder
    {
        return $query->where('status', 'scheduled');
    }

    public function scopeDone(Builder $query): Builder
    {
        return $query->where('status', 'done');
    }

    public function scopeRejected(Builder $query): Builder
    {
        return $query->where('status', 'rejected');
    }
}
