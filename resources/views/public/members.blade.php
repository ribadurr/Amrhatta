@extends('layouts.app')

@section('title', 'Keanggotaan')

@section('content')
<!-- Hero Section -->
<section class="hero" style="padding: 5rem 2rem;">
    <h1>Keanggotaan</h1>
    <p>Bergabunglah bersama kami dan kembangkan potensi diri</p>
</section>

<!-- Main Container -->
<div class="container">
    <!-- Stats -->
    <section>
        <div class="membership-stats">
            <div class="stat-card">
                <div class="stat-number">{{ $stats['members'] }}+</div>
                <div class="stat-label">Anggota Aktif</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['coaches'] }}+</div>
                <div class="stat-label">Pembina</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['achievements'] }}+</div>
                <div class="stat-label">Prestasi Diraih</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['years'] }}+</div>
                <div class="stat-label">Tahun Berdiri</div>
            </div>
        </div>
    </section>

    <!-- Daftar Anggota -->
    <section style="margin-top: 4rem;">
        <h2 class="section-title">Data Anggota</h2>
        <div style="background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%); border: 2px solid #DAA520; border-radius: 15px; overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: rgba(218, 165, 32, 0.2);">
                        <th style="padding: 1rem; text-align: left; color: #DAA520; font-weight: 600; border-bottom: 2px solid #DAA520;">No</th>
                        <th style="padding: 1rem; text-align: left; color: #DAA520; font-weight: 600; border-bottom: 2px solid #DAA520;">Nama</th>
                        <th style="padding: 1rem; text-align: left; color: #DAA520; font-weight: 600; border-bottom: 2px solid #DAA520;">Kelas</th>
                        <th style="padding: 1rem; text-align: left; color: #DAA520; font-weight: 600; border-bottom: 2px solid #DAA520;">Jabatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $key => $member)
                    <tr style="border-bottom: 1px solid #333; transition: all 0.3s;">
                        <td style="padding: 1rem; color: #cccccc;">{{ $key + 1 }}</td>
                        <td style="padding: 1rem; color: #cccccc;">{{ $member->full_name ?? 'N/A' }}</td>
                        <td style="padding: 1rem; color: #cccccc;">{{ $member->grade_class ?? 'N/A' }}</td>
                        <td style="padding: 1rem; color: #cccccc;">{{ $member->position ?? 'N/A' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="padding: 2rem; text-align: center; color: #666;">Belum ada data anggota</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <!-- CTA -->
    <section style="text-align: center; margin-top: 4rem; padding: 3rem; background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%); border-radius: 15px; border: 2px solid #DAA520;">
        <p style="color: #cccccc; font-size: 1.1rem; margin-bottom: 2rem;">Hubungi kami melalui Instagram untuk informasi lebih lanjut</p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="https://www.instagram.com/pramuka_amrhatta1?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer" style="text-decoration: none;">
                <button class="cta-button">📞 Hubungi Kami</button>
            </a>
        </div>
    </section>
</div>
@endsection