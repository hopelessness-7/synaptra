@extends('layouts.app')

@section('content')
    <div class="p-6">
        <!-- Заголовок -->
        <h1 class="text-3xl font-bold mb-4">{{ $board['title'] }}</h1>

        <!-- Поиск -->
        <div class="relative w-full mb-4">
            <input
                type="text"
                placeholder="Поиск задач..."
                class="pl-10 pr-3 py-2 border border-gray-300 rounded-lg w-full text-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            >
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
            </svg>
        </div>

        <!-- Быстрые фильтры -->
        <div class="flex space-x-2 mb-6">
            <button class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 hover:bg-blue-200">Мои</button>
            <button class="px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 hover:bg-red-200">Просроченные</button>
            <button class="px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 hover:bg-gray-200">Другие</button>
        </div>

        <!-- Колонки -->
        <div class="flex space-x-6 overflow-x-auto pb-4">

            @livewire('task-modal')
            @livewire('task-sidebar')

            @foreach($board['columns'] as $column)
                <div class="bg-white rounded-xl shadow-md w-80 flex-shrink-0 group relative">
                    <!-- Заголовок колонки -->
                    <div class="px-4 py-3 border-b flex items-center justify-between">
                        <div>
                            <h2 class="font-semibold text-lg">{{ $column->title }}</h2>
                            <span class="text-sm text-gray-500">{{ $column->tasks_count }} задач</span>
                        </div>
                        <!-- Кнопка "Добавить задачу" появляется при hover -->
                        <button class="opacity-0 group-hover:opacity-100 transition text-indigo-500 hover:text-indigo-700" title="Добавить задачу">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </div>

                    <!-- Задачи -->
                    <div class="p-4 space-y-4">

                        @foreach($column->tasks as $task)
                            <div
                                class="bg-white p-4 rounded-lg shadow hover:shadow-md transition cursor-pointer border border-gray-200"
                                @click="Livewire.dispatchTo('task-modal', 'openTaskModal', [{{ $task->id }}])"
                            >
                            <!-- Заголовок + Приоритет -->
                                <div class="flex items-center space-x-2 mb-1">
                                    <h3 class="font-semibold text-gray-800">{{ $task->title }}</h3>
                                    @php
                                        $priorityIcons = [
                                            'medium' => '🔥',
                                            'high'   => '🔥🔥',
                                            'urgent' => '🔥🔥🔥',
                                        ];
                                    @endphp
                                    @if($task->priority !== 'low' && isset($priorityIcons[$task->priority->value]))
                                        <span>{{ $priorityIcons[$task->priority->value] }}</span>
                                    @endif
                                </div>

                                <!-- Дата -->
                                <div class="text-sm text-gray-500 mb-2">
                                    {{ \Carbon\Carbon::parse($task->due_date)->format('d M, H:i') }}
                                </div>

                                <!-- Статус -->
                                @php
                                    $statusColors = [
                                        'pending'   => 'bg-yellow-100 text-yellow-800',
                                        'completed' => 'bg-green-100 text-green-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                    ];
                                @endphp
                                <span class="inline-block px-2 py-0.5 rounded text-xs font-medium {{ $statusColors[$task->status->value] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($task->status->value) }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <button class="w-full py-2 text-sm text-blue-600 hover:bg-blue-50 rounded-b-xl">+ Добавить задачу</button>
                </div>
            @endforeach

            <!-- Блок для добавления новой колонки -->
            <div class="bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl w-80 flex-shrink-0 flex items-center justify-center cursor-pointer hover:bg-gray-100">
                <div class="flex items-center text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Добавить колонку</span>
                </div>
            </div>

        </div>
    </div>
@endsection
