<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{HasMany};

class Role extends Model
{
    use HasFactory;

    // ACCESSORS
    public function getNameAttribute()
    {
        return $this->attributes[app()->getLocale() . '_name'];
    }

    // RELATIONSHIPS
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
