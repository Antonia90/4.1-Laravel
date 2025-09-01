<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RecipeIngredient extends Pivot
{
    protected $table = 'recipe_ingredients';
    public $timestamps = false;

    protected $fillable = ['recipe_id', 'ingredient_id', 'unit', 'quantity_per_serving'];

    protected $casts = [
        'quantity_per_serving' => 'decimal:2',
    ];

    // Opcional: lista blanca de unidades para validar formularios
    public const UNITS = ['g', 'kg', 'ml', 'l', 'cup', 'tbsp', 'tsp', 'unit'];
}
