<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Ingredient;

class IngredientControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_ingredient_index_page()
    {
        Ingredient::factory()->create(['name' => 'Tomate']);
        
        $response = $this->get(route('ingredients.index'));

        $response->assertStatus(200);
        $response->assertSee('Tomate');
    }

    /** @test */
    public function it_stores_a_new_ingredient()
    {
        $data = [
            'ingredient_type' => 'vegetable',
            'name' => 'Cebolla'
        ];

        $response = $this->post(route('ingredients.store'), $data);

        $response->assertRedirect(route('ingredients.index'));
        $this->assertDatabaseHas('ingredients', $data);
    }

    /** @test */
    public function it_validates_required_fields()
    {
        $response = $this->post(route('ingredients.store'), []);

        $response->assertSessionHasErrors(['ingredient_type', 'name']);
    }

    /** @test */
    public function it_updates_an_existing_ingredient()
    {
        $ingredient = Ingredient::factory()->create(['name' => 'Zanahoria']);

        $response = $this->put(route('ingredients.update', $ingredient->id), [
            'ingredient_type' => 'vegetable',
            'name' => 'Zanahoria fresca'
        ]);

        $response->assertRedirect(route('ingredients.index'));
        $this->assertDatabaseHas('ingredients', ['name' => 'Zanahoria fresca']);
    }

    /** @test */
    public function it_deletes_an_ingredient()
    {
        $ingredient = Ingredient::factory()->create();

        $response = $this->delete(route('ingredients.destroy', $ingredient->id));

        $response->assertRedirect(route('ingredients.index'));
        $this->assertDatabaseMissing('ingredients', ['id' => $ingredient->id]);
    }
}

