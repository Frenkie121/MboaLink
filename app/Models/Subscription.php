<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany};

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['duration', 'amount'];

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

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
