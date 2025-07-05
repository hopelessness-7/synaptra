@extends('layouts.onboarding')

@section('content')

    {{-- Прогресс --}}
    <div class="flex flex-col mb-6 space-y-2">
        <span class="text-center text-gray-600 font-medium text-sm">Step 4 of 5</span>
        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
            <div class="bg-indigo-500 h-2 transition-all duration-500" style="width: 85%;"></div>
        </div>
    </div>

    <h1 class="text-3xl font-extrabold mb-4">Project Roles</h1>
    <p class="text-gray-600 mb-6">
        Define who can do what in your project. You can use our recommended roles or create your own.
    </p>

    {{-- Выбор режима --}}
    <form method="POST" action="{{ route('onboarding.step.next', 'create_roles') }}">
        @csrf

        <div x-data="{ selected: 'standard' }" class="space-y-4 mb-6">
            {{-- Стандартные роли --}}
            <label
                :class="selected === 'standard' ? 'border-indigo-500 ring-2 ring-indigo-300' : 'border-gray-300'"
                class="block border p-4 rounded-xl cursor-pointer hover:border-indigo-400 transition-all bg-white shadow-sm">
                <input type="radio" name="role_mode" value="standard" class="hidden" x-model="selected">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="font-bold text-lg text-gray-900">Use Standard Roles</h2>
                        <p class="text-sm text-gray-600">Developer, Senior Developer, Tester, Project Manager, etc.</p>
                    </div>
                    <a href="{{ route('onboarding.step', 'edit_standard_roles') }}" class="text-sm text-indigo-600 underline hover:text-indigo-800">Edit roles</a>
                </div>
            </label>

            {{-- Кастомные роли --}}
            <label
                :class="selected === 'custom' ? 'border-indigo-500 ring-2 ring-indigo-300' : 'border-gray-300'"
                class="block border p-4 rounded-xl cursor-pointer hover:border-indigo-400 transition-all bg-white shadow-sm">
                <input type="radio" name="role_mode" value="custom" class="hidden" x-model="selected">
                <div>
                    <h2 class="font-bold text-lg text-gray-900">Create Custom Roles</h2>
                    <p class="text-sm text-gray-600">Define permissions and structure roles your way.</p>
                </div>
            </label>
        </div>

        <div class="flex items-start bg-indigo-50 p-4 rounded-lg text-indigo-800 mb-6">
            <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 110 20 10 10 0 010-20z"/>
            </svg>
            <span>
                <strong>Pro tip:</strong> If you skip this step, default roles with preconfigured permissions will be created automatically.
                You can always customize roles later in Settings.
            </span>
        </div>


        {{-- Кнопки --}}
        <div class="flex justify-between items-center">
            <a href=""
               class="text-sm text-gray-500 underline hover:text-gray-700">Skip for now</a>

            <button type="submit"
                    class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-purple-600 hover:to-pink-500 text-white font-bold py-3 px-6 rounded-xl shadow-md transition transform hover:scale-105">
                Continue →
            </button>
        </div>
    </form>
@endsection
