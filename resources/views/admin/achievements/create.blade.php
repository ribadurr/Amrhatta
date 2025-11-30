@extends('layouts.admin')

@section('title', 'Tambah Prestasi')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>Tambah Prestasi Baru</h1>
        <a href="{{ route('admin.achievements.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <div class="form-container">
        <form action="{{ route('admin.achievements.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="year">Tahun</label>
                <input type="number" name="year" id="year" class="form-control @error('year') is-invalid @enderror" value="{{ old('year') }}">
                @error('year')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="title">Judul <span class="required">*</span></label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="category">Kategori</label>
                <input type="text" name="category" id="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category') }}">
                @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="image">Gambar (opsional)</label>
                <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror">
                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Simpan Prestasi</button>
                <a href="{{ route('admin.achievements.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
