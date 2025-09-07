<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('MENU') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-32">
            <div class="flex justify-center gap-8">
                <!-- Tarjeta Ingredientes -->
                <a href="{{ route('ingredients.index') }}"
                   class="w-64 h-40 flex items-center justify-center rounded-2xl shadow-lg bg-yellow-100 text-pink-950 font-bold uppercase hover:bg-yellow-200 transition">
                    Ingredientes
                </a>

                <!-- Tarjeta Recetas -->
                <a href="{{ route('recipes.index') }}"
                   class="w-64 h-40 flex items-center justify-center rounded-2xl shadow-lg bg-orange-200 text-pink-950 font-bold uppercase hover:bg-orange-300 transition">
                    Recetas
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
