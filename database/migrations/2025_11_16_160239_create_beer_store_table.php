<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('beer_store', function (Blueprint $table) {
            $table->id();
            $table->integer('price');
            $table->string('url');
            $table->string('promo_label')->nullable();
            
            $table->foreignId('beer_id')->constrained('beers')->cascadeOnDelete();
            $table->foreignId('store_id')->constrained('stores')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beer_store');
    }
};
