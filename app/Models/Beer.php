<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    protected $fillable = [
        'name',
        'tagline',
        'description',
        'first_brewed_at',
        'abv',
        'ibu',
        'ebc',
        'ph',
        'volume',
        'ingredients',
        'brewers_tips',
    ];

    protected $casts = [
        'first_brewed_at' => 'date',
    ];
}
