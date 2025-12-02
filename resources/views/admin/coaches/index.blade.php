@extends('layouts.admin')

@section('title', 'Kelola Pembina')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>Kelola Pembina (Coaches)</h1>
        <a href="{{ route('admin.coaches.create') }}" class="btn btn-primary">➕ Tambah Pembina</a>
    </div>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>NIP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($coaches as $coach)
                <tr>
                    <td style="text-align:center;">
                        @if($coach->photo)
                            <img src="{{ asset('storage/'.$coach->photo) }}" alt="{{ $coach->name }}" 
                                 style="width:45px; height:45px; border-radius:50%; object-fit:cover;">
                        @else
                            <div style="width:45px; height:45px; border-radius:50%; background:#444; display:flex; align-items:center; justify-content:center; color:#999; font-size:20px; margin:0 auto;">
                                👨‍🏫
                            </div>
                        @endif
                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $coach->name }}</td>
                    <td>{{ $coach->position }}</td>
                    <td>{{ $coach->nip }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('admin.coaches.edit', $coach) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                        <form action="{{ route('admin.coaches.destroy', $coach) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">🗑️ Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center; padding:2rem;">Belum ada data pembina.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">{{ $coaches->links() }}</div>
</div>
@endsection
