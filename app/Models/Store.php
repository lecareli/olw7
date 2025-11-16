<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'stores';
    protected $fillable = [
        'name',
        'slug',
        'website',
        'phone',
        'opening_hours',
        'user_id',
    ];

    protected $casts = [
        'opening_hours' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function beers()
    {
        return $this->belongsToMany(Beer::class, 'beer_store')->withPivot('price', 'url', 'promo_label');
    }
}
