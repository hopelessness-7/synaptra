@extends('layouts.app')

@section('content')
    <div class="flex flex-col lg:flex-row gap-8">
        @if(!auth()->user()->projectMembers()->exists())
            @livewire('project.create-modal')
        @endif

        <!-- Левая колонка -->
        <div class="flex-1 space-y-8">
            <!-- Welcome & Summary -->
            <section>
                <h2 class="text-2xl font-semibold mb-2">Welcome back, {{ auth()->user()->name  }}!</h2>
                <p class="text-gray-600">You have 3 tasks due today and 1 upcoming deadline.</p>
            </section>

            <!-- Boards Overview -->
            <section>
                <h3 class="text-xl font-semibold mb-4">Your Boards</h3>

                @if(!$dashboard['boards']->isEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @php
                            $bgColors = [
                                'bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500',
                                'bg-gradient-to-r from-purple-600 to-indigo-700',
                                'bg-indigo-600',
                                'bg-purple-600',
                                'bg-indigo-700',
                                'bg-purple-700',
                                'bg-gradient-to-r from-blue-500 to-indigo-600',
                            ];
                        @endphp

                        @foreach($dashboard['boards'] as $board)
                            @php
                                $randomBg = $bgColors[array_rand($bgColors)];
                            @endphp
                            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition overflow-hidden cursor-pointer flex flex-col">
                                <div class="h-32 {{ $randomBg }} flex items-center justify-center text-white text-xl font-semibold select-none">
                                    {{ substr($board->title, 0, 2) }}
                                </div>
                                <div class="p-4 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h4 class="font-bold text-lg">{{ $board->title }}</h4>
                                        <p class="text-sm text-gray-500">Project: {{ $board->project->name }}</p>
                                        <p class="text-sm">Tasks: {{ $board->tasks_count }}</p>
                                    </div>
                                    <a href="#" class="text-indigo-600 text-sm mt-2 inline-block">Go to board →</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="mt-8">
                        <p class="text-gray-500 mb-4">You have no boards yet.</p>
                        <a href=""
                           class="inline-block bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded">
                            Create your first board
                        </a>
                    </div>
                @endif

            </section>

            <!-- Urgent Tasks -->
            <section>
                <h3 class="text-xl font-semibold mb-4">Urgent Tasks ⚡</h3>
                @if(!$dashboard['urgentTasks']->isEmpty())
                    <ul class="space-y-3">
                        @foreach($dashboard['urgentTasks'] as $task)
                            <li class="bg-red-50 border-l-4 border-red-500 p-4 rounded shadow cursor-pointer hover:bg-red-100 transition">
                                <div class="flex justify-between items-center">
                                    <strong>{{ $task['title'] }}</strong>
                                    <span class="text-sm text-red-600">{{ \Carbon\Carbon::parse($task['finished_at'])->format('M d, H:i') }}</span>
                                </div>
                                <a href="#" class="text-red-600 text-sm mt-1 inline-block">Open →</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="mt-8">
                        <p class="text-gray-500 mb-4">You don't have any assignments yet.</p>
                    </div>
                @endif
            </section>

            <!-- This Week's Tasks -->
            <section>
                <h3 class="text-xl font-semibold mb-4">Tasks for This Week</h3>
                @if(!$dashboard['planningTasks']->isEmpty())
                    <ul class="space-y-2">
                        @foreach($dashboard['planningTasks'] as $task)
                            <li class="bg-white p-3 rounded shadow hover:shadow-md transition cursor-pointer">
                                <div class="flex justify-between">
                                    <strong>{{ $task['title'] }}</strong>
                                    <span class="text-gray-500 text-sm">{{ \Carbon\Carbon::parse($task['finished_at'])->format('M d') }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="mt-8">
                        <p class="text-gray-500 mb-4">You don't have scheduled tasks, but you can add them</p>
{{--                        @if(auth()->user()->) @endif--}}
                        <a href=""
                           class="inline-block bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded">
                            Create your first task
                        </a>
                    </div>
                @endif
            </section>
        </div>

        <!-- Правая колонка -->
        <aside class="w-full lg:w-80 space-y-8 sticky top-6 self-start">

            <!-- Personal Stats -->
            <section class="bg-white rounded-xl shadow p-4">
                <h3 class="text-xl font-semibold mb-4">Your Stats</h3>
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div>
                        <p class="text-2xl font-bold">{{ $dashboard['stats']['count']['completed_tasks'] }}</p>
                        <p class="text-sm text-gray-500">Tasks Closed</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold">{{  $dashboard['stats']['count']['projects'] }}</p>
                        <p class="text-sm text-gray-500">Active Projects</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold">{{  $dashboard['stats']['count']['active_boards'] }}</p>
                        <p class="text-sm text-gray-500">Boards Involved</p>
                    </div>
                </div>
            </section>

            @php
                use Carbon\Carbon;

                $today = Carbon::today();
                $startOfMonth = $today->copy()->startOfMonth();
                $endOfMonth = $today->copy()->endOfMonth();

                // Первый день недели (0 - воскресенье, 1 - понедельник и т.д.)
                // Можно настроить для вашей локали, например, понедельник первым днём (1)
                $firstDayOfWeek = $startOfMonth->dayOfWeek;

                // Кол-во дней в месяце
                $daysInMonth = $startOfMonth->daysInMonth;

                // Подготовим массив ячеек календаря (включая пустые дни до начала месяца)
                $cells = [];
                for ($i = 0; $i < $firstDayOfWeek; $i++) {
                    $cells[] = null; // пустые ячейки
                }
                for ($d = 1; $d <= $daysInMonth; $d++) {
                    $cells[] = $d;
                }
            @endphp

            <section class="bg-white rounded-xl shadow p-4 mt-6">
                <h3 class="text-xl font-semibold mb-4">Calendar - {{ $today->format('F Y') }}</h3>

                <div class="grid grid-cols-7 gap-1 text-center text-gray-600 font-semibold select-none">
                    @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $dayName)
                        <div>{{ $dayName }}</div>
                    @endforeach
                </div>

                <div class="grid grid-cols-7 gap-1 text-center text-gray-800">
                    @foreach($cells as $cell)
                        @if($cell === null)
                            <div class="py-2"></div>
                        @else
                            <div class="py-2 rounded
                    {{ $cell === $today->day ? 'bg-indigo-600 text-white font-bold' : 'hover:bg-indigo-100 cursor-pointer' }}">
                                {{ $cell }}
                            </div>
                        @endif
                    @endforeach
                </div>
            </section>

        </aside>

    </div>
@endsection
