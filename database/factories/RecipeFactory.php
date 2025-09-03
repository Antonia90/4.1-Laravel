<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recipe;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    protected $model = Recipe::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'diet_category' => $this->faker->randomElement(['omnivore', 'vegetarian', 'vegan']),
            'name' => $this->faker->unique()->words(2, true),
            'description' => $this->faker->sentence(),
            'base_servings' => $this->faker->numberBetween(1, 6),
        ];
    }
}
