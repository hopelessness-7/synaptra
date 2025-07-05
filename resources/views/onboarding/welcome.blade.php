@extends('layouts.onboarding')

@section('content')
    {{-- Progress bar и остальные твои элементы --}}
    <div class="flex flex-col mb-6 space-y-2">
        <span class="text-center text-sm font-mediumtext-gray-600">Step 0 of 4</span>
        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
            <div class="bg-indigo-500 h-2 transition-all duration-500" style="width: 0%;"></div>
        </div>
    </div>


    <h1 class="text-4xl font-extrabold mb-4">Welcome to Synaptra 🚀</h1>
    <p class="text-lg text-gray-600 mb-6">
        Let’s set up your first project and get your team moving faster.
    </p>

    <div class="flex items-start bg-indigo-50 p-4 rounded-lg text-indigo-800 mb-6">
        <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 110 20 10 10 0 010-20z"/>
        </svg>
        <span>Pro tip: You can always reconfigure your project later in Settings.</span>
    </div>

    <form method="POST" action="{{ route('onboarding.step.next', 'welcome') }}">
        @csrf
        <button type="submit"
                class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-purple-600 hover:to-pink-500 text-white font-bold py-3 rounded-xl shadow-md transition transform hover:scale-105">
            Start Setup →
        </button>
    </form>
@endsection
