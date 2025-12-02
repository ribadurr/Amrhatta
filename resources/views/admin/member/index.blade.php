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
            <div class="pagination-wrapper" style="margin-top:1.5rem;">
                <!-- <div style="color:#ccc; margin-bottom:.5rem; text-align:center;">Showing <strong>{{ $members->firstItem() }}</strong> to <strong>{{ $members->lastItem() }}</strong> of <strong>{{ $members->total() }}</strong> results</div> -->

                <div style="display:flex; justify-content:center; gap:0.5rem; flex-wrap:wrap; margin-top:0.5rem;">
                    {{-- Previous --}}
                    @if($members->onFirstPage())
                        <span class="btn btn-secondary btn-sm" style="opacity:.6; cursor:default;">&laquo; Previous</span>
                    @else
                        <a href="{{ $members->previousPageUrl() }}" class="btn btn-secondary btn-sm">&laquo; Previous</a>
                    @endif

                    {{-- First page and ellipsis --}}
                    @php
                        $current = $members->currentPage();
                        $last = $members->lastPage();
                        $start = max(1, $current - 2);
                        $end = min($last, $current + 2);
                    @endphp

                    @if($start > 1)
                        <a href="{{ $members->url(1) }}" class="btn btn-secondary btn-sm">1</a>
                        @if($start > 2)
                            <span class="btn btn-secondary btn-sm" style="pointer-events:none; opacity:.6;">…</span>
                        @endif
                    @endif

                    {{-- Page range --}}
                    @for($i = $start; $i <= $end; $i++)
                        @if($i == $current)
                            <span class="btn btn-primary btn-sm" aria-current="page">{{ $i }}</span>
                        @else
                            <a href="{{ $members->url($i) }}" class="btn btn-secondary btn-sm">{{ $i }}</a>
                        @endif
                    @endfor

                    {{-- Last page and ellipsis --}}
                    @if($end < $last)
                        @if($end < $last - 1)
                            <span class="btn btn-secondary btn-sm" style="pointer-events:none; opacity:.6;">…</span>
                        @endif
                        <a href="{{ $members->url($last) }}" class="btn btn-secondary btn-sm">{{ $last }}</a>
                    @endif

                    {{-- Next --}}
                    @if($members->hasMorePages())
                        <a href="{{ $members->nextPageUrl() }}" class="btn btn-secondary btn-sm">Next &raquo;</a>
                    @else
                        <span class="btn btn-secondary btn-sm" style="opacity:.6; cursor:default;">Next &raquo;</span>
                    @endif
                </div>
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
