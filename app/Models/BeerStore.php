<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BeerStore extends Pivot
{
    protected $table = 'beer_store';
    protected $fillable = [
        'price',
        'url',
        'promo_label',
        'beer_id',
        'store_id',
    ];

    public function beer()
    {
        return $this->belongsTo(Beer::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
