<div
    x-data="{
        show: @entangle('show'),
        task: @entangle('task'),
        boardId: @entangle('boardId'),
        columnId: @entangle('columnId'),
        taskId: @entangle('taskId'),
        copyLink() {
            const url = `${window.location.origin}/kanban/boards/${this.boardId}/columns/${this.columnId}/tasks/${this.taskId}`;
            navigator.clipboard.writeText(url);
        }
    }"
    x-show="show"
    x-effect="if(show) history.pushState(null,'',`/kanban/boards/${boardId}/columns/${columnId}/tasks/${taskId}`);
        else history.pushState(null,'',`/kanban/boards/${boardId}`)"
    x-transition:enter="transition-transform duration-300"
    x-transition:enter-start="translate-x-[1200px]"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition-transform duration-300"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="translate-x-[1200px]"
    x-on:keydown.window.escape="show = false; @this.close()"
    class="fixed inset-0 z-50 flex justify-end"
    style="display: none; margin: 0"
>
    <!-- Фон -->
    <div
        x-show="show"
        x-transition.opacity.duration.200
        class="fixed inset-0 bg-black/40 backdrop-blur-sm"
        @click="show = false; @this.close()"
    ></div>

    <!-- Основной Sidebar -->
    <div class="relative w-[1200px] max-w-full h-full bg-gray-100 overflow-y-auto flex flex-col shadow-2xl">
        <!-- Шапка Sidebar -->
        <div class="flex justify-between items-center px-6 py-4 bg-white shadow-md sticky top-0 z-10">
            <div class="flex items-center space-x-3">
                <h2 class="text-xl font-semibold text-gray-800">{{ $task?->title }}</h2>

                <!-- Кнопка копирования -->
                <button
                    @click="copyLink()"
                    class="text-gray-400 hover:text-blue-500 transition-colors"
                    title="Copy task link"
                >
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5"
                         fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M10 13a5 5 0 007.07 0l1.42-1.42a5 5 0 00-7.07-7.07L9 5.93M14 11a5 5 0 00-7.07 0L5.51 12.42a5 5 0 007.07 7.07L15 16.07" />
                    </svg>
                </button>
            </div>

            <button @click="show = false; @this.close()" class="text-gray-400 hover:text-gray-700 text-3xl leading-none">&times;</button>
        </div>

        <div class="flex flex-1 gap-6 px-6 py-4">
            <!-- Левая колонка -->
            <div class="flex-1 flex flex-col gap-6">
                <!-- Основная карточка -->
                <div class="bg-white rounded-2xl shadow-lg p-6 space-y-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="font-medium text-gray-700">Task №{{ $task?->id }} - </span>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold"
                                  :class="{
                                      'bg-yellow-100 text-yellow-800': @js(optional($task)->status?->value) === 'pending',
                                      'bg-green-100 text-green-800': @js(optional($task)->status?->value) === 'completed',
                                      'bg-red-100 text-red-800': @js(optional($task)->status?->value) === 'cancelled',
                                  }"
                            >{{$task?->status}}</span>
                        </div>

                        @php
                            $priorityMap = [
                                'low' => 0,
                                'medium' => 1,
                                'high' => 2,
                                'urgent' => 3,
                            ];
                        @endphp

                        <div x-data="{ priority: @js($priorityMap[optional($task?->priority)->value] ?? 0) }" class="flex space-x-1">
                            <template x-for="(fire, index) in 3" :key="index">
                                <svg
                                    @click="priority = index + 1"
                                    :class="index < priority ? 'text-red-500' : 'text-gray-300'"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 cursor-pointer"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path d="M10 2C7.8 5 5 7 5 11c0 3 2 6 5 6s5-3 5-6c0-4-2.8-6-5-9z"/>
                                </svg>
                            </template>
                        </div>
                    </div>

                    <div class="text-gray-700 text-sm" x-text="@js($task?->description ?? 'Нет описания')"></div>

                    <div class="flex gap-3">
                        <button class="flex-1 bg-blue-500 hover:bg-blue-600 text-white rounded-xl py-2 text-sm font-medium">
                            {{ $task?->status->value === 'pending' ? 'Start' : 'Finish' }}
                        </button>
                        <button class="flex-1 border border-gray-300 hover:bg-gray-50 rounded-xl py-2 text-sm font-medium">Edit</button>
                    </div>
                </div>

                <!-- Результат -->
                <div class="bg-white rounded-2xl shadow-lg p-6 space-y-2">
                    <h3 class="font-semibold text-gray-700">Result</h3>
                    <div class="text-gray-600 text-sm" x-text="task?.result ?? 'Нет результата'"></div>
                </div>

                <!-- Вкладки -->
                <div x-data="{ tab: 'comments' }" class="flex flex-col space-y-0">
                    <!-- Вкладки -->
                    <div class="flex -mb-1"> <!-- -mb-1 чтобы активная вкладка перекрывала границу контента -->
                        <button
                            class="flex-1 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors rounded-t-xl border"
                            :class="tab === 'comments' ? 'bg-white text-blue-600 font-semibold border-none z-10 relative' : 'bg-gray-100 border-gray-200'"
                            @click="tab = 'comments'"
                        >
                            Comments
                        </button>
                        <button
                            class="flex-1 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors rounded-t-xl border"
                            :class="tab === 'history'  ? 'bg-white text-blue-600 font-semibold border-none z-10 relative' : 'bg-gray-100 border-gray-200'"
                            @click="tab = 'history'"
                        >
                            History
                        </button>
                        <button
                            class="flex-1 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors rounded-t-xl border"
                            :class="tab === 'files' ? 'bg-white text-blue-600 font-semibold border-none z-10 relative' : 'bg-gray-100 border-gray-200'"
                            @click="tab = 'files'"
                        >
                            Files
                        </button>
                    </div>

                    <!-- Контент вкладок -->
                    <div class="bg-white rounded-b-2xl shadow-lg p-4 text-sm text-gray-600 min-h-[120px]">
                        <div x-show="tab === 'comments'" x-transition.opacity>Здесь будут комментарии</div>
                        <div x-show="tab === 'history'" x-transition.opacity>Здесь будет история изменений</div>
                        <div x-show="tab === 'files'" x-transition.opacity>Здесь будут файлы задачи</div>
                    </div>
                </div>
            </div>

            <!-- Правая колонка: единая карточка информации -->
            <div class="w-96 flex-shrink-0">
                <div class="bg-white rounded-2xl shadow-lg p-6 space-y-5">
                    <!-- Даты -->
                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">Started:</span>
                            <span>{{ $task?->started_at?->format('d M H:i') ?? '—' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">Deadline:</span>
                            <span x-text="@js($task?->due_date?->format('d M H:i') ?? '—')"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">Reminder:</span>
                            <span>-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">Assigned:</span>
                            <span x-text="@js($task?->created_at?->format('d M H:i') ?? '—')"></span>
                        </div>
                    </div>

                    <hr class="border-gray-200" />

                    <!-- Пользователи -->
                    <div class="space-y-4 text-sm text-gray-600">
                        @foreach(['Creator' => $task?->creator, 'Assignee' => $task?->assignee, 'Co-assignees' => $task?->coAssignees, 'Watchers' => $task?->watchers] as $label => $users)
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="font-medium text-gray-700">{{ $label }}</span>
                                    <button class="text-blue-500 text-xs hover:underline">edit</button>
                                </div>
                                <hr class="border-gray-200" />
                                <div class="space-y-1">
                                    @if($users instanceof \Illuminate\Support\Collection || is_array($users))
                                        @foreach($users as $user)
                                            <div>{{ $user->name ?? '-' }}</div>
                                        @endforeach
                                    @else
                                        <div>{{ $users->name ?? '-' }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
