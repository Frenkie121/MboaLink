<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasMany};
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'duration', 'amount'];

    // ACCESSORS
    public function getNameAttribute($value): string
    {
        return __($value);
    }


    // MUTATORS
    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // RELATIONSHIPS
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
                    ->withPivot(['amount', 'starts_at', 'ends_at'])
                    ->orderByPivot('created_at', 'DESC');
    }
  
    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    // CUSTOM
    /**
     * Get the absolute number of days left for a subscription
     *
     * @return float
     * 
     */
    public function lastSubscriptionDaysLeft(): float
    {
        return Carbon::parse($this->pivot->ends_at)->floatDiffInDays(now());
    }
    
    /**
     * Check if a subscription is same as another one (Just to mark it in the dashboard history)
     *
     * @param Subscription $subscription
     * 
     * @return bool
     * 
     */
    public function isSameAs(Subscription $subscription): bool
    {
        return $this->pivot->id === $subscription->pivot->id;
    }
}
