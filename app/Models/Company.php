<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany, MorphOne};
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'location', 'description', 'url', 'logo',
    ];
    
    // ACCESSORS
    public function getLogoAttribute($logo) : string
    {
        return $logo ? route('company-logo', $logo) : asset('assets/front/img/job-default.png');
    }

    // RELATIONSHIPS
    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
