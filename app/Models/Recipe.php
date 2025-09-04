<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'diet_category', 'name', 'description', 'base_servings'];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients')
            ->using(RecipeIngredient::class)
            ->withPivot('unit', 'quantity_per_serving');
    }

    /**
     * Get the available diet categories.
     *
     * @return array
     */
    public static function getDietCategories()
    {
        return [
            'vegan',
            'vegetarian',
            'omnivore',
        ];
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
