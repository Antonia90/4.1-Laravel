{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ Vite::asset('resources/images/icon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="relative bg-red-50 min-h-screen font-sans text-gray-800">
    <!-- Fondo -->
    <div class="absolute inset-0 bg-cover bg-center opacity-50 -z-10 overflow-hidden">
        <img src="{{ Vite::asset('resources/images/fondo.png') }}"
             alt="Fondo"
             class="w-full h-full object-cover">
    </div>
        <nav class="bg-red-300 p-4 shadow-md">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}"><img src="{{ Vite::asset('resources/images/icon.png') }}"
                    alt="Recetario"
                    class="h-10 w-10 rounded-full object-cover">
            </a>
            @isset($header)
            <header>
                <div class="py-2 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
            @endisset
        </div>
    </nav>

    <div class="min-h-screen font-sans text-gray-800">
        <div class="text-center mt-20 pt-20">
            <h1 class="font-bold text-2xl">
                Todas las ideas que necesitas para comer variado y alimentarte bien.
            </h1>
            <p class="mt-16 text-lg">Organiza tus recetas e ingredientes de manera fácil.</p>

            <div class="mt-16 flex justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-orange-300 hover:bg-orange-200 text-gray-800 py-2 px-3 rounded-lg shadow-lg">Crear cuenta</a>
                <a href="{{ route('login') }}" class="bg-orange-300 hover:bg-orange-200 text-gray-800 py-2 px-3 rounded-lg shadow-lg">Iniciar sesión</a>
            </div>
        </div>
    </div>
</body>
</html>
