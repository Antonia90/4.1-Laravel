<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-pink-800 uppercase">
            {{ __('Detalle') }}
        </h2>
    </x-slot>
<div class="bg-white rounded-xl shadow-md p-6">
    <h1 class="text-2xl font-bold text-pink-700 mb-4">{{ $ingredient->name }}</h1>

    <p class="mb-2 uppercase">
        <strong>Tipo de ingrediente:</strong>
        {{ $ingredient->ingredient_type
            ? ucfirst(str_replace('_', ' ', $ingredient->ingredient_type))
            : '—' }}
    </p>

    <div class="mt-6 flex space-x-3">
        <a href="{{ route('ingredients.edit', $ingredient->id) }}"
           class="bg-yellow-100 hover:bg-yellow-200 py-2 px-4 rounded-xl">
           Editar
        </a>

        <form action="{{ route('ingredients.destroy', $ingredient->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="bg-red-300 hover:bg-red-400 py-2 px-4 rounded-xl"
                    onclick="return confirm('¿Eliminar este ingrediente?')">
                Eliminar
            </button>
        </form>

            <a href="{{ route('ingredients.index') }}" class="px-4 py-2 rounded-xl bg-gray-200">Volver</a>

    </div>
</div>
</x-app-layout>
