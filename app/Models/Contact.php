<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Contact extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'subject', 'message', 'response',
    ];

    // ACCESSORS
    public function getCreatedAtAttribute($created_at)
    {
        return formatedLocaleDate($created_at);
    }
    
    public function getUpdatedAtAttribute($updated_at)
    {
        return formatedLocaleDate($updated_at);
    }
}
