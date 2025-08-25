<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    protected $fillable = [
        'title',
        'starts_at',
        'ends_at',
        'teaser',
        'description',
        'schedule',
        'location',
        'registration_url',
        'registration_text',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'schedule' => 'array', // Assuming schedule is stored as an array
    ];

    public function organisers(): BelongsToMany
    {
        return $this->belongsToMany(Organizer::class)
            ->withPivot('blurb');
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('starts_at', '>=', now())->orderBy('starts_at', 'asc');
    }

    public function scopePast(Builder $query): Builder
    {
        return $query->where('ends_at', '<', now())->orderBy('starts_at', 'desc');
    }
}
