<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'location', 'description', 'salary', 'type', 'dateline',
    ];

    protected $casts = [
        'dateline' => 'date:d-m,Y',
    ];

    const TYPES = [
        1 => 'Full Time',
        2 => 'Part Time',
        3 => 'Internship',
        4 => 'Freelance',
        5 => 'Remote',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // ACCESSORS
    public function getDatelineAttribute($dateline)
    {
        return date_format(Carbon::make($dateline), 'F d, Y');
    }

    public function getTypeAttribute($type)
    {
        return self::TYPES[$type];
    }

    // MUTATORS
    public function setTitleAttribute($value): void
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // RELATIONSHIPS
    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
