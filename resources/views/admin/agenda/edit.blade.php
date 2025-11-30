@extends('layouts.app')

@section('title', 'Edit Agenda - Admin')

@section('content')
    <!-- Header -->
    <h1 class="text-4xl font-bold text-gray-900 mb-8">📅 Edit Agenda Kegiatan</h1>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-2xl">
        <form action="{{ route('admin.agenda.update', $agenda) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Title Field -->
            <div class="mb-6">
                <label for="title" class="block text-gray-700 font-semibold mb-2">Judul Agenda *</label>
                <input type="text" id="title" name="title" value="{{ old('title', $agenda->title) }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-red-700 @error('title') border-red-500 @enderror"
                       placeholder="Masukkan judul agenda">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date Field -->
            <div class="mb-6">
                <label for="date" class="block text-gray-700 font-semibold mb-2">Tanggal *</label>
                <input type="date" id="date" name="date" value="{{ old('date', $agenda->date->format('Y-m-d')) }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-red-700 @error('date') border-red-500 @enderror">
                @error('date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Location Field -->
            <div class="mb-6">
                <label for="location" class="block text-gray-700 font-semibold mb-2">Lokasi (Opsional)</label>
                <input type="text" id="location" name="location" value="{{ old('location', $agenda->location) }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-red-700"
                       placeholder="Masukkan lokasi kegiatan">
            </div>

            <!-- Description Field -->
            <div class="mb-8">
                <label for="description" class="block text-gray-700 font-semibold mb-2">Deskripsi *</label>
                <textarea id="description" name="description" rows="6"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-red-700 @error('description') border-red-500 @enderror"
                          placeholder="Masukkan deskripsi lengkap kegiatan">{{ old('description', $agenda->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
                <button type="submit" class="bg-red-700 hover:bg-red-800 text-white px-6 py-3 rounded-lg font-semibold transition">
                    💾 Perbarui Agenda
                </button>
                <a href="{{ route('admin.agenda.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold transition">
                    ❌ Batal
                </a>
            </div>
        </form>
    </div>
@endsection
