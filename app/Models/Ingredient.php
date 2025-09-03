<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    use HasFactory;
    
    protected $fillable = ['ingredient_type', 'name'];

    // Lista blanca para validar tipos
    public const TYPES = ['vegetable', 'fruit', 'protein', 'dairy', 'spice', 'other'];

    // Scopes para filtros
    public function scopeType($q, ?string $type)
    {
        if ($type) $q->where('ingredient_type', $type);
    }

    public function scopeSearch($q, ?string $term)
    {
        if ($term) $q->where('name', 'like', "%{$term}%");
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_ingredients')
            ->using(RecipeIngredient::class)
            ->withPivot('unit', 'quantity_per_serving');
    }
}
