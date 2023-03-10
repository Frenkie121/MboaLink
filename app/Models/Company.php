<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'location', 'description', 'url', 'logo',
    ];

    // MUTATORS
    
    public function logo(): Attribute
    {
        return Attribute::make(
            get: fn($logo) => asset("storage/services/{$logo}"),
            set: function($logo){
                $name = uniqid('company') . '.' . $logo->extension();
                $logo->storeAs('public/companies/', $name);
                return $this->attributes['logo'] = $name;
            }
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
}
