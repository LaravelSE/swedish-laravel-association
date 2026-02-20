<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'datetime',
        'location',
        'description',
        'details',
        'schedule',
        'footer',
        'organizers',
        'closing',
        'link',
    ];

    protected function casts(): array
    {
        return [
            'datetime' => 'datetime',
            'details' => 'array',
            'schedule' => 'array',
            'footer' => 'array',
            'organizers' => 'array',
        ];
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('datetime', '>=', now());
    }

    public function scopePast(Builder $query): Builder
    {
        return $query->where('datetime', '<', now());
    }
}
