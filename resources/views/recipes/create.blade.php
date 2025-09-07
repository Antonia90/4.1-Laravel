<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-pink-800 uppercase">
            {{ __('Agregar') }}
        </h2>
    </x-slot>
    @php
    $units = ['g','kg','ml','l','taza','cucharada','unidad'];
    @endphp

    <div class="bg-white rounded-2xl shadow p-6">
        <x-validation-errors />
        <form action="{{ route('recipes.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">Nombre</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-2/3 p-1 rounded-xl border border-gray-300" required>
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Categoría</label>
                    <select name="diet_category" class="w-2/3 p-1 rounded-xl border border-gray-300" required>
                        @foreach($categories as $cat)
                        <option value="{{ $cat }}" @selected(old('diet_category')===$cat)>{{ ucfirst($cat) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Porciones base</label>
                    <input type="number" min="1" name="base_servings" value="{{ old('base_servings', 1) }}"
                        class="w-20 rounded-xl py-1 px-3 border border-gray-300" required>
                </div>

                <div class="md:col-span-3">
                    <label class="block mb-1 font-semibold">Paso a paso</label>
                    <textarea name="description" rows="3" class="w-full rounded-xl border border-gray-300">{{ old('description') }}</textarea>
                </div>


            </div>

            {{-- Ingredientes dinámicos --}}
            <div class="mt-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-xl font-semibold text-pink-700 uppercase">Ingredientes</h3>
                    <button type="button" id="add-ingredient"
                        class="bg-orange-200 hover:bg-orange-300 text-gray-900 px-3 py-1 rounded-xl shadow">
                        + Añadir
                    </button>
                </div>

                <div id="ingredients-list" class="space-y-3">
                    {{-- fila inicial --}}
                    <div class="grid grid-cols-12 gap-2 items-center ingredient-row my-8">
                        <div class="col-span-6">
                            <select name="ingredients[0][id]" class="w-2/3 p-1 rounded-xl border border-gray-300" required>
                                <option value="">-- Seleccionar ingrediente --</option>
                                @foreach($ingredients as $ing)
                                <option value="{{ $ing->id }}">{{ $ing->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-3">
                            <select name="ingredients[0][unit]" class="w-1/3 rounded-xl border-gray-300" required>
                                @foreach($units as $u)
                                <option value="{{ $u }}">{{ $u }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2">
                            <input type="number" step="0.01" min="0" placeholder="Cant."
                                name="ingredients[0][quantity_per_serving]"
                                class="w-2/3 p-1 rounded-xl border-gray-300" required>
                        </div>
                        <div class="col-span-1 text-right">
                            <button type="button" class="remove-row text-red-600 px-2 py-1 rounded-lg hover:bg-red-50">✕</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-2 mt-4 justify-end">
                <a href="{{ route('recipes.index') }}" class="px-4 py-2 rounded-xl bg-gray-200 hover:bg-gray-300">Cancelar</a>
                <button type="submit" class="px-4 py-2 rounded-xl bg-red-300 hover:bg-red-400">
                    Guardar
                </button>
            </div>
        </form>
    </div>

    {{-- Script mínimo para duplicar filas --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const list = document.getElementById('ingredients-list');
            const addBtn = document.getElementById('add-ingredient');
            let idx = 1;

            addBtn.addEventListener('click', () => {
                const first = list.querySelector('.ingredient-row');
                const clone = first.cloneNode(true);

                // limpiar valores
                clone.querySelectorAll('select, input').forEach(el => {
                    if (el.tagName === 'SELECT') el.selectedIndex = 0;
                    if (el.tagName === 'INPUT') el.value = '';
                });

                // actualizar índices name="ingredients[n][...]"
                clone.querySelectorAll('select, input').forEach(el => {
                    el.name = el.name.replace(/\[\d+\]/, `[${idx}]`);
                });
                idx++;

                list.appendChild(clone);
            });

            list.addEventListener('click', (e) => {
                if (e.target.classList.contains('remove-row')) {
                    const rows = list.querySelectorAll('.ingredient-row');
                    if (rows.length > 1) e.target.closest('.ingredient-row').remove();
                }
            });
        });
    </script>
</x-app-layout>