@extends('layouts.app')
@section('title', 'Editar Ingrediente')

@section('content')
<div class="bg-white rounded-2xl shadow p-6">
    <h2 class="text-2xl font-semibold text-pink-700 mb-4">Editar Ingrediente</h2>

    <form action="{{ route('ingredients.update', $ingredient) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-semibold">Tipo</label>
            <select name="ingredient_type" class="w-full rounded-xl border-gray-300" required>
                @foreach($types as $type)
                    <option value="{{ $type }}" @selected(old('ingredient_type', $ingredient->ingredient_type)===$type)>
                        {{ ucfirst($type) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Nombre</label>
            <input type="text" name="name" value="{{ old('name', $ingredient->name) }}"
                   class="w-full rounded-xl border-gray-300" required>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('ingredients.index') }}" class="px-4 py-2 rounded-xl bg-gray-200">Cancelar</a>
            <button type="submit" class="px-4 py-2 rounded-xl bg-pink-400 text-white hover:bg-pink-500">
                Actualizar
            </button>
        </div>
    </form>
</div>
@endsection
