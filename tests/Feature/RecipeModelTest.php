<?php

use Tests\TestCase;
use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecipeModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_receta_guarda_en_db()
    {
        $recipe = Recipe::create([
            'diet_category' => 'vegan',
            'name' => 'Receta Vegana',
            'description' => 'Muy saludable',
            'base_servings' => 2
        ]);

        $this->assertDatabaseHas('recipes', [
            'name' => 'Receta Vegana',
        ]);
    }

    public function test_relacion_receta_ingrediente()
    {
        $recipe = Recipe::create([
            'diet_category' => 'vegan',
            'name' => 'Ensalada',
            'description' => 'Fresca',
            'base_servings' => 1
        ]);
        $ingredient = Ingredient::create([
            'ingredient_type' => 'vegetable',
            'name' => 'Tomate',
        ]);
        $recipe->ingredients()->attach($ingredient->id, ['unit' => 'g', 'quantity_per_serving' => 50]);
        $this->assertEquals($ingredient->id, $recipe->ingredients()->first()->id);
    }
}
