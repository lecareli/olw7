<?php

use App\Models\Address;
use App\Models\Beer;
use App\Models\BeerStore;
use App\Models\CatalogItem;
use App\Models\Image;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Tests\TestCase;

uses(TestCase::class);

it('defines the beer attributes and relationships', function () {
    $beer = new Beer;

    expect($beer->getFillable())->toBe([
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
    ]);

    expect($beer->images())->toBeInstanceOf(MorphMany::class);
    expect($beer->cover())->toBeInstanceOf(MorphOne::class);

    $storesRelation = $beer->stores();

    expect($storesRelation)->toBeInstanceOf(BelongsToMany::class)
        ->and($storesRelation->getPivotClass())->toBe(BeerStore::class);
});

it('defines the store attributes and relationships', function () {
    $store = new Store;

    expect($store->getFillable())->toBe([
        'name',
        'slug',
        'website',
        'phone',
        'opening_hours',
        'user_id',
    ]);

    expect($store->user())->toBeInstanceOf(BelongsTo::class);
    expect($store->address())->toBeInstanceOf(HasOne::class);

    $beersRelation = $store->beers();
    expect($beersRelation)->toBeInstanceOf(BelongsToMany::class)
        ->and($beersRelation->getPivotClass())->toBe(BeerStore::class);

    expect($store->catalogItems())->toBeInstanceOf(HasMany::class);
});

it('defines the address attributes and relationships', function () {
    $address = new Address;

    expect($address->getFillable())->toBe([
        'zip',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'latitude',
        'longitude',
        'store_id',
    ]);

    expect($address->store())->toBeInstanceOf(BelongsTo::class);
});

it('defines the catalog item attributes and relationships', function () {
    $catalogItem = new CatalogItem;

    expect($catalogItem->getFillable())->toBe([
        'name',
        'url',
        'description',
        'ingredients',
        'price',
        'store_id',
    ]);

    expect($catalogItem->store())->toBeInstanceOf(BelongsTo::class);
});

it('defines the image attributes and relationships', function () {
    $image = new Image;

    expect($image->getFillable())->toBe([
        'imageable_id',
        'imageable_type',
        'path',
        'is_cover',
    ]);

    expect($image->imageable())->toBeInstanceOf(MorphTo::class);
});

it('defines the beer store pivot attributes and relationships', function () {
    $beerStore = new BeerStore;

    expect($beerStore->getFillable())->toBe([
        'price',
        'url',
        'promo_label',
        'beer_id',
        'store_id',
    ]);

    expect($beerStore->beer())->toBeInstanceOf(BelongsTo::class);
    expect($beerStore->store())->toBeInstanceOf(BelongsTo::class);
});

it('defines the user relationships', function () {
    $user = new User;

    expect($user->stores())->toBeInstanceOf(HasMany::class);
});
