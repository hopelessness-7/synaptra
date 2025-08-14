@extends('layouts.onboarding')

@section('card_class', 'max-w-5xl')
@section('content')
    {{-- Progress bar --}}
    <div class="flex flex-col mb-6 space-y-2">
        <span class="text-center text-sm font-medium text-gray-600">Step 3 of 3</span>
        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
            <div class="bg-indigo-500 h-2 transition-all duration-500" style="width: 100%;"></div>
        </div>
    </div>

    <h1 class="text-4xl font-extrabold mb-4">Import Your Team Members</h1>
    <p class="text-lg text-gray-600 mb-6">
        Add your team to Synaptra quickly by uploading an Excel file or adding members manually.
    </p>

    {{-- Форма загрузки Excel --}}
    <form method="POST" action="{{ route('users.import') }}" enctype="multipart/form-data" class="mb-6">
        @csrf

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center space-x-4 mb-4">
            <label
                for="excel_file"
                class="relative flex items-center w-1/2 cursor-pointer rounded-xl
                   gradient-border-input
                   bg-white
                   overflow-hidden
                   h-11
                   focus-within:ring-4 focus-within:ring-indigo-400
                   transition duration-300 ease-in-out"
            >
                <span id="file-name" class="text-gray-600 select-none truncate px-3 py-1 w-full leading-none">
                    Choose file...
                </span>
                <input
                    type="file"
                    name="excel_file"
                    id="excel_file"
                    accept=".xlsx,.xls"
                    required
                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                    onchange="document.getElementById('file-name').textContent = this.files.length > 0 ? this.files[0].name : 'Choose file...';"
                />
            </label>

            <input id="project_id" name="project_id" type="text" hidden value="{{$model?->project_id ?? old('project_id')}}" class="gradient-border-input">

            <button type="submit"
                    class="w-1/2 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-purple-600 hover:to-pink-500 text-white font-bold py-3 rounded-xl shadow-md transition transform hover:scale-105">
                Upload
            </button>
        </div>

        <div class="text-sm text-gray-500 mt-1">
            <a href="{{ asset('/files/import_exeple.xlsx') }}" class="text-indigo-600 hover:underline">📄 Download sample file</a>
        </div>

        @error('excel_file')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </form>

{{--    --}}{{-- Или вручную добавить сотрудника --}}
{{--    <div class="mb-6">--}}
{{--        <h2 class="text-2xl font-semibold mb-2">Or add team members manually</h2>--}}
{{--        <a href="{{ route('onboarding.step', 'create_user') }}"--}}
{{--           class="inline-block text-indigo-600 hover:text-indigo-800 underline font-medium">--}}
{{--            Go to manual user addition form →--}}
{{--        </a>--}}
{{--    </div>--}}



    @if(session('success'))
        <a href="{{ route('onboarding.step', 'finish') }}"
           class="px-5 py-3 rounded-xl border text-indigo-600 font-medium hover:underline">
            finish →
        </a>
    @else
        <div class="flex justify-end mt-8">
            <a href="{{ route('onboarding.step', 'finish') }}"
               class="px-5 py-3 rounded-xl border text-indigo-600 font-medium hover:underline">
                Skip →
            </a>
        </div>
    @endif

@endsection
