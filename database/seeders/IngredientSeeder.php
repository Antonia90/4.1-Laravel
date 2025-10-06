<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        $ingredients = [
            // Verduras
            ['name' => 'Tomate', 'ingredient_type' => 'verdura'],
            ['name' => 'Lechuga', 'ingredient_type' => 'verdura'],
            ['name' => 'Zanahoria', 'ingredient_type' => 'verdura'],

            // Frutas
            ['name' => 'Manzana', 'ingredient_type' => 'fruta'],
            ['name' => 'Banana', 'ingredient_type' => 'fruta'],

            // Proteínas
            ['name' => 'Garbanzos', 'ingredient_type' => 'proteina'],
            ['name' => 'Lentejas', 'ingredient_type' => 'proteina'],

            // Lácteos
            ['name' => 'Queso', 'ingredient_type' => 'lacteo'],
            ['name' => 'Yogur', 'ingredient_type' => 'lacteo'],

            // Condimentos
            ['name' => 'Aceite de oliva', 'ingredient_type' => 'condimento'],
            ['name' => 'Sal', 'ingredient_type' => 'condimento'],
            ['name' => 'Pimienta', 'ingredient_type' => 'condimento'],

            // Otros
            ['name' => 'Pan', 'ingredient_type' => 'otro'],
        ];

        foreach ($ingredients as $data) {
            Ingredient::firstOrCreate($data);
        }
    }
}
