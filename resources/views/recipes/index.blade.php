<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-pink-800 uppercase">
            {{ __('Recetas') }}
        </h2>
    </x-slot>
    <div class="bg-white rounded-2xl shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-semibold text-pink-700 uppercase">Recetas</h2>
            <a href="{{ route('recipes.create') }}"
                class="bg-orange-200 hover:bg-orange-300 px-4 py-2 rounded-xl shadow">
                + Agregar
            </a>
        </div>

        @if($recipes->count())
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-red-100 text-gray-700">
                        <th class="text-left py-3 px-4">Nombre</th>
                        <th class="text-left py-3 px-4">Categoría</th>
                        <th class="text-left py-3 px-4"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recipes as $recipe)
                    <tr class="border-b hover:bg-red-50">
                        <td class="py-3 px-4">{{ $recipe->name }}</td>
                        <td class="py-3 px-4 capitalize">{{ $recipe->diet_category }}</td>
                        <td class="py-3 px-4">
                            <div class="flex gap-2 justify-end">
                                <a href="{{ route('recipes.show', $recipe->id) }}"
                                    class="bg-orange-200 hover:bg-orange-300 text-gray-800 py-1 px-3 rounded-lg">
                                    Ver
                                </a>
                                @can('update', $recipe)
                                <a href="{{ route('recipes.edit', $recipe) }}"
                                    class="bg-yellow-100 hover:bg-yellow-200 text-gray-800 px-3 py-1 rounded-lg">
                                    Editar
                                </a>
                                @endcan
                                @can('delete', $recipe)
                                <form action="{{ route('recipes.destroy', $recipe) }}" method="POST"
                                    onsubmit="return confirm('¿Seguro que deseas eliminar esta receta?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-200 hover:bg-red-300 text-gray-800 px-3 py-1 rounded-lg">
                                        Eliminar
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $recipes->links() }}</div>
        @else
        <p class="text-gray-600">No hay recetas registradas.</p>
        @endif
    </div>
</x-app-layout>