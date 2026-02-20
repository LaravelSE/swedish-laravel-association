<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardMember extends Model
{
    /** @use HasFactory<\Database\Factories\BoardMemberFactory> */
    use HasFactory;

    /** @var list<string> */
    protected $fillable = ['name', 'role', 'company', 'image_path', 'sort_order'];

    public function imageUrl(): ?string
    {
        if (! $this->image_path) {
            return null;
        }

        if (str_starts_with($this->image_path, 'board-members/')) {
            return asset('storage/'.$this->image_path);
        }

        return asset($this->image_path);
    }
}
