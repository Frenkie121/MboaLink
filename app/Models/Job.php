<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'sub_category_id', 'location', 'description', 'salary', 'type', 'dateline',
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
        return formatedLocaleDate($dateline);
    }

    public function getCreatedAtAttribute($created_at)
    {
        return formatedLocaleDate($created_at);
    }

    // public function getPublishedAtAttribute($published_at)
    // {
    //     return formatedLocaleDate($published_at);
    // }

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
     * @param  Illuminate\Database\Eloquent\Builder  $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at');
    }

    /**
     * Scope thee query to only include jobs for which the dateline has not yet passed
     *
     * @param  Illuminate\Database\Eloquent\Builder  $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->whereDate('dateline', '>', today());
    }
}
