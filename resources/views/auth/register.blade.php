<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite('resources/css/app.css')
    <title>Register</title>
</head>
<body>

<div x-data="{ showSplash: true }" x-init="setTimeout(() => showSplash = false, 1000)"
     class="relative min-h-screen bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-600 flex items-center justify-center">

    <!-- Splash Screen -->
    <template x-if="showSplash">
        <div class="fixed inset-0 flex items-center justify-center bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-600 z-50">
            <h1 class="text-white text-5xl font-extrabold select-none">Welcome to Synaptra</h1>
        </div>
    </template>

    <!-- Форма авторизации / регистрации -->
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

        <h2 class="text-3xl font-semibold select-none">Administrator Registration</h2>

        <!-- Информационное примечание -->
        <div class="text-sm text-white/80 text-justify px-4">
            <p class="text-center">This section is for the administrator only</p>
            <p>Employees are added by the administrator through the control panel. Self-registration of employees is not possible.</p>
        </div>

        <form class="w-full space-y-4 mt-4" method="POST" action="{{route('register.submit')}}">
            @csrf

            <input type="text" name="name" placeholder="Name" required
                   class="w-full p-3 rounded-lg bg-white/30 placeholder-white text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" />

            <input type="email" name="email" placeholder="Email" required autocomplete="email"
                   class="w-full p-3 rounded-lg bg-white/30 placeholder-white text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" />

            <input type="password" name="password" placeholder="Password" required autocomplete="current-password"
                   class="w-full p-3 rounded-lg bg-white/30 placeholder-white text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" />

            <input type="password" name="password_confirmation" placeholder="Confirmation password" required autocomplete="current-confirmed-password"
                   class="w-full p-3 rounded-lg bg-white/30 placeholder-white text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" />

            <div class="flex space-x-4">
                <button type="submit"
                        class="flex-grow bg-indigo-500 hover:bg-indigo-600 transition rounded-lg py-3 font-semibold text-white">
                    Sign up
                </button>

                <a href="/login"
                   class="px-4 py-3 rounded-lg border border-white/50 text-white/80 hover:text-white hover:border-white transition text-center text-sm">
                    Back
                </a>
            </div>

        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</body>
</html>
