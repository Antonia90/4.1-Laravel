@extends('layouts.app')

@section('title', 'Detalle del ingrediente')

@section('content')
<div class="bg-white rounded-xl shadow-md p-6">
    <h1 class="text-2xl font-bold text-pink-700 mb-4">{{ $ingredient->name }}</h1>

    <p class="mb-2">
        <strong>Tipo de ingrediente:</strong>
        {{ $ingredient->ingredient_type
            ? ucfirst(str_replace('_', ' ', $ingredient->ingredient_type))
            : '—' }}
    </p>

    <div class="mt-6 flex space-x-3">
        <a href="{{ route('ingredients.edit', $ingredient->id) }}"
           class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded">
           Editar
        </a>

        <form action="{{ route('ingredients.destroy', $ingredient->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"
                    onclick="return confirm('¿Eliminar este ingrediente?')">
                Eliminar
            </button>
        </form>

        <a href="{{ route('ingredients.index') }}"
           class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
           Volver
        </a>
    </div>
</div>
@endsection
