<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Talent extends Model
{
    use HasFactory;

    protected $fillable = ['aspiration', 'language', 'residence', 'cv'];

    const LANGUAGES = [
        1 => 'English',
        2 => 'French',
        3 => 'Bilingual',
    ];

    // MUTATORS
    public function getLanguageAttribute($key)
    {
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

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
