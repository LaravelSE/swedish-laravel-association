<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;

    /** @var list<string> */
    public const STATUSES = ['pending', 'approved', 'rejected'];

    /**
     * Available company sizes.
     *
     * @var list<string>
     */
    public const SIZES = ['1-10', '11-50', '51-200', '200+'];

    /**
     * Available submitter relationships.
     *
     * @var list<string>
     */
    public const SUBMITTER_RELATIONSHIPS = ['I work there', 'I know someone', 'Public information', 'Other'];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'city',
        'website',
        'industry',
        'size',
        'description',
        'contact_email',
        'phone',
        'address',
        'logo_path',
        'linkedin',
        'github',
        'twitter',
        'submitter_relationship',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_sponsor' => 'boolean',
        ];
    }

    public function setStatusAttribute(string $value): void
    {
        if (! in_array($value, self::STATUSES)) {
            throw new \InvalidArgumentException("Invalid company status: {$value}");
        }

        $this->attributes['status'] = $value;
    }

    /**
     * Scope to only approved companies.
     */
    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope to only pending companies.
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to only rejected companies.
     */
    public function scopeRejected(Builder $query): Builder
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Get the user who submitted the company.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
