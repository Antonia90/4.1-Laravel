<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\RecipeIngredient;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $recipes = Recipe::query()
            ->when($request->category, fn($q, $category) =>
            $q->where('diet_category', $category))
            ->when($request->search, fn($q, $search) =>
            $q->where('name', 'like', "%{$search}%"))
            ->with('ingredients')
            ->paginate(10);

        return view('recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ingredients = Ingredient::all();
        $categories = Recipe::getDietCategories();

        return view('recipes.create', compact('ingredients', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'diet_category' => 'required|in:' . implode(',', Recipe::getDietCategories()),
            'name' => 'required|string|unique:recipes,name',
            'description' => 'nullable|string',
            'base_servings' => 'required|integer|min:1',
            'ingredients' => 'required|array',
            'ingredients.*.id' => 'required|exists:ingredients,id',
            'ingredients.*.unit' => 'required|in:' . implode(',', RecipeIngredient::UNITS),
            'ingredients.*.quantity_per_serving' => 'required|numeric|min:0',
        ]);

        $recipe = Recipe::create($validated);

        foreach ($request->ingredients as $ingredientData) {
            $recipe->ingredients()->attach([
                $ingredientData['id'] => [
                    'unit' => $ingredientData['unit'],
                    'quantity_per_serving' => $ingredientData['quantity_per_serving']
                ]
            ]);
        }

        return redirect()->route('recipes.index')
            ->with('success', 'Receta creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $recipe = Recipe::with('ingredients')->findOrFail($id);

        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $recipe = Recipe::with('ingredients')->findOrFail($id);
        $ingredients = Ingredient::all();
        $categories = Recipe::getDietCategories();

        return view('recipes.edit', compact('recipe', 'ingredients', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $recipe = Recipe::findOrFail($id);

        $validated = $request->validate([
            'diet_category' => 'required|in:' . implode(',', Recipe::getDietCategories()),
            'name' => 'required|string|unique:recipes,name,' . $recipe->id,
            'description' => 'nullable|string',
            'base_servings' => 'required|integer|min:1',
            'ingredients' => 'required|array',
            'ingredients.*.id' => 'required|exists:ingredients,id',
            'ingredients.*.unit' => 'required|in:' . implode(',', RecipeIngredient::UNITS),
            'ingredients.*.quantity_per_serving' => 'required|numeric|min:0',
        ]);

        $recipe->update($validated);

        $recipe->ingredients()->detach();

        foreach ($request->ingredients as $ingredientData) {
            $recipe->ingredients()->attach([
                $ingredientData['id'] => [
                    'unit' => $ingredientData['unit'],
                    'quantity_per_serving' => $ingredientData['quantity_per_serving']
                ]
            ]);
        }

        return redirect()->route('recipes.index')
            ->with('success', 'Receta actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recipe = Recipe::findOrFail($id);

        $recipe->ingredients()->detach();
        $recipe->delete();

        return redirect()->route('recipes.index')
            ->with('success', 'Receta eliminada exitosamente');
    }
}
