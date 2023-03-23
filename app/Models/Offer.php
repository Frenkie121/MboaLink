<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    // RELATIONSHIPS
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}
