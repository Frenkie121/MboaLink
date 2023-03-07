<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};

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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // ACCESSORS

    // MUTATORS
    public function setTitleAttribute($value): void
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // RELATIONSHIPS
    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
