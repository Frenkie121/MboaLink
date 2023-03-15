<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Model, SoftDeletes};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany, HasManyThrough};
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

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
        if (str_word_count($name) > 2 && strlen($name) > 25) {
            return substr($name, 0, 20).'...';
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

    // SCOPES
    public function scopeHasJobs(Builder $query): Builder
    {
        return $query->whereHas('jobs', fn (Builder $query)
            => $query->where('is_published', true)
        );
    }
}
