<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, MorphTo, MorphOne};
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Talent extends Model
{
    use HasFactory;

    protected $fillable = ['aspiration', 'language', 'location', 'cv', 'category_id', 'birth_date'];

    const LANGUAGES = [
        1 => 'English',
        2 => 'French',
        3 => 'Bilingual',
    ];

    // ACCESSORS
    public function getLanguageAttribute($language): string
    {
        if ($language === 'en') {
            $key = 1;
        } elseif ($language === 'fr') {
            $key = 2;
        } else {
            $key = 3;
        }

        return __(self::LANGUAGES[$key]);
    }

    // RELATIONSHIPS
    public function talentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class)
                ->withTimestamps(updatedAt: null)
                ->withPivot('created_at')
                ->orderByPivot('created_at', 'DESC');
    }

    
    // CUSTOM METHODS
    public function hasApplied(Job $job): bool
    {
        return $this->jobs->contains($job);
    }
}
