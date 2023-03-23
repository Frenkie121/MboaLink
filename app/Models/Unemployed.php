<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{MorphOne};

class Unemployed extends Model
{
    use HasFactory;

    protected $fillable = ['diploma', 'qualifications', 'current_job', 'aptitudes'];

    // RELATIONSHIPS
    public function talent(): MorphOne
    {
        return $this->morphOne(Talent::class, 'talentable');
    }
}
