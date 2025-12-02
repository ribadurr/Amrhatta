@extends('layouts.admin')

@section('title', 'Edit Prestasi')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>Edit Prestasi</h1>
        <a href="{{ route('admin.achievements.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <div class="form-container">
        <form action="{{ route('admin.achievements.update', $achievement) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="year">Tahun</label>
                <input type="number" name="year" id="year" class="form-control @error('year') is-invalid @enderror" value="{{ old('year', $achievement->year) }}">
                @error('year')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="title">Judul <span class="required">*</span></label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $achievement->title) }}" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="category">Kategori</label>
                <input type="text" name="category" id="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category', $achievement->category) }}">
                @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Anggota (opsional) - Pilih satu atau lebih</label>
                <div style="background:#0a0a0a; border:2px solid #333; border-radius:8px; padding:1rem; max-height:350px; overflow-y:auto;">
                    @if($members->count() > 0)
                        @foreach($members as $m)
                            <div style="margin-bottom:0.75rem; display:flex; align-items:center;">
                                <input type="checkbox" name="members[]" id="member_{{ $m->id }}" value="{{ $m->id }}" 
                                    {{ in_array($m->id, $selectedMembers ?? []) ? 'checked' : '' }}
                                    style="width:18px; height:18px; cursor:pointer; accent-color:#DAA520;">
                                <label for="member_{{ $m->id }}" style="margin-left:0.75rem; cursor:pointer; flex:1; color:#ccc;">
                                    <strong>{{ $m->full_name }}</strong>
                                    <span style="color:#999; font-size:0.9rem; margin-left:0.5rem;">({{ $m->nisn }})</span>
                                </label>
                            </div>
                        @endforeach
                    @else
                        <div style="color:#666; text-align:center; padding:1rem;">Tidak ada data anggota</div>
                    @endif
                </div>
                <small style="color:#999; margin-top:0.75rem; display:block;">Centang anggota yang mendapatkan prestasi ini</small>
            </div>

            <div class="form-group">
                <label for="event_id">Event Terkait (opsional)</label>
                <select name="event_id" id="event_id" class="form-control @error('event_id') is-invalid @enderror">
                    <option value="">-- Pilih Event --</option>
                    @foreach($events as $ev)
                        <option value="{{ $ev->id }}" {{ old('event_id', $achievement->event_id) == $ev->id ? 'selected' : '' }}>{{ $ev->title }} — {{ $ev->date }}</option>
                    @endforeach
                </select>
                @error('event_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $achievement->description) }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="image">Gambar (opsional)</label>
                @if($achievement->image)
                <div style="margin-bottom:0.5rem;"><img src="{{ asset('storage/'.$achievement->image) }}" alt="gambar" style="max-height:80px;"></div>
                @endif
                <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror">
                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Perbarui Prestasi</button>
                <a href="{{ route('admin.achievements.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
