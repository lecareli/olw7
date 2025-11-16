<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class CatalogItem extends Model
{
    protected $table = 'catalog_items';

    protected $fillable = [
        'name',
        'url',
        'description',
        'ingredients',
        'price',
        'store_id',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'store_id' => 'integer',
        ];
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
