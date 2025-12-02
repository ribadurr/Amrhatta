@extends('layouts.admin')

@section('title', 'Kelola Events')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>Kelola Events</h1>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
            ➕ Tambah Event Baru
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th>Pembina</th>
                    <th>Peserta</th>
                    <th>Durasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</td>
                    <td>{{ $event->location }}</td>
                    <td>
                        @if($event->coach)
                            <span class="badge badge-success">{{ $event->coach->name }}</span>
                        @else
                            <span style="color: #666;">-</span>
                        @endif
                    </td>
                    <td>{{ $event->participants }}</td>
                    <td>{{ $event->duration }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-warning btn-sm">
                            ✏️ Edit
                        </a>
                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                🗑️ Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 2rem;">
                        Belum ada data event.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $events->links() }}
    </div>
</div>
@endsection