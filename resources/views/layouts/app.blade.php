<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mis Recetas')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Fuente (opcional) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-pink-50 min-h-screen font-sans text-gray-800">
    <nav class="bg-pink-200 p-4 shadow-md">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold text-pink-900">Recetas</a>
            <div class="flex gap-4">
                <a href="{{ route('ingredients.index') }}" class="text-pink-950 hover:underline">Ingredientes</a>
                <a href="{{ route('recipes.index') }}" class="text-pink-950 hover:underline">Recetas</a>
            </div>
        </div>
    </nav>

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

        @yield('content')
    </main>
</body>
</html>

