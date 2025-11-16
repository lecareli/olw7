<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
   protected $table = 'beers';
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

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'beer_store')->withPivot('price', 'url', 'promo_label');
    }
}
