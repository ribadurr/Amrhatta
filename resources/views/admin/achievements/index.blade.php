@extends('layouts.admin')

@section('title', 'Kelola Prestasi')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>Kelola Prestasi (Achievements)</h1>
        <a href="{{ route('admin.achievements.create') }}" class="btn btn-primary">
            ➕ Tambah Prestasi Baru
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tahun</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Nama Siswa</th>
                    <th>Event</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($achievements as $achievement)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $achievement->year }}</td>
                    <td>{{ $achievement->title }}</td>
                    <td>{{ $achievement->category }}</td>
                    <td>{{ optional($achievement->member)->full_name ?? '-' }}</td>
                    <td>{{ optional($achievement->event)->title ?? '-' }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('admin.achievements.edit', $achievement) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                        <form action="{{ route('admin.achievements.destroy', $achievement) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">🗑️ Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center; padding:2rem;">Belum ada data prestasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">{{ $achievements->links() }}</div>
</div>
@endsection
