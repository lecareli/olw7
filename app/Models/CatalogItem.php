<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
