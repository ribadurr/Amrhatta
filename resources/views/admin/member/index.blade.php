@extends('layouts.admin')

@section('title', 'Kelola Anggota')

@section('content')
<div class="admin-container">
    <!-- Header -->
    <div class="admin-header">
        <div>
            <h1>👥 Kelola Anggota</h1>
            <p style="color: #999; margin-top: 0.5rem;">Total: {{ $members->total() }} anggota</p>
        </div>
        <a href="{{ route('admin.member.create') }}" class="btn btn-primary">
            + Tambah Anggota
        </a>
    </div>

    <!-- Table -->
    @if($members->count() > 0)
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>NISN</th>
                        <th>Kelas</th>
                        <th>Jabatan</th>
                        <th>Bergabung</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                        <tr>
                            <td>{{ $member->full_name }}</td>
                            <td>{{ $member->nisn }}</td>
                            <td>{{ $member->grade_class }}</td>
                            <td>
                                <span class="badge badge-info">{{ $member->position }}</span>
                            </td>
                            <td>
                                @if($member->join_date)
                                    {{ $member->join_date->format('d M Y') }}
                                @else
                                    <span style="color: #666;">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.member.edit', $member) }}" class="btn btn-secondary btn-sm">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('admin.member.destroy', $member) }}" method="POST" style="display: inline;" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $members->links() }}
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">👤</div>
            <p class="empty-state-text">Belum ada data anggota</p>
            <a href="{{ route('admin.member.create') }}" class="btn btn-primary" style="margin-top: 1rem;">
                Tambah Anggota Pertama
            </a>
        </div>
    @endif
</div>
@endsection
