@extends('layouts.onboarding')

@section('content')

    {{-- Прогресс --}}
    <div class="flex flex-col mb-6 space-y-2">
        <span class="text-center text-gray-600 font-medium text-sm">Step 4 of 5</span>
        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
            <div class="bg-indigo-500 h-2 transition-all duration-500" style="width: 85%;"></div>
        </div>
    </div>

    <h1 class="text-3xl font-extrabold mb-4">Define Custom Roles</h1>
    <p class="text-gray-600 mb-6">
        Set up your own roles and permissions structure to match your team's unique needs.
    </p>

    <form method="POST" action="{{ route('onboarding.step.next', ['step' => 'create_roles_custom']) }}">
        @csrf

        <x-role-form :permissions="['View Tasks', 'Edit Tasks', 'Manage Users', 'Assign Roles', 'Delete Tasks']" />

        <button type="submit"
                class="w-full mt-6 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-purple-600 hover:to-pink-500 text-white font-bold py-3 rounded-xl shadow-md transition transform hover:scale-105">
            Save Roles
        </button>
    </form>

@endsection
