<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Recipe;
use App\Models\Ingredient;

class RecipeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_recipe_index_page()
    {
        Recipe::factory()->create(['name' => 'Pizza']);

        $response = $this->get(route('recipes.index'));

        $response->assertStatus(200);
        $response->assertSee('Pizza');
    }

    /** @test */
    public function it_stores_a_new_recipe_with_ingredients()
    {
        $ingredient = Ingredient::factory()->create();

        $data = [
            'diet_category' => 'vegetarian',
            'name' => 'Ensalada',
            'base_servings' => 2,
            'ingredients' => [
                ['id' => $ingredient->id, 'unit' => 'g', 'quantity_per_serving' => 100],
            ]
        ];

        $response = $this->post(route('recipes.store'), $data);

        $response->assertRedirect(route('recipes.index'));
        $this->assertDatabaseHas('recipes', ['name' => 'Ensalada']);
        $this->assertDatabaseHas('recipe_ingredients', [
            'ingredient_id' => $ingredient->id,
            'unit' => 'g'
        ]);
    }
}

