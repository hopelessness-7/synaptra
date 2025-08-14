@extends('layouts.onboarding')

@section('content')

    {{-- Прогресс бар (100%) --}}
    <div class="flex flex-col mb-6 space-y-2">
        <span class="text-center text-sm font-medium text-gray-600">Step 3 of 3</span>
        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
            <div class="bg-indigo-500 h-2 transition-all duration-500" style="width: 100%;"></div>
        </div>
    </div>

    {{-- Заголовок --}}
    <h1 class="text-4xl font-extrabold mb-4 text-center">🎉 All Set!</h1>
    <p class="text-lg text-gray-600 mb-8 text-center max-w-2xl mx-auto">
        Your Synaptra workspace is ready to go.
        The project, boards, and team members you’ve created during onboarding are now live and ready to use.
        You can customize them anytime as your work evolves.
    </p>

    {{-- Совет --}}
    <div class="flex items-start bg-indigo-50 p-4 rounded-lg text-indigo-800 mb-10 max-w-2xl mx-auto">
        <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 110 20 10 10 0 010-20z"/>
        </svg>
        <span>Pro tip: All settings and configurations made during onboarding can be adjusted later.</span>
    </div>

    {{-- Кнопка начать работу --}}
    <div class="text-center">
        <form method="POST" action="{{ route('onboarding.finish') }}">
            @csrf
            <button type="submit"
                    class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-purple-600 hover:to-pink-500 text-white font-bold py-3 rounded-xl shadow-md transition transform hover:scale-105">
                Start Setup →
            </button>
        </form>
    </div>

@endsection
