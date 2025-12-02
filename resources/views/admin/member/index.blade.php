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
        <div style="display:flex; gap:0.5rem; align-items:center;">
            <a href="{{ route('admin.member.create') }}" class="btn btn-primary">+ Tambah Anggota</a>
            <a href="{{ route('admin.member.export') }}" class="btn btn-secondary">⬇️ Export Excel</a>
            <form action="{{ route('admin.member.import') }}" method="POST" enctype="multipart/form-data" style="display:inline-block; margin:0;">
                @csrf
                <label class="btn btn-outline" style="padding:0.45rem 0.6rem; cursor:pointer; display:inline-flex; align-items:center; gap:0.5rem;">
                    ⬆️ Import
                    <input type="file" name="file" accept=".csv,.txt" style="display:none;" onchange="this.form.submit()">
                </label>
            </form>
        </div>
    </div>

    <!-- Table -->
    @if($members->count() > 0)
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>No</th>
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
                            <td>{{ $members->firstItem() + $loop->index }}</td>
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
        @if($members->hasPages())
            <div class="pagination-wrapper" style="margin-top:1.5rem; text-align:center;">
                <div style="color:#ccc; margin-bottom:.5rem;">Showing {{ $members->firstItem() }} to {{ $members->lastItem() }} of {{ $members->total() }} results</div>

                <nav aria-label="Page navigation">
                    <ul class="pagination" style="display:inline-flex; gap:.5rem; list-style:none; padding:0; margin:0; align-items:center;">
                        {{-- Previous --}}
                        @if($members->onFirstPage())
                            <li class="page-item disabled"><span class="page-link" style="opacity:.5;">&laquo; Previous</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $members->previousPageUrl() }}">&laquo; Previous</a></li>
                        @endif

                        {{-- Page Links --}}
                        @foreach(range(1, $members->lastPage()) as $i)
                            @if($i == $members->currentPage())
                                <li class="page-item active"><span class="page-link" style="font-weight:600;">{{ $i }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $members->url($i) }}">{{ $i }}</a></li>
                            @endif
                        @endforeach

                        {{-- Next --}}
                        @if($members->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $members->nextPageUrl() }}">Next &raquo;</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link" style="opacity:.5;">Next &raquo;</span></li>
                        @endif
                    </ul>
                </nav>
            </div>
        @endif
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
