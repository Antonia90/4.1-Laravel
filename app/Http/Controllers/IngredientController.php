<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ingredients = Ingredient::query()
            ->when($request->type, fn($q, $type) => $q->type($type))
            ->when($request->search, fn($q, $search) => $q->search($search))
            ->paginate(10);

        return view('ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Ingredient::TYPES;
        return view('ingredients.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ingredient_type' => 'required|in:' . implode(',', Ingredient::TYPES),
            'name' => 'required|string|unique:ingredients,name',
        ]);

        Ingredient::create($validated);

        return redirect()->route('ingredients.index')
            ->with('success', 'Ingrediente creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $recipes = $ingredient->recipes()->paginate(10);

        return view('ingredients.show', compact('ingredient', 'recipes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $types = Ingredient::TYPES;

        return view('ingredients.edit', compact('ingredient', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ingredient = Ingredient::findOrFail($id);

        $validated = $request->validate([
            'ingredient_type' => 'required|in:' . implode(',', Ingredient::TYPES),
            'name' => 'required|string|unique:ingredients,name,' . $ingredient->id,
        ]);

        $ingredient->update($validated);

        return redirect()->route('ingredients.index')
            ->with('success', 'Ingrediente actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ingredient = Ingredient::findOrFail($id);

        if ($ingredient->recipes()->exists()) {
            return redirect()->back()
                ->with('error', 'No se puede eliminar el ingrediente porque está siendo usado en recetas');
        }

        $ingredient->delete();

        return redirect()->route('ingredients.index')
            ->with('success', 'Ingrediente eliminado exitosamente');
    }
}
