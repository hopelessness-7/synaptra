<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite('resources/css/app.css')
    <title>Login</title>
</head>
<body>
<div x-data="{ showSplash: true }" x-init="setTimeout(() => showSplash = false, 800)"
     class="relative min-h-screen bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-600 flex items-center justify-center">

    <!-- Приветствие fullscreen -->
    <template x-if="showSplash">
        <div class="fixed inset-0 flex items-center justify-center bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-600 z-50">
            <h1 class="text-white text-5xl font-extrabold select-none">Welcome to Synaptra</h1>
        </div>
    </template>

    <!-- Форма авторизации -->
    <div
        x-show="!showSplash"
        x-transition:enter="transition ease-out duration-700"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-500"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="flex flex-col items-center space-y-6 p-8 max-w-md w-full
             bg-white/20 backdrop-blur-md rounded-2xl shadow-lg text-white"
    >
        <h2 class="text-3xl font-semibold select-none">Welcome to Synaptra</h2>


        <form method="POST" action="{{ route('login.submit') }}" class="w-full space-y-4">
            @csrf

            @if ($errors->has('auth'))
                <div class="mb-4 rounded border border-red-400 bg-red-100 text-red-700 px-4 py-3" role="alert">
                    <strong class="font-semibold">Error:</strong><span class="ml-2">{{ $errors->first('auth') }}</span>
                </div>
            @endif

            <input type="email" name="email" autocomplete="email" placeholder="Email" required
                   class="w-full p-3 rounded-lg bg-white/30 placeholder-white text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" />
            <input type="password" name="password" autocomplete="current-password" placeholder="Password" required
                   class="w-full p-3 rounded-lg bg-white/30 placeholder-white text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" />

            <button type="submit"
                    class="w-full bg-indigo-500 hover:bg-indigo-600 transition rounded-lg py-3 font-semibold">
                Sign In
            </button>

            <a href="/register"
               class="block text-center text-sm text-white/80 hover:text-white mt-2 underline">
                Register as Administrator
            </a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
