<div
    x-data="{ show: @entangle('show') }"
    x-show="show"
    x-transition.opacity.duration.200
    x-on:keydown.window.escape="show = false; @this.close()"
    style="display: none; margin: 0;"
    class="fixed inset-0 bg-black/20 backdrop-blur-sm flex items-center justify-center z-50"
    @click.self="show = false; @this.close()"
>
    <div
        x-show="show"
        x-transition.duration.200.scale.95.origin.center
        class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 relative"
    >

        <div class="absolute top-3 right-3 flex items-center space-x-2">

            <!-- Кнопка "Раскрыть" -->
            <button @click="Livewire.dispatchTo('task-sidebar', 'openTaskPanel', [{{ $task?->id }}])"
               class="text-gray-400 hover:text-blue-500"
               title="Открыть полную задачу"
            >
                <!-- SVG "раскрыть" -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5"
                     fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 8V4h4M16 4h4v4M4 16v4h4m8 0h4v-4" />
                </svg>
            </button>

            <!-- Крестик закрытия -->
            <button wire:click="close"
                    class="text-gray-400 hover:text-gray-600 text-2xl leading-none">
                &times;
            </button>
        </div>

        <!-- Содержимое задачи -->
        <h2 class="text-2xl font-bold mb-4" x-text="@js($task?->title ?? '')"></h2>

        <p class="text-sm text-gray-600 mb-2">
            <strong>Дедлайн:</strong> <span x-text="@js($task?->due_date?->format('d M H:i') ?? '')"></span>
        </p>

        <p class="mb-4">
            <strong>Описание:</strong> <span x-text="@js($task?->description ?? 'Нет описания')"></span>
        </p>

        <div>
            <span
                class="inline-block px-3 py-1 rounded-full text-xs font-semibold"
                :class="{
                    'bg-yellow-100 text-yellow-800': @js(optional($task)->status?->value) === 'pending',
                    'bg-green-100 text-green-800': @js(optional($task)->status?->value) === 'completed',
                    'bg-red-100 text-red-800': @js(optional($task)->status?->value) === 'cancelled',
                }"
                x-text="@js(ucfirst(optional($task)->status?->value ?? ''))"
            ></span>
        </div>
    </div>
</div>
