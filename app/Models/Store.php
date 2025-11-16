<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

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

    protected function casts(): array
    {
        return [
            'opening_hours' => 'array',
            'user_id' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function beers(): BelongsToMany
    {
        return $this->belongsToMany(Beer::class)
            ->using(BeerStore::class)
            ->withPivot('price', 'url', 'promo_label')
            ->withTimestamps();
    }

    public function catalogItems(): HasMany
    {
        return $this->hasMany(CatalogItem::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function cover(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')->where('is_cover', true);
    }
}
