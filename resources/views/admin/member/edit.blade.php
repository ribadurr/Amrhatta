@extends('layouts.admin')

@section('title', 'Edit Anggota')

@section('content')
<div class="admin-container">
    <h1 style="color: #DAA520; margin-bottom: 2rem;">👥 Edit Anggota</h1>

    <div class="form-container">
        <form action="{{ route('admin.member.update', $member) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Lengkap -->
            <div class="form-group">
                <label for="full_name">Nama Lengkap <span class="required">*</span></label>
                <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $member->full_name) }}" 
                       class="form-control @error('full_name') is-invalid @enderror"
                       placeholder="Masukkan nama lengkap">
                @error('full_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- NISN -->
            <div class="form-group">
                <label for="nisn">NISN <span class="required">*</span></label>
                <input type="text" id="nisn" name="nisn" value="{{ old('nisn', $member->nisn) }}" 
                       class="form-control @error('nisn') is-invalid @enderror"
                       placeholder="Masukkan NISN (unik)">
                @error('nisn')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Kelas -->
            <div class="form-group">
                <label for="grade_class">Kelas <span class="required">*</span></label>
                <input type="text" id="grade_class" name="grade_class" value="{{ old('grade_class', $member->grade_class) }}" 
                       class="form-control @error('grade_class') is-invalid @enderror"
                       placeholder="Contoh: XII RPL A">
                @error('grade_class')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Jabatan -->
            <div class="form-group">
                <label for="position">Jabatan <span class="required">*</span></label>
                <select id="position" name="position" 
                        class="form-control @error('position') is-invalid @enderror">
                    <option value="">-- Pilih Jabatan --</option>
                    <option value="Pradana" {{ old('position', $member->position) == 'Pradana' ? 'selected' : '' }}>Pradana</option>
                    <option value="Juru Adat" {{ old('position', $member->position) == 'Juru Adat' ? 'selected' : '' }}>Juru Adat</option>
                    <option value="Krani" {{ old('position', $member->position) == 'Krani' ? 'selected' : '' }}>Krani</option>
                    <option value="Bendahara" {{ old('position', $member->position) == 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
                    <option value="Tekpram" {{ old('position', $member->position) == 'Tekpram' ? 'selected' : '' }}>Tekpram</option>
                    <option value="Giatops" {{ old('position', $member->position) == 'Giatops' ? 'selected' : '' }}>Giatops</option>
                    <option value="Bimval" {{ old('position', $member->position) == 'Bimval' ? 'selected' : '' }}>Bimval</option>
                    <option value="Inventaris" {{ old('position', $member->position) == 'Inventaris' ? 'selected' : '' }}>Inventaris</option>
                    <option value="Kominfo" {{ old('position', $member->position) == 'Kominfo' ? 'selected' : '' }}>Kominfo</option>
                    <option value="Anggota" {{ old('position', $member->position) == 'Anggota' ? 'selected' : '' }}>Anggota</option>
                </select>
                @error('position')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tanggal Bergabung -->
            <div class="form-group">
                <label for="join_date">Tanggal Bergabung (Opsional)</label>
                <input type="date" id="join_date" name="join_date" value="{{ old('join_date', $member->join_date?->format('Y-m-d')) }}" 
                       class="form-control">
            </div>

            <div class="form-group">
                <label for="coach_id">Pembina (opsional)</label>
                <select id="coach_id" name="coach_id" class="form-control @error('coach_id') is-invalid @enderror">
                    <option value="">-- Pilih Pembina --</option>
                    @foreach($coaches as $c)
                        <option value="{{ $c->id }}" {{ old('coach_id', $member->coach_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
                @error('coach_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>

            <!-- Buttons -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    💾 Perbarui Anggota
                </button>
                <a href="{{ route('admin.member.index') }}" class="btn btn-secondary">
                    ❌ Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
