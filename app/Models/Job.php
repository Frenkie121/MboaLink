<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'location', 'description', 'salary', 'type', 'dateline',
    ];

    protected $casts = [
        'dateline' => 'date:d-m,Y'
    ];

    const TYPES = [
        1 => 'FULL-TIME',
        2 => 'PART-TIME',
        3 => 'INTERNSHIP',
        4 => 'FREELANCE',
        5 => 'REMOTE'
    ];

    // ACCESSORS

    // MUTATORS

    // RELATIONSHIPS
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
