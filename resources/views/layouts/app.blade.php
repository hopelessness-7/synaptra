<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>{{ config('app.name', 'Synaptra') }}</title>
    @livewireStyles
</head>

<body x-data="timeOnly()" x-init="init()" class="bg-gray-50 text-gray-800">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-60 bg-gradient-to-b from-indigo-700 to-purple-700 text-white hidden md:flex flex-col sticky top-0 h-screen">
        <!-- Логотип и название -->
        <div class="p-6 flex flex-col items-center">
{{--            <img src="{{ asset('images/synaptra_logo.svg') }}" alt="Logo" class="h-10 mb-2" />--}}
            <span class="font-bold text-xl select-none">Synaptra</span>
        </div>

        <!-- Пространство между логотипом и меню -->
        <div class="flex-1"></div>

        <!-- Главное меню -->
        <nav class="space-y-2 w-full">
            <!-- Dashboard -->
            <a href="#"
               class="flex items-center w-full px-4 py-2 space-x-3 hover:bg-indigo-600 rounded-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 13h8V3H3v10z"/>
                    <path d="M13 21h8V11h-8v10z"/>
                    <path d="M3 21h8v-6H3v6z"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- Projects -->
            <a href="#"
               class="flex items-center w-full px-4 py-2 space-x-3 hover:bg-indigo-600 rounded-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 7h18M3 12h18M3 17h18"/>
                </svg>
                <span>Projects</span>
            </a>

            <!-- Boards -->
            <a href="#"
               class="flex items-center w-full px-4 py-2 space-x-3 hover:bg-indigo-600 rounded-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"/>
                    <rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/>
                </svg>
                <span>Boards</span>
            </a>

            <!-- Tasks -->
            <a href="#"
               class="flex items-center w-full px-4 py-2 space-x-3 hover:bg-indigo-600 rounded-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 11l3 3L22 4"/>
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                </svg>
                <span>Tasks</span>
            </a>
        </nav>

        <!-- Пространство ниже меню -->
        <div class="flex-1"></div>

        <!-- Настройки / выход (группа внизу) -->
        <div class="w-full px-4 pb-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="flex justify-center items-center w-full space-x-2 px-4 py-2 hover:bg-indigo-600 transition rounded-lg hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5 inline-block align-middle"
                         fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M18 12H9m9 0l-3-3m3 3l-3 3" />
                    </svg>
                    <span class="inline-block align-middle">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main area -->
    <div class="flex-1 flex flex-col">

        <!-- Header -->
        <header class="w-full h-16 bg-white shadow flex items-center justify-between px-6 sticky top-0 z-10"
                 x-data="{ showProfileMenu: false, showNotifications: false }">

            <!-- Left: Поиск -->
            <div class="relative w-1/3 max-w-xs">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                </div>
                <input type="text" placeholder="Search..."
                       class="pl-10 pr-4 py-2 w-full rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400 text-sm">
            </div>

            <!-- Right Side: Время + Start + Notifications + Profile -->
            <div class="flex items-center space-x-4 relative">

                <!-- Current Time -->
                <div class="px-3 py-1 bg-indigo-100 text-indigo-700 text-sm font-mono rounded-full shadow-sm select-none">
                    <span x-text="formattedTime"></span>
                </div>

                <!-- Start Work Button -->
                <button class="bg-indigo-500 hover:bg-indigo-600 text-white text-sm px-4 py-2 rounded-lg shadow transition">
                    Start Work
                </button>

                <!-- Notifications -->
                <div class="relative">
                    <button @click="showNotifications = !showNotifications" class="text-gray-600 hover:text-indigo-600 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </button>
                    <!-- Notifications Dropdown -->
                    <div x-show="showNotifications" @click.away="showNotifications = false"
                         class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg overflow-hidden z-50">
                        <div class="p-4 text-sm">
                            <p class="font-semibold mb-2">Notifications</p>
                            <ul class="space-y-2">
                                <li>You have 3 new tasks</li>
                                <li>Project update: Q3 Launch</li>
                                <li>New comment on API Board</li>
                            </ul>
                        </div>
                        <div class="border-t px-4 py-2 text-xs text-gray-500 bg-gray-50 flex justify-between">
                            <a href="#" class="hover:underline">Settings</a>
                            <a href="#" class="hover:underline">View All</a>
                        </div>
                    </div>
                </div>

                <!-- Profile -->
                <div class="relative">
                    <button @click="showProfileMenu = !showProfileMenu" class="flex items-center space-x-2 focus:outline-none">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}"
                             alt="Avatar"
                             class="w-8 h-8 rounded-full border-2 border-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M6 9l6 6 6-6"/>
                        </svg>
                    </button>

                    <!-- Profile Dropdown -->
                    <div x-show="showProfileMenu" @click.away="showProfileMenu = false"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg overflow-hidden z-50 text-sm">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Settings</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Devices</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Security</a>
                        <div class="border-t"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-red-500 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>
</div>

@livewireScripts
{{--<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>--}}
<script>
    function timeOnly() {
        return {
            formattedTime: '',
            init() {
                this.update();
                setInterval(() => this.update(), 1000);
            },
            update() {
                this.formattedTime = new Date().toLocaleTimeString();
            }
        }
    }
</script>
</body>

</html>
