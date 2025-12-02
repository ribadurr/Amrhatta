@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<!-- Hero Section -->
<section class="hero" style="padding: 5rem 2rem;">
    <h1>Tentang Kami</h1>
    <p>Mengenal lebih dekat Pramuka SMKN 1 Garut</p>
</section>

<!-- Main Container -->
<div class="container">
    <!-- History Section -->
    <section>
        <div class="about-content">
            <img src="{{ asset('images/foto ambalan.JPG') }}" alt="Foto Ambalan">
            <div class="about-text">
                <h3>Sejarah</h3>
                <p>{{ $about['history'] }}</p>
            </div>
        </div>
    </section>

    <!-- Vision Mission -->
    <section style="margin-top: 4rem;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
            <div class="info-box">
                <h3 style="color: #DAA520; margin-bottom: 1rem; font-size: 1.8rem;">🎯 Visi</h3>
                <p style="color: #cccccc; line-height: 1.8;">{{ $about['vision'] }}</p>
            </div>
            <div class="info-box">
                <h3 style="color: #DAA520; margin-bottom: 1rem; font-size: 1.8rem;">🚀 Misi</h3>
                <ul style="color: #cccccc; line-height: 2; list-style: none; padding: 0;">
                    @foreach($about['mission'] as $mission)
                    <li style="margin-bottom: 0.5rem;">✓ {{ $mission }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <!-- Achievements -->
    <section style="margin-top: 4rem;">
        <h2 class="section-title">Prestasi Kami</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
            @foreach($achievements as $achievement)
            <div style="background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%); border: 2px solid #DAA520; border-radius: 12px; padding: 2rem; position: relative; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; cursor: pointer;" 
                 onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 20px rgba(218, 165, 32, 0.3)';"
                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                
                <!-- Decorative corner -->
                <div style="position: absolute; top: -20px; right: -20px; width: 80px; height: 80px; background: rgba(218, 165, 32, 0.1); border-radius: 50%;"></div>
                
                <!-- Year badge -->
                <div style="display: inline-block; background: #DAA520; color: #000; padding: 0.5rem 1rem; border-radius: 50px; font-weight: 700; font-size: 0.9rem; margin-bottom: 1rem;">
                    {{ $achievement->year }}
                </div>
                
                <!-- Trophy icon -->
                <div style="font-size: 3rem; margin-bottom: 1rem;">🏆</div>
                
                <!-- Title -->
                <h3 style="color: #ffffff; margin: 0.5rem 0; font-size: 1.15rem; line-height: 1.4;">{{ $achievement->title }}</h3>
                
                <!-- Category tag -->
                <div style="display: inline-block; background: rgba(218, 165, 32, 0.2); color: #DAA520; padding: 0.4rem 0.9rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600; margin-top: 1rem;">
                    {{ $achievement->category }}
                </div>
                <!-- Member / Event info -->
                <div style="margin-top:0.75rem; color:#cccccc; font-size:0.95rem;">
                    <strong>Anggota:</strong><br>
                    @if($achievement->members->count() > 0)
                        @foreach($achievement->members as $member)
                            <div style="color:#DAA520; margin:0.25rem 0;">{{ $member->full_name }}</div>
                        @endforeach
                    @else
                        <div style="color:#999;">-</div>
                    @endif
                </div>
                @if($achievement->event)
                <div style="color:#999; margin-top:0.25rem; font-size:0.9rem;">Event: {{ $achievement->event->title }}</div>
                @endif
            </div>
            @endforeach
        </div>
    </section>

    <!-- Coaches -->
    <section style="margin-top: 4rem;">
        <h2 class="section-title">Pembina Kami</h2>
        <div class="coaches-grid" style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:1.25rem; margin-top:1rem;">
            @foreach($coaches as $coach)
            <div class="coach-card" style="background:#0f0f0f; border:2px solid #DAA520; border-radius:12px; padding:1.5rem; text-align:center; min-height:220px; display:flex; flex-direction:column; align-items:center; justify-content:center;">
                @if(!empty($coach->photo))
                    <div style="margin-bottom:0.6rem;">
                        <img src="{{ asset('storage/'.$coach->photo) }}" alt="{{ $coach->name }}" style="width:110px; height:110px; object-fit:cover; border-radius:9999px; border:3px solid #DAA520;">
                    </div>
                @else
                    <div class="coach-avatar" style="font-size:48px; margin-bottom:0.6rem; color:#DAA520;">👤</div>
                @endif
                <h4 style="margin:0; font-size:1.05rem; font-weight:700; color:#ffffff;">{{ $coach->name }}</h4>
                <p class="coach-position" style="color:#DAA520; font-weight:600; margin:0.35rem 0 0.75rem;">{{ $coach->position }}</p>
                @if($coach->bio)
                    <p style="color:#cccccc; font-size:0.92rem; margin:0 0 0.5rem;">{{ $coach->bio }}</p>
                @endif
                @if(!empty($coach->nip))
                    <p class="coach-experience" style="color:#999; margin:0;">NIP: {{ $coach->nip }}</p>
                @endif
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection