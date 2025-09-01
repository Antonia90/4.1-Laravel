<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['diet_category', 'name', 'description', 'base_servings'];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients')
            ->using(RecipeIngredient::class)
            ->withPivot('unit', 'quantity_per_serving');
    }
}
