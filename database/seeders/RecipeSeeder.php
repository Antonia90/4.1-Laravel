<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Schema;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener un usuario existente (el primero o el 'Test User')
        $user = User::where('email', 'test@example.com')->first() ?? User::first();

        // Crear recetas base
        $recipes = [
            [
                'name' => 'Ensalada fresca',
                'description' => 'Una ensalada simple con tomate, lechuga y aceite de oliva.',
                'diet_category' => 'vegana',
                'base_servings' => 2,
            ],
            [
                'name' => 'Tostadas con queso y tomate',
                'description' => 'Clásico desayuno vegetariano.',
                'diet_category' => 'vegetariana',
                'base_servings' => 1,
            ],
            [
                'name' => 'Bowl de lentejas y verduras',
                'description' => 'Plato proteico, saludable y sin productos animales.',
                'diet_category' => 'vegana',
                'base_servings' => 2,
            ],
        ];

        foreach ($recipes as $data) {
            Recipe::firstOrCreate([
                'user_id' => $user->id,
                'name' => $data['name'],
            ], $data);
        }

        if (Schema::hasTable('recipe_ingredients')) {
            $this->attachIngredientsToRecipes();
        }
    }

    /**
     * Vincula ingredientes con recetas
     */
    private function attachIngredientsToRecipes(): void
    {
        $ensalada = Recipe::where('name', 'Ensalada fresca')->first();
        $tostadas = Recipe::where('name', 'Tostadas con queso y tomate')->first();
        $bowl = Recipe::where('name', 'Bowl de lentejas y verduras')->first();

        $ingredientes = Ingredient::pluck('id', 'name');

        if ($ensalada) {
            $ensalada->ingredients()->attach([
                $ingredientes['Tomate'] => ['quantity_per_serving' => 100, 'unit' => 'g'],
                $ingredientes['Lechuga'] => ['quantity_per_serving' => 80, 'unit' => 'g'],
                $ingredientes['Aceite de oliva'] => ['quantity_per_serving' => 10, 'unit' => 'ml'],
                $ingredientes['Sal'] => ['quantity_per_serving' => 2, 'unit' => 'g'],
            ]);
        }

        if ($tostadas) {
            $tostadas->ingredients()->attach([
                $ingredientes['Pan'] => ['quantity_per_serving' => 2, 'unit' => 'unidad'],
                $ingredientes['Tomate'] => ['quantity_per_serving' => 50, 'unit' => 'g'],
                $ingredientes['Queso'] => ['quantity_per_serving' => 30, 'unit' => 'g'],
            ]);
        }

        if ($bowl) {
            $bowl->ingredients()->attach([
                $ingredientes['Lentejas'] => ['quantity_per_serving' => 150, 'unit' => 'g'],
                $ingredientes['Zanahoria'] => ['quantity_per_serving' => 50, 'unit' => 'g'],
                $ingredientes['Aceite de oliva'] => ['quantity_per_serving' => 10, 'unit' => 'ml'],
            ]);
        }
    }
}
