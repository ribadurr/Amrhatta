@extends('layouts.app')

@section('title', 'Event & Program')

@section('content')
<!-- Hero Section -->
<section class="hero" style="padding: 5rem 2rem;">
    <h1>Event & Program</h1>
    <p>Kegiatan dan program rutin Pramuka SMKN 1 Garut</p>
</section>

<!-- Main Container -->
<div class="container">
    <section>
        <div class="event-grid">
            @foreach($events as $event)
            <div class="event-card event-card-detailed">
                @if(!empty($event->photo))
                    <div style="margin-bottom: 1rem; border-radius: 8px; overflow: hidden;">
                        <img src="{{ asset('storage/'.$event->photo) }}" alt="{{ $event->title }}" style="width: 100%; height: 200px; object-fit: cover;">
                    </div>
                @endif
                <span class="event-date">{{ $event->date }}</span>
                <h3>{{ $event->title }}</h3>
                <p>{{ $event->description }}</p>
                <div class="event-details">
                    <div class="detail-item">
                        <strong>📍 Lokasi:</strong> {{ $event->location }}
                    </div>
                    <div class="detail-item">
                        <strong>👥 Peserta:</strong> {{ $event->participants }}
                    </div>
                    <div class="detail-item">
                        <strong>⏱️ Durasi:</strong> {{ $event->duration }}
                    </div>
                </div>
            
            </div>
            @endforeach
        </div>
    </section>

    <!-- CTA Section -->
    <section style="text-align: center; margin-top: 4rem; padding: 3rem; background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%); border-radius: 15px; border: 2px solid #DAA520;">
        <h2 style="color: #DAA520; margin-bottom: 1rem;">Ingin Ikut Event?</h2>
        <p style="color: #cccccc; font-size: 1.1rem; margin-bottom: 2rem;">Daftar sebagai anggota dan ikuti semua kegiatan kami!</p>
        <a href="{{ route('public.members') }}"><button class="cta-button">Daftar Sekarang</button></a>
    </section>
</div>
@endsection