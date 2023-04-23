<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{MorphOne};

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['university', 'training_school'];

    // RELATIONSHIPS
    public function talent(): MorphOne
    {
        return $this->morphOne(Talent::class, 'talentable');
    }
}
