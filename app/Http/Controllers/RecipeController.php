<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\RecipeIngredient;
use App\Models\User;

class RecipeController extends Controller
{
    public function __construct()
    {
                $this->middleware('auth'); // Solo necesitamos verificar que esté autenticado
        
        // Definimos los middleware específicos para cada acción
        $this->middleware('can:update,recipe')->only(['edit', 'update']);
        $this->middleware('can:delete,recipe')->only(['destroy']);
    }

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

        
        $recipe = auth()->user()->recipes()->create($validated);




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
    public function show(Recipe $recipe)
    {
        $recipe->load('ingredients');
        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        $ingredients = Ingredient::all();
        $categories = Recipe::getDietCategories();
        return view('recipes.edit', compact('recipe', 'ingredients', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
   
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
    public function destroy(Recipe $recipe)
    {
         $recipe->ingredients()->detach();
        $recipe->delete();

        return redirect()->route('recipes.index')
            ->with('success', 'Receta eliminada exitosamente');
    }
}
