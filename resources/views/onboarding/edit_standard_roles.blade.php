@extends('layouts.onboarding')

@section('content')

    {{-- Прогресс --}}
    <div class="flex flex-col mb-6 space-y-2">
        <span class="text-center text-gray-600 font-medium text-sm">Step 4 of 5</span>
        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
            <div class="bg-indigo-500 h-2 transition-all duration-500" style="width: 85%;"></div>
        </div>
    </div>

    <h1 class="text-3xl font-extrabold mb-4">Customize Project Roles</h1>
    <p class="text-gray-600 mb-6">
        Review and tailor the default roles to better suit your team’s workflow and responsibilities.
    </p>

    <form method="POST" action="{{ route('onboarding.step.next', ['step' => 'edit_roles_standard']) }}">
        @csrf

        <x-role-form
            :permissions="['View Tasks', 'Edit Tasks', 'Manage Users', 'Assign Roles', 'Delete Tasks']"
            :roles="[
                ['name' => 'Developer', 'description' => 'Can manage and complete assigned tasks.', 'permissions' => ['View Tasks', 'Edit Tasks']],
                ['name' => 'Senior Developer', 'description' => 'Can review and manage tasks of others.', 'permissions' => ['View Tasks', 'Edit Tasks', 'Delete Tasks']],
                ['name' => 'Tester', 'description' => 'Responsible for testing features and reporting bugs.', 'permissions' => ['View Tasks']],
                ['name' => 'Project Manager', 'description' => 'Manages the team and assigns roles.', 'permissions' => ['View Tasks', 'Manage Users', 'Assign Roles']],
            ]"
        />

        <button type="submit"
                class="w-full mt-6 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-purple-600 hover:to-pink-500 text-white font-bold py-3 rounded-xl shadow-md transition transform hover:scale-105">
            Save Roles
        </button>
    </form>

@endsection
