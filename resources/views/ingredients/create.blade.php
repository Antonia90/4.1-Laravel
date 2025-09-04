<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-pink-800 uppercase">
            {{ __('Agregar') }}
        </h2>
    </x-slot>
<div class="bg-white rounded-2xl shadow p-6">
    <h2 class="text-2xl font-semibold text-pink-700 mb-4 uppercase">Nuevo Ingrediente</h2>

    <form action="{{ route('ingredients.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-semibold">Tipo</label>
            <select name="ingredient_type" class="w-1/3 rounded-xl border-gray-300" required>
                @foreach($types as $type)
                    <option value="{{ $type }}" @selected(old('ingredient_type')===$type)>
                        {{ ucfirst($type) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Nombre</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-1/3 rounded-xl border border-gray-300" required>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('ingredients.index') }}" class="px-4 py-2 rounded-xl bg-gray-200">Cancelar</a>
            <button type="submit" class="px-4 py-2 rounded-xl bg-red-300 text-white hover:bg-red-400">
                Guardar
            </button>
        </div>
    </form>
</div>
</x-app-layout>

