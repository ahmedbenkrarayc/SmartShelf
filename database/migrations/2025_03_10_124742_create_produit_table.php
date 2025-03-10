<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produit', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->float('price');
            $table->integer('stock');
            $table->integer('is_promotion')->default(0);
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('rayon_id');
            $table->foreign('category_id')->references('id')->on('category');
            $table->foreign('rayon_id')->references('id')->on('rayon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produit');
    }
};
