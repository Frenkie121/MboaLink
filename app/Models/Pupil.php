<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{MorphOne};

class Pupil extends Model
{
    use HasFactory;

    protected $fillable = ['school', 'cycle', 'section', 'serie', 'parent_contact', 'class'];

    // RELATIONSHIPS
    public function talent(): MorphOne
    {
        return $this->morphOne(Talent::class, 'talentable');
    }
}
