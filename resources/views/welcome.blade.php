{{-- resources/views/welcome.blade.php --}}
<x-guest-layout>
    <div class="relative bg-red-50 min-h-screen font-sans text-gray-800">
        <!-- Fondo -->
        <div class="absolute inset-0 bg-cover bg-center opacity-50 -z-10 overflow-hidden">
            <img src="{{ Vite::asset('resources/images/fondo.png') }}"
                 alt="Fondo"
                 class="w-full h-full object-cover">
        </div>

        <div class="text-center mt-20">
            <h1 class="font-bold text-2xl">Todas las ideas que necesitas para comer variado y alimentarte bien.</h1>
            <p class="mt-4">Organiza tus recetas e ingredientes de manera fácil y rápida.</p>

            <div class="mt-6 flex justify-center gap-4">
                <a href="{{ route('register') }}" class="btn">Crear cuenta</a>
                <a href="{{ route('login') }}" class="btn">Iniciar sesión</a>
            </div>
        </div>
    </div>
</x-guest-layout>
