{{-- resources/views/welcome.blade.php --}}
<x-guest-layout>
    <div class="min-h-screen font-sans text-gray-800">
        <div class="text-center mt-20 pt-20">
            <h1 class="font-bold text-2xl">Todas las ideas que necesitas para comer variado y alimentarte bien.</h1>
            <p class="mt-16 text-lg">Organiza tus recetas e ingredientes de manera fácil.</p>

            <div class="mt-16 flex justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-orange-300 hover:bg-orange-200 text-gray-800 py-2 px-3 rounded-lg shadow-lg">Crear cuenta</a>
                <a href="{{ route('login') }}" class="bg-orange-300 hover:bg-orange-200 text-gray-800 py-2 px-3 rounded-lg shadow-lg">Iniciar sesión</a>
            </div>
        </div>
    </div>
</x-guest-layout>