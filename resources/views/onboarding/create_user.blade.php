@extends('layouts.onboarding')

@section('content')

    <div class="flex flex-col mb-6 space-y-2">
        <span class="text-center text-sm font-medium text-gray-600">Step 5 of 5</span>
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
        $roles = \App\Modules\Project\Infrastructure\Models\ProjectRole::all();
    @endphp

    <form method="POST" action="{{ route('onboarding.step.next', ['step' => 'save_manual_users']) }}">
        @csrf

        <x-user-form :roles="$roles" :grades="$grades" :specializations="$specializations" />

        <button type="submit"
                class="mt-6 w-full bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-purple-600 hover:to-pink-500 text-white font-bold py-3 rounded-xl shadow-md transition transform hover:scale-105">
            Save Users
        </button>
    </form>

@endsection
