@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <h1>Ambalan Mohammad Hatta-Rahmi Hatta</h1>
    <p>Bina Diri, Berbudi, Bawa Bakti!</p>
</section>

<!-- Main Container -->
<div class="container">
    <!-- Events Preview -->
    <section id="events-preview">
        <h2 class="section-title">Event & Program Terkini</h2>
        <div class="event-grid">
            @foreach($events as $event)
            <div class="event-card">
                <span class="event-date">{{ $event->date }}</span>
                <h3>{{ $event->title }}</h3>
                <p>{{ $event->description }}</p>
            </div>
            @endforeach
        </div>
        <div style="text-align: center; margin-top: 2rem;">
            <a href="{{ route('public.events') }}"><button class="cta-button">Lihat Semua Event</button></a>
        </div>
    </section>

    <!-- About Preview -->
    <section id="about-preview">
        <h2 class="section-title">Tentang Kami</h2>
        <div class="about-content">
            <img src="{{ asset('images/foto ambalan.JPG') }}" alt="Foto Ambalan">
            <div class="about-text">
                <h3>Pramuka SMKN 1 Garut</h3>
                <p>Gugus Depan Pramuka SMKN 1 Garut adalah wadah pembinaan karakter dan pengembangan keterampilan kepemimpinan bagi siswa-siswi SMKN 1 Garut.</p>
                <p>Dengan pembina yang berpengalaman dan program yang terstruktur, kami telah menghasilkan banyak prestasi baik di tingkat daerah maupun nasional.</p>
                <a href="{{ route('public.about') }}"><button class="cta-button">Selengkapnya</button></a>
            </div>
        </div>
    </section>

    <!-- Membership Preview -->
    <section id="membership-preview">
        <h2 class="section-title">Keanggotaan</h2>
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
                <div class="stat-label">Usia Organisasi</div>
            </div>
        </div>
        <div style="text-align: center; margin-top: 3rem;">
            <a href="{{ route('public.members') }}"><button class="cta-button">Selengkapnya</button></a>
        </div>
    </section>
</div>
@endsection