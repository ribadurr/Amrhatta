@extends('layouts.app')

@section('title', 'Kelola Agenda - Admin')

@section('content')
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">📅 Kelola Agenda Kegiatan</h1>
            <p class="text-gray-600">Total Agenda: {{ $agendas->total() }}</p>
        </div>
        <a href="{{ route('admin.agenda.create') }}" class="bg-red-700 hover:bg-red-800 text-white px-6 py-3 rounded-lg font-semibold transition">
            + Tambah Agenda
        </a>
    </div>

    <!-- Agendas Table -->
    @if($agendas->count() > 0)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-red-700 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">Judul</th>
                            <th class="px-6 py-4 text-left font-semibold">Tanggal</th>
                            <th class="px-6 py-4 text-left font-semibold">Lokasi</th>
                            <th class="px-6 py-4 text-left font-semibold">Deskripsi</th>
                            <th class="px-6 py-4 text-left font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($agendas as $agenda)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $agenda->title }}</td>
                                <td class="px-6 py-4 text-gray-700">
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                                        {{ $agenda->date->format('d M Y') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ $agenda->location ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-700">
                                    {{ \Illuminate\Support\Str::limit($agenda->description, 50) }}
                                </td>
                                <td class="px-6 py-4 space-x-2">
                                    <a href="{{ route('admin.agenda.edit', $agenda) }}" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.agenda.destroy', $agenda) }}" method="POST" class="inline" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus agenda ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $agendas->links() }}
        </div>
    @else
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-12 text-center">
            <p class="text-gray-600 text-lg mb-4">Belum ada agenda kegiatan</p>
            <a href="{{ route('admin.agenda.create') }}" class="text-red-700 hover:text-red-800 font-semibold">
                Buat agenda pertama Anda →
            </a>
        </div>
    @endif
@endsection
