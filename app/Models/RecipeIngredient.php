<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RecipeIngredient extends Pivot
{
    protected $table = 'recipe_ingredients';
    protected $fillable = ['recipe_id', 'ingredient_id', 'unit', 'quantity_per_serving'];
}
