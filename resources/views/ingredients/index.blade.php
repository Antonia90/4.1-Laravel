@extends('layouts.app')
@section('title', 'Ingredientes')

@section('content')
<div class="bg-white rounded-2xl shadow p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold text-pink-700">Ingredientes</h2>
        <a href="{{ route('ingredients.create') }}"
            class="bg-pink-400 hover:bg-pink-500 text-white px-4 py-2 rounded-xl shadow">
            + Agregar
        </a>
    </div>

    @if($ingredients->count())
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="bg-purple-100 text-gray-700">
                    <th class="text-left py-3 px-4">Nombre</th>
                    <th class="text-left py-3 px-4">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ingredients as $ingredient)
                <tr class="border-b hover:bg-purple-50">
                    <td class="py-3 px-4">{{ $ingredient->name }}</td>

                    <td class="py-3 px-4">
                        <div class="flex gap-2">
                            <a href="{{ route('ingredients.show', $ingredient->id) }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded">
                                Ver
                            </a>
                            <a href="{{ route('ingredients.edit', $ingredient) }}"
                                class="bg-blue-200 hover:bg-blue-300 text-gray-800 px-3 py-1 rounded-lg">
                                Editar
                            </a>
                            <form action="{{ route('ingredients.destroy', $ingredient) }}" method="POST"
                                onsubmit="return confirm('¿Seguro que deseas eliminar este ingrediente?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-200 hover:bg-red-300 text-gray-800 px-3 py-1 rounded-lg">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $ingredients->links() }}</div>
    @else
    <p class="text-gray-600">No hay ingredientes registrados.</p>
    @endif
</div>
@endsection