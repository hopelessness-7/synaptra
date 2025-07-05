@extends('layouts.onboarding')

@section('content')
    {{-- Прогресс --}}
    <div class="flex flex-col mb-6 space-y-2">
        <span class="text-center text-sm font-medium text-gray-600">Step 1 of 4</span>
        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
            <div class="bg-indigo-500 h-2 transition-all duration-500" style="width: 10%;"></div>
        </div>
    </div>

    {{-- Заголовок --}}
    <h1 class="text-3xl font-extrabold mb-4">Create Your First Project</h1>
    <p class="text-gray-600 mb-6">
        Start by naming your project and adding some details.
    </p>

    {{-- Форма создания проекта --}}
    <form method="POST" action="{{ route('onboarding.step.next', 'create_project') }}">
        @csrf

        <div class="flex space-x-4 mb-4">
            <div class="w-1/2">
                <label for="name" class="block font-semibold mb-1">Project Name</label>
                <input id="name" name="name" type="text"
                       class="gradient-border-input @error('name') error @enderror"
                       value="{{ old('name') }}" required autofocus>
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="w-1/2">
                <label for="slug" class="block font-semibold mb-1">Project Slug</label>
                <input id="slug" name="slug" type="text"
                       class="gradient-border-input @error('slug') error @enderror"
                       value="{{ old('slug') }}" required>
                @error('slug')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="description" class="block font-semibold mb-1">Description</label>
            <textarea id="description" name="description" rows="3"
                      class="gradient-border-input @error('description') error @enderror">{{ old('description') }}</textarea>
            @error('description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="git_repo_url" class="block font-semibold mb-1">Git Repository URL (optional)</label>
            <input id="git_repo_url" name="git_repo_url" type="url"
                   class="gradient-border-input @error('git_repo_url') error @enderror"
                   value="{{ old('git_repo_url') }}">
            @error('git_repo_url')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-purple-600 hover:to-pink-500 text-white font-bold py-3 rounded-xl shadow-md transition transform hover:scale-105">
            Create Project
        </button>
    </form>
@endsection
