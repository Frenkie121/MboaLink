<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\{App, Hash};
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, MorphTo};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\Password\ResetPasswordFrNotification;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'role_id',
        'phone_number',
        'slug',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        if (App::isLocale('en')) {
            $this->notify(new ResetPasswordNotification($token));
        } else {
            $this->notify(new ResetPasswordFrNotification($token));
        }
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // MUTATORS
    public function password(): Attribute
    {
        return Attribute::set(fn ($value) => Hash::make($value));
    }

    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // RELATIONSHIPS
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function userable(): MorphTo
    {
        return $this->morphTo();
    }

    public function subscriptions(): BelongsToMany
    {
        return $this->belongsToMany(Subscription::class)
                    ->withPivot(['id', 'amount', 'starts_at', 'ends_at', 'created_at']);
    }

    // CUSTOM
    /**
     * Get the current subscription instance for the authenticated user
     *
     * @return App\Models\Subscription
     * 
     */
    public function currentSubscription(): Subscription
    {
        return $this->subscriptions->filter(
                    fn ($item) => Carbon::parse($item->pivot->ends_at)->isFuture() 
                    && Carbon::parse($item->pivot->starts_at)->isPast()
                )->first()
                ?? $this->subscriptions()->first();
    }

    public function getFreeSubscriptionType()
    {
        if ($this->userable_type === 'App\Models\Company') {
            $type = 2;
        } elseif ($this->userable_type === 'App\Models\Talent') {
            if ($this->load('userable')->userable->talentable_type === 'App\Models\Student') {
                $type = 3;
            } elseif ($this->load('userable')->userable->talentable_type === 'App\Models\Pupil') {
                $type = 4;
            } else {
                $type = 5;
            }
        }
        
        return Subscription::query()->find($type);
    }

    /**
     * Check if disabled account can login
     *
     * @return bool
     * 
     */
    public function canLogin() : bool
    {
        return $this->is_active || (! $this->is_active && $this->disabled_by === $this->id);
    }
}