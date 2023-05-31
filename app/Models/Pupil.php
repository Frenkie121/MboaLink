<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{MorphOne};

class Pupil extends Model
{
    use HasFactory;

    protected $fillable = ['school', 'cycle', 'section', 'serie', 'parent_contact', 'class'];

    // ACCESSORS
    public function getSectionAttribute($value): string
    {
        return __(config('subscriptions.section')[$value]);
    }

    public function getCycleAttribute($value): string
    {
        return __(config('subscriptions.cycle')[$value]);
    }

    // RELATIONSHIPS
    public function talent(): MorphOne
    {
        return $this->morphOne(Talent::class, 'talentable');
    }
}
