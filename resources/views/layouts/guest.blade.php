<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ Vite::asset('resources/images/icon.png') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="relative font-sans text-gray-900 antialiased">
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
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100/80">

        <!-- <div class="w-full px-6 py-4 shadow-md overflow-hidden sm:rounded-lg"> -->
        <div class="w-full max-w-md bg-white/95 p-6 rounded-2xl shadow-lg">

            {{ $slot }}
        </div>
    </div>
    <footer class="bg-red-300 p-4 shadow-md">
        <div class="max-w-5xl mx-auto flex justify-center items-center"> @2025. Todos los derechos reservados.</div>
    </footer>
</body>

</html>