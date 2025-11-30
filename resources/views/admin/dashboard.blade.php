@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="admin-container">
    <!-- Header -->
    <div class="admin-header">
        <div>
            <h1>📊 Dashboard Admin</h1>
            <p style="color: #999; font-size: 0.95rem; margin-top: 0.5rem;">Selamat datang, {{ auth()->user()->name }}!</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <section style="margin-bottom: 3rem;">
        <h2 class="section-title" style="color: #DAA520; font-size: 1.5rem; margin-bottom: 1.5rem; border-bottom: 2px solid #333; padding-bottom: 1rem;">Statistik Ringkas</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            <!-- Total Members -->
            <div style="background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%); border: 2px solid #DAA520; border-radius: 12px; padding: 2rem; text-align: center; transition: all 0.3s;">
                <div style="font-size: 2.5rem; color: #DAA520; font-weight: bold; margin-bottom: 0.5rem;">{{ $stats['members'] }}</div>
                <div style="color: #cccccc; font-size: 1rem; margin-bottom: 1rem;">👥 Anggota Aktif</div>
                <a href="{{ route('admin.member.index') }}" style="color: #DAA520; text-decoration: none; font-size: 0.9rem;">Kelola Anggota →</a>
            </div>

            <!-- Total Coaches -->
            <div style="background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%); border: 2px solid #DAA520; border-radius: 12px; padding: 2rem; text-align: center; transition: all 0.3s;">
                <div style="font-size: 2.5rem; color: #DAA520; font-weight: bold; margin-bottom: 0.5rem;">{{ $stats['coaches'] }}</div>
                <div style="color: #cccccc; font-size: 1rem; margin-bottom: 1rem;">👨‍🏫 Pembina</div>
                <a href="{{ route('admin.coaches.index') }}" style="color: #DAA520; text-decoration: none; font-size: 0.9rem;">Kelola Pembina →</a>
            </div>

            <!-- Total Achievements -->
            <div style="background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%); border: 2px solid #DAA520; border-radius: 12px; padding: 2rem; text-align: center; transition: all 0.3s;">
                <div style="font-size: 2.5rem; color: #DAA520; font-weight: bold; margin-bottom: 0.5rem;">{{ $stats['achievements'] }}</div>
                <div style="color: #cccccc; font-size: 1rem; margin-bottom: 1rem;">🏆 Prestasi</div>
                <a href="{{ route('admin.achievements.index') }}" style="color: #DAA520; text-decoration: none; font-size: 0.9rem;">Kelola Prestasi →</a>
            </div>

            <!-- Total Events -->
            <div style="background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%); border: 2px solid #DAA520; border-radius: 12px; padding: 2rem; text-align: center; transition: all 0.3s;">
                <div style="font-size: 2.5rem; color: #DAA520; font-weight: bold; margin-bottom: 0.5rem;">{{ $stats['events'] }}</div>
                <div style="color: #cccccc; font-size: 1rem; margin-bottom: 1rem;">📅 Event</div>
                <a href="{{ route('admin.events.index') }}" style="color: #DAA520; text-decoration: none; font-size: 0.9rem;">Kelola Event →</a>
            </div>
        </div>
    </section>

    <!-- Quick Access -->
    <section style="margin-bottom: 3rem;">
        <h2 class="section-title" style="color: #DAA520; font-size: 1.5rem; margin-bottom: 1.5rem; border-bottom: 2px solid #333; padding-bottom: 1rem;">Akses Cepat</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
            <a href="{{ route('admin.member.create') }}" class="btn btn-primary" style="text-align: center; text-decoration: none; display: block; padding: 1rem;">➕ Tambah Anggota</a>
            <a href="{{ route('admin.coaches.create') }}" class="btn btn-primary" style="text-align: center; text-decoration: none; display: block; padding: 1rem;">➕ Tambah Pembina</a>
            <a href="{{ route('admin.events.create') }}" class="btn btn-primary" style="text-align: center; text-decoration: none; display: block; padding: 1rem;">➕ Tambah Event</a>
            <a href="{{ route('admin.achievements.create') }}" class="btn btn-primary" style="text-align: center; text-decoration: none; display: block; padding: 1rem;">➕ Tambah Prestasi</a>
        </div>
    </section>

    <!-- Recent Activities / Info -->
    <section>
        <h2 class="section-title" style="color: #DAA520; font-size: 1.5rem; margin-bottom: 1.5rem; border-bottom: 2px solid #333; padding-bottom: 1rem;">Informasi Berguna</h2>
        <div style="background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%); border: 2px solid #DAA520; border-radius: 12px; padding: 2rem;">
            <div style="margin-bottom: 1.5rem;">
                <h3 style="color: #DAA520; margin-bottom: 0.5rem;">📝 Tips Penggunaan</h3>
                <ul style="color: #cccccc; line-height: 1.8; padding-left: 1.5rem;">
                    <li>Pastikan upload foto dengan ukuran maksimal 2MB</li>
                    <li>Semua data akan ditampilkan di halaman publik secara otomatis</li>
                    <li>Gunakan deskripsi yang jelas dan menarik untuk event dan prestasi</li>
                    <li>Perbarui data anggota secara berkala untuk akurasi informasi</li>
                </ul>
            </div>
            <div>
                <h3 style="color: #DAA520; margin-bottom: 0.5rem;">🔧 Menu Manajemen</h3>
                <p style="color: #cccccc;">Semua menu manajemen tersedia di sidebar kiri. Klik ikon atau nama menu untuk mengakses CRUD data.</p>
            </div>
        </div>
    </section>
</div>

<style>
    .section-title {
        font-size: 1.5rem;
        color: #DAA520;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #333;
    }
</style>
@endsection
