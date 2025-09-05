{{-- resources/views/welcome.blade.php --}}
<x-guest-layout>
    <div class="bg-red-50 min-h-screen font-sans text-gray-800">
        <div class="text-center mt-20 pt-20">
            <h1 class="font-bold text-2xl">Todas las ideas que necesitas para comer variado y alimentarte bien.</h1>
            <p class="mt-16 text-lg">Organiza tus recetas e ingredientes de manera fácil y rápida.</p>

            <div class="mt-16 flex justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-orange-200 hover:bg-orange-300 text-gray-800 py-1 px-3 rounded-lg">Crear cuenta</a>
                <a href="{{ route('login') }}" class="bg-orange-200 hover:bg-orange-300 text-gray-800 py-1 px-3 rounded-lg">Iniciar sesión</a>
            </div>
        </div>
    </div>
</x-guest-layout>