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
        Schema::create('recipe_ingredients', function (Blueprint $table) {
            $table->unsignedBigInteger('recipe_id');
            $table->unsignedBigInteger('ingredient_id');
            $table->enum('unit', ['g', 'kg', 'ml', 'l', 'taza', 'cucharada', 'unidad'])->default('g');
            $table->decimal('quantity_per_serving', 8, 2)->default(0); // cantidad para 1 porción base
            // composite primary (opcional)
            $table->primary(['recipe_id', 'ingredient_id']);
            // FKs
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_ingredients');
    }
};
