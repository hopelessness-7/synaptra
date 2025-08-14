@extends('layouts.onboarding')

@section('content')

    <div class="flex flex-col mb-6 space-y-2">
        <span class="text-center text-sm font-medium text-gray-600">Step 3 of 3</span>
        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
            <div class="bg-indigo-500 h-2 transition-all duration-500" style="width: 100%;"></div>
        </div>
    </div>

    <h1 class="text-4xl font-extrabold mb-4">Add Team Members Manually</h1>
    <p class="text-lg text-gray-600 mb-6">
        Fill out the form below to add individual team members. You can add as many as you need — one at a time.
    </p>

    @php
        $grades = \App\Modules\Project\Domain\Enums\GradeEnum::toArray();
        $specializations = \App\Modules\Project\Domain\Enums\SpecializationEnum::toArray();
    @endphp

    <form method="POST" action="{{ route('onboarding.step.next', ['step' => 'save_manual_users']) }}">
        @csrf

        <x-user-form :grades="$grades" :specializations="$specializations" />


        <div class="grid grid-cols-5 gap-4 mt-8">
            {{-- Back --}}
            <a href="{{ route('onboarding.step', 'invite_team') }}"
               class="px-5 py-3 text-center rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition col-span-1">
                ← Back
            </a>

            {{-- Save Users --}}
            <button type="submit"
                    class="px-5 py-3 col-span-3 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-purple-600 hover:to-pink-500 text-white font-bold rounded-xl shadow-md transition transform hover:scale-105">
                Save Users
            </button>

            {{-- Skip --}}
            <a href="{{ route('onboarding.step', 'finish') }}"
               class="px-5 py-3 text-center rounded-xl border text-indigo-600 font-medium hover:underline col-span-1">
                Skip →
            </a>
        </div>

    </form>
@endsection
