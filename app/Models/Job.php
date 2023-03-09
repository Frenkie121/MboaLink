<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Builder, Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany};
use Illuminate\Support\Str;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'location', 'description', 'salary', 'type', 'dateline',
    ];

    protected $casts = [
        'dateline' => 'date:d-m,Y',
    ];

    const TYPES = [
        1 => 'Full Time',
        2 => 'Part Time',
        3 => 'Internship',
        4 => 'Freelance',
        5 => 'Remote',
    ];

    // ACCESSORS
    public function getDatelineAttribute($dateline)
    {
        return date_format(Carbon::make($dateline), 'F d, Y');
    }

    public function getCreatedAtAttribute($created_at)
    {
        return date_format(Carbon::make($created_at), 'F d, Y');
    }

    public function getTypeAttribute($type)
    {
        return self::TYPES[$type];
    }

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

    public function requirements(): HasMany
    {
        return $this->hasMany(Requirement::class);
    }

    public function qualifications(): HasMany
    {
        return $this->hasMany(Qualification::class);
    }

    // SCOPES
    /**
     * Scope the query to only include pusblished jobs
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * 
     * @return Illuminate\Database\Eloquent\Builder
     * 
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }
}
