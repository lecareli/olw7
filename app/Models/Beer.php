<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

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

    protected function casts(): array
    {
        return [
            'first_brewed_at' => 'date',
            'abv' => 'decimal:1',
            'ibu' => 'integer',
            'ebc' => 'integer',
            'ph' => 'decimal:2',
            'volume' => 'integer',
        ];
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function cover(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')->where('is_cover', true);
    }

    public function stores(): BelongsToMany
    {
        return $this->belongsToMany(Store::class)
            ->using(BeerStore::class)
            ->withPivot('price', 'url', 'promo_label')
            ->withTimestamps();
    }
}
