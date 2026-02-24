<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Talk extends Model
{
    /** @use HasFactory<\Database\Factories\TalkFactory> */
    use HasFactory;

    public const STATUSES = ['pending', 'interested', 'scheduled', 'done', 'rejected'];

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
