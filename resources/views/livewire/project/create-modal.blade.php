<div class="fixed inset-0 flex items-center justify-center z-50">

    <!-- Блюр + Лёгкое затемнение одним слоем -->
    <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>

    <!-- Модальное окно -->
    <div class="relative bg-white rounded-lg shadow-lg p-6 w-full max-w-md z-50">
        <h2 class="text-xl font-semibold mb-4">Create Your First Project</h2>

        <form wire:submit.prevent="create" class="space-y-4">
            <div>
                <input type="text" wire:model.defer="name"
                       class="w-full p-2 border rounded"
                       placeholder="Project Name" />
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <input type="text" wire:model.defer="slug"
                       class="w-full p-2 border rounded"
                       placeholder="Project slug" />
                @error('slug') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <textarea wire:model.defer="description"
                          class="w-full p-2 border rounded"
                          placeholder="Project Description"></textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <input type="text" wire:model.defer="git_repo_url"
                       class="w-full p-2 border rounded"
                       placeholder="Url git repository" />
                @error('git_repo_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit"
                    class="w-full bg-indigo-500 hover:bg-indigo-600 text-white py-2 rounded">
                Create Project
            </button>
        </form>
    </div>
</div>
