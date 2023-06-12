<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Model, SoftDeletes};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{HasMany, HasManyThrough};
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'disabled_at'];

    protected $dates = [
        'disabled_at'
    ];

    // MUTATORS
    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // ACCESSORS

    public function getShortNameAttribute(): string
    {
        $name = $this->attributes['name'];
        if (str_word_count($name) > 2 && strlen($name) > 17) {
            return substr($name, 0, 17).'...';
        }

        return $name;
    }

    // RELATIONSHIPS
    public function subCategories(): HasMany
    {
        return $this->hasMany(SubCategory::class);
    }

    public function jobs(): HasManyThrough
    {
        return $this->hasManyThrough(Job::class, SubCategory::class);
    }

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    // SCOPES
    public function scopeHasJobs(Builder $query): Builder
    {
        return $query->whereHas('jobs', fn (Builder $query) => $query->whereNotNull('published_at')
        );
    }

    public function scopeEnabled(Builder $query)
    {
        return $query->where('disabled_at', null);
    }
}
