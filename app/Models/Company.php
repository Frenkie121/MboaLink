<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'location', 'description', 'url', 'logo',
    ];

    // ACCESSORS
    public function logo(): Attribute
    {
        return Attribute::make(
            get: fn ($logo) => $logo ? asset("storage/companies/{$logo}") : 'https://via.placeholder.com/640x480.png/f9460C?text='.$this->load('user')->user->name,
        );
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
