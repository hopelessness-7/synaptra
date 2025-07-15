@extends('layouts.onboarding')

@section('content')

    {{-- Прогресс --}}
    <div class="flex flex-col mb-6 space-y-2">
        <span class="text-center text-gray-600 font-medium text-sm">Step 2 of 4</span>
        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
            <div class="bg-indigo-500 h-2 transition-all duration-500" style="width: 50%;"></div>
        </div>
    </div>

    <h1 class="text-3xl font-extrabold mb-4">Create Your First Board</h1>
    <p class="text-gray-600 mb-6">
        Organize your work and collaborate with your team using boards.
    </p>

    <form method="POST" action="{{ route('onboarding.step.next', 'create_board') }}">
        @csrf

        <div class="mb-4">
            <label for="title" class="block font-semibold mb-1">Board Title</label>
            <input id="title" name="title" type="text"
                   class="gradient-border-input @error('title') error @enderror"
                   value="{{ old('title') }}" required autofocus>
            @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block font-semibold mb-1">Description (optional)</label>
            <textarea id="description" name="description" rows="3"
                      class="gradient-border-input @error('description') error @enderror">{{ old('description') }}</textarea>
            @error('description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6 flex items-center space-x-2">
            <input id="is_default" name="is_default" type="checkbox" class="h-5 w-5 text-indigo-600 rounded border-gray-300 focus:ring-indigo-500" {{ old('is_default') ? 'checked' : '' }}>
            <label for="is_default" class="font-semibold select-none">Make this board the default</label>
        </div>

        {{$model?->id}}

        <div class="mb-6 flex items-center space-x-2">
            <input id="project_id" name="project_id" type="text" hidden value="{{$model?->id}}" class="gradient-border-input">
        </div>

        <button type="submit"
                class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-purple-600 hover:to-pink-500 text-white font-bold py-3 rounded-xl shadow-md transition transform hover:scale-105">
            Create Board
        </button>
    </form>

@endsection
