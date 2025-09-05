<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{-- Fuente (opcional) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ Vite::asset('resources/images/icon.png') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="relative bg-red-50 min-h-screen font-sans text-gray-800">
    <!-- Fondo -->
    <div class="absolute inset-0 bg-cover bg-center opacity-50 -z-10 overflow-hidden">
        <img src="{{ Vite::asset('resources/images/fondo.png') }}"
            alt="Fondo"
            class="w-full h-full object-cover">
    </div>
    <div class="min-h-screen bg-gray-100/70">
        @include('layouts.navigation')

        <!-- Page Heading -->

        <nav class="bg-red-300 p-4 shadow-md">
            <div class="max-w-5xl mx-auto flex justify-between items-center">
                @isset($header)
                <header>
                    <div class="py-2 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                @endisset
                <div class="flex gap-4">
                    <a href="{{ route('ingredients.index') }}" class="text-pink-950 hover:text-white font-bold uppercase">Ingredientes</a>
                    <a href="{{ route('recipes.index') }}" class="text-pink-950 hover:text-white font-bold uppercase">Recetas</a>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="max-w-5xl mx-auto p-6">
            {{-- Alerts --}}
            @if (session('success'))
            <div class="mb-4 rounded-2xl bg-green-100 text-green-800 px-4 py-3 shadow">
                {{ session('success') }}
            </div>
            @endif
            @if (session('error'))
            <div class="mb-4 rounded-2xl bg-red-100 text-red-800 px-4 py-3 shadow">
                {{ session('error') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="mb-4 rounded-2xl bg-red-100 text-red-800 px-4 py-3 shadow">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{ $slot }}

        </main>
    </div>
    <footer class="bg-red-300 p-4 shadow-md">
        <div class="max-w-5xl mx-auto flex justify-center items-center"> @2025. Todos los derechos reservados.</div>
    </footer>
</body>

</html>