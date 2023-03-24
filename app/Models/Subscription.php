<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasMany};

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['duration', 'amount', 'type'];

    const TYPE = [
        1 => 'Company',
        2 => 'Student',
        3 => 'Pupil',
        4 => 'Unemployed',
        5 => 'Free',
    ];

    // MUTATORS
    public function getTypeAttribute($type)
    {
        return __(self::TYPE[$type]);
    }

    // RELATIONSHIPS
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
                    ->withPivot(['amount', 'starts_at', 'ends_at']);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }
}
