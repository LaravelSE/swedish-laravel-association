<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Talk extends Model
{
    /** @use HasFactory<\Database\Factories\TalkFactory> */
    use HasFactory;

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
}
