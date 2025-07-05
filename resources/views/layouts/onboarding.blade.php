<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite('resources/css/app.css')
    <title>{{ config('app.name', 'Synaptra') }}</title>
</head>
<body class="bg-gray-50 text-gray-800">

<div class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 text-white overflow-hidden">

    {{-- Blurred background shapes --}}
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-purple-400 opacity-30 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-pink-400 opacity-30 rounded-full blur-3xl"></div>

    {{-- Карточка с белым фоном и паддингом, тень и анимация --}}
    <div class="relative z-10 bg-white text-gray-900 rounded-2xl shadow-2xl w-full p-10 animate-fade-in-up max-w-2xl @yield('card_class')">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
