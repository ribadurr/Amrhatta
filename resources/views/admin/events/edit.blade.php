@extends('layouts.admin')

@section('title', 'Edit Event')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>Edit Event</h1>
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
            ← Kembali
        </a>
    </div>

    <div class="form-container">
        <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul Event <span class="required">*</span></label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $event->title) }}" required>
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Deskripsi <span class="required">*</span></label>
                <textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $event->description) }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="date">Tanggal <span class="required">*</span></label>
                    <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $event->date) }}" required>
                    @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="duration">Durasi <span class="required">*</span></label>
                    <input type="text" name="duration" id="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration', $event->duration) }}" required>
                    @error('duration')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="coach_id">Pembina Penanggung Jawab (opsional)</label>
                <select name="coach_id" id="coach_id" class="form-control @error('coach_id') is-invalid @enderror">
                    <option value="">-- Pilih Pembina --</option>
                    @foreach($coaches as $c)
                        <option value="{{ $c->id }}" {{ (old('coach_id', $event->coach_id) == $c->id) ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
                @error('coach_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="members">Pilih Peserta (opsional)</label>
                <select name="members[]" id="members" class="form-control @error('members') is-invalid @enderror" multiple size="6">
                    @foreach($members as $m)
                        <option value="{{ $m->id }}" {{ (in_array($m->id, old('members', $selected ?? []))) ? 'selected' : '' }}>{{ $m->full_name }} — {{ $m->nisn }}</option>
                    @endforeach
                </select>
                <small style="color:#999;">Tahan Ctrl/Cmd untuk memilih banyak.</small>
                @error('members')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            @if(!empty($event->photo))
            <div class="form-group">
                <label>Foto Saat Ini:</label>
                <div style="margin-bottom: 1rem; border-radius: 8px; overflow: hidden; max-width: 300px;">
                    <img src="{{ asset('storage/'.$event->photo) }}" alt="{{ $event->title }}" style="width: 100%; height: auto; object-fit: cover;">
                </div>
            </div>
            @endif

            <div class="form-group">
                <label for="photo">Ubah Foto Kegiatan</label>
                <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                <small style="color: #999;">Max 2MB. Kosongkan jika tidak ingin mengubah foto.</small>
                @error('photo')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="location">Lokasi <span class="required">*</span></label>
                    <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $event->location) }}" required>
                    @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="participants">Jumlah Peserta <span class="required">*</span></label>
                    <input type="text" name="participants" id="participants" class="form-control @error('participants') is-invalid @enderror" value="{{ old('participants', $event->participants) }}" required>
                    @error('participants')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Update Event</button>
                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection