@extends('layouts.admin')

@section('title', 'Edit Pembina')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>Edit Pembina</h1>
        <a href="{{ route('admin.coaches.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <div class="form-container">
        <form action="{{ route('admin.coaches.update', $coach) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama <span class="required">*</span></label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $coach->name) }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="position">Jabatan</label>
                <input type="text" name="position" id="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position', $coach->position) }}">
                @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="experience_years">Pengalaman (tahun)</label>
                <input type="number" name="experience_years" id="experience_years" class="form-control @error('experience_years') is-invalid @enderror" value="{{ old('experience_years', $coach->experience_years) }}">
                @error('experience_years')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea name="bio" id="bio" rows="4" class="form-control @error('bio') is-invalid @enderror">{{ old('bio', $coach->bio) }}</textarea>
                @error('bio')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="photo">Foto (opsional)</label>
                @if($coach->photo)
                <div style="margin-bottom:0.5rem;"><img src="{{ asset('storage/'.$coach->photo) }}" alt="foto" style="max-height:80px;"></div>
                @endif
                <input type="file" name="photo" id="photo" class="form-control-file @error('photo') is-invalid @enderror">
                @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Perbarui Pembina</button>
                <a href="{{ route('admin.coaches.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
