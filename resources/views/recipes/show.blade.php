@extends('layouts.app')

@section('title', 'Detalle de receta')

@section('content')
<div class="bg-white rounded-xl shadow-md p-6">
    <h1 class="text-2xl font-bold text-pink-700 mb-4">{{ $recipe->name }}</h1>

    <p class="mb-2"><strong>Categoría:</strong> {{ ucfirst($recipe->diet_category) }}</p>
    <p class="mb-2"><strong>Porciones base:</strong> {{ $recipe->base_servings }}</p>
    <p class="mb-4"><strong>Paso a paso:</strong> {{ $recipe->description }}</p>

    <h2 class="text-xl font-semibold text-pink-600 mb-2">Ingredientes</h2>
    <ul class="list-disc pl-5">
        @foreach($recipe->ingredients as $ingredient)
            <li>
                {{ $ingredient->name }} 
                - {{ $ingredient->pivot->quantity_per_serving }} {{ $ingredient->pivot->unit }}
            </li>
        @endforeach
    </ul>

    <div class="mt-6 flex space-x-3">
        <a href="{{ route('recipes.edit', $recipe->id) }}" 
           class="bg-yellow-100 hover:bg-yellow-200 py-2 px-4 rounded-xl">
           Editar
        </a>
        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="bg-red-200 hover:bg-red-300 py-2 px-4 rounded-xl"
                    onclick="return confirm('¿Estás segura de eliminar esta receta?')">
                Eliminar
            </button>
        </form>
        <a href="{{ route('recipes.index') }}" 
           class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-xl">
           Volver
        </a>
    </div>
</div>
@endsection
