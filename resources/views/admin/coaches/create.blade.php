@extends('layouts.admin')

@section('title', 'Tambah Pembina')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>Tambah Pembina Baru</h1>
        <a href="{{ route('admin.coaches.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <div class="form-container">
        <form action="{{ route('admin.coaches.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Nama <span class="required">*</span></label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="position">Jabatan</label>
                <input type="text" name="position" id="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position') }}">
                @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="nip">NIP (Nomor Induk Pegawai)</label>
                <input type="number" name="nip" id="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}">
                @error('nip')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea name="bio" id="bio" rows="4" class="form-control @error('bio') is-invalid @enderror">{{ old('bio') }}</textarea>
                @error('bio')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="photo">Foto (opsional)</label>
                <input type="file" name="photo" id="photo" class="form-control-file @error('photo') is-invalid @enderror">
                @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Simpan Pembina</button>
                <a href="{{ route('admin.coaches.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
