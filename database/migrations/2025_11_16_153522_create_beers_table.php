<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tagline')->nullable();
            $table->text('description')->nullable();
            $table->date('first_brewed_at');
            $table->decimal('abv', 4, 1)->comment('Alcohol by Volume (teor alcoólico)');
            $table->integer('ibu')->comment('International Bitterness Units (indice de amargor)');
            $table->integer('ebc')->comment('European Brewery Convention (indice de color)');
            $table->decimal('ph', 4, 2)->comment('Ph');
            $table->integer('volume')->comment('Volume (ml)');
            $table->text('ingredients')->nullable();
            $table->text('brewers_tips')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beers');
    }
};
