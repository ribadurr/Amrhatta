@extends('layouts.admin')

@section('title', 'Tambah Anggota')

@section('content')
<div class="admin-container">
    <h1 style="color: #DAA520; margin-bottom: 2rem;">👥 Tambah Anggota Baru</h1>

    <div class="form-container">
        <form action="{{ route('admin.member.store') }}" method="POST">
            @csrf

            <!-- Nama Lengkap -->
            <div class="form-group">
                <label for="full_name">Nama Lengkap <span class="required">*</span></label>
                <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" 
                       class="form-control @error('full_name') is-invalid @enderror"
                       placeholder="Masukkan nama lengkap">
                @error('full_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- NISN -->
            <div class="form-group">
                <label for="nisn">NISN <span class="required">*</span></label>
                <input type="text" id="nisn" name="nisn" value="{{ old('nisn') }}" 
                       class="form-control @error('nisn') is-invalid @enderror"
                       placeholder="Masukkan NISN (unik)">
                @error('nisn')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Kelas -->
            <div class="form-group">
                <label for="grade_class">Kelas <span class="required">*</span></label>
                <input type="text" id="grade_class" name="grade_class" value="{{ old('grade_class') }}" 
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
                    <option value="Pradana" {{ old('position') == 'Pradana' ? 'selected' : '' }}>Pradana</option>
                    <option value="Juru Adat" {{ old('position') == 'Juru Adat' ? 'selected' : '' }}>Juru Adat</option>
                    <option value="Krani" {{ old('position') == 'Krani' ? 'selected' : '' }}>Krani</option>
                    <option value="Bendahara" {{ old('position') == 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
                    <option value="Tekpram" {{ old('position') == 'Tekpram' ? 'selected' : '' }}>Tekpram</option>
                    <option value="Giatops" {{ old('position') == 'Giatops' ? 'selected' : '' }}>Giatops</option>
                    <option value="Bimval" {{ old('position') == 'Bimval' ? 'selected' : '' }}>Bimval</option>
                    <option value="Inventaris" {{ old('position') == 'Inventaris' ? 'selected' : '' }}>Inventaris</option>
                    <option value="Kominfo" {{ old('position') == 'Kominfo' ? 'selected' : '' }}>Kominfo</option>
                    <option value="Anggota" {{ old('position') == 'Anggota' ? 'selected' : '' }}>Anggota</option>
                </select>
                @error('position')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tanggal Bergabung -->
            <div class="form-group">
                <label for="join_date">Tanggal Bergabung (Opsional)</label>
                <input type="date" id="join_date" name="join_date" value="{{ old('join_date') }}" 
                       class="form-control">
            </div>

            <div class="form-group">
                <label for="coach_id">Pembina (opsional)</label>
                <select id="coach_id" name="coach_id" class="form-control @error('coach_id') is-invalid @enderror">
                    <option value="">-- Pilih Pembina --</option>
                    @foreach($coaches as $c)
                        <option value="{{ $c->id }}" {{ old('coach_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
                @error('coach_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>

            <!-- Buttons -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    💾 Simpan Anggota
                </button>
                <a href="{{ route('admin.member.index') }}" class="btn btn-secondary">
                    ❌ Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
