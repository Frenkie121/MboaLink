<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'category_id'];

    // MUTATORS
    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // RELATIONSHIPS
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }
    
    // SCOPES
    public function scopeHasJobs(Builder $query): Builder
    {
        return $query->whereHas('jobs', fn (Builder $query)
            => $query->where('is_published', true)
        );
    }
}
