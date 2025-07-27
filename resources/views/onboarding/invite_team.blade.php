@extends('layouts.onboarding')

@section('card_class', 'max-w-5xl')
@section('content')
    {{-- Progress bar --}}
    <div class="flex flex-col mb-6 space-y-2">
        <span class="text-center text-sm font-medium text-gray-600">Step 5 of 5</span>
        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
            <div class="bg-indigo-500 h-2 transition-all duration-500" style="width: 100%;"></div>
        </div>
    </div>

    <h1 class="text-4xl font-extrabold mb-4">Import Your Team Members</h1>
    <p class="text-lg text-gray-600 mb-6">
        Add your team to Synaptra quickly by uploading an Excel file or adding members manually.
    </p>

    {{-- Форма загрузки Excel --}}
    <form method="POST" action="{{ route('onboarding.step.next', ['step' => 'import_users']) }}" enctype="multipart/form-data" class="mb-6">
        @csrf

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


            <button type="submit"
                    class="w-1/2 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-purple-600 hover:to-pink-500 text-white font-bold py-3 rounded-xl shadow-md transition transform hover:scale-105">
                Upload and Preview
            </button>
        </div>

        @error('excel_file')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </form>

    {{-- Или вручную добавить сотрудника --}}
    <div class="mb-6">
        <h2 class="text-2xl font-semibold mb-2">Or add team members manually</h2>
        <a href="{{route('onboarding.step', 'create_user')}}"
           class="inline-block text-indigo-600 hover:text-indigo-800 underline font-medium">
            Go to manual user addition form →
        </a>
    </div>

    {{-- Если Excel файл загружен и есть данные для предпросмотра --}}
    @if(isset($previewUsers) && count($previewUsers) > 0)
        <h3 class="text-xl font-bold mb-4">Preview Imported Users</h3>
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-3 py-2 text-left">Full Name</th>
                    <th class="border border-gray-300 px-3 py-2 text-left">Email</th>
                    <th class="border border-gray-300 px-3 py-2 text-left">Grade</th>
                    <th class="border border-gray-300 px-2 py-2 text-left">Specialization</th>
                </tr>
                </thead>
                <tbody>
                @foreach($previewUsers as $index => $user)
                    <tr>
                        <td class="border border-gray-300 px-3 py-2">{{ $user['full_name'] ?? '' }}</td>
                        <td class="border border-gray-300 px-3 py-2">{{ $user['email'] ?? '' }}</td>
                        <td class="border border-gray-300 px-3 py-2">
                            <select name="users[{{ $index }}][grade]" class="w-full border rounded px-2 py-1">
                                @foreach($grades as $grade)
                                    <option value="{{ $grade }}">{{ $grade }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <select name="users[{{ $index }}][specialization]" class="w-full border rounded px-2 py-1">
                                @foreach($specializations as $specialization)
                                    <option value="{{ $specialization }}">{{ $specialization }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{-- Кнопка сохранить импорт --}}
        <form method="POST" action="{{ route('onboarding.step.next', ['step' => 'save_imported_users']) }}" class="mt-6">
            @csrf
            <button type="submit"
                    class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-purple-600 hover:to-pink-500 text-white font-bold py-3 px-6 rounded-xl shadow-md transition transform hover:scale-105">
                Save Imported Users
            </button>
        </form>
    @endif
@endsection
