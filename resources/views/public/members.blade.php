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

    <!-- Daftar Anggota (Card Grid) -->
    <section style="margin-top: 4rem;">
        <h2 class="section-title">Anggota Kami</h2>

        @if($members->count() > 0)
            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:1.25rem; margin-top:1rem;">
                @foreach($members as $member)
                    <div style="background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%); border: 2px solid #333; border-radius: 12px; padding:1.25rem; transition: transform 0.2s ease, box-shadow 0.2s ease;">
                        <div style="display:flex; align-items:center; gap:1rem;">
                            <div style="width:64px; height:64px; background:#0b0b0b; border-radius:9999px; display:flex; align-items:center; justify-content:center; font-size:28px; color:#DAA520;">
                                👤
                            </div>
                            <div style="flex:1;">
                                <h4 style="margin:0; color:#fff; font-size:1rem;">{{ $member->full_name }}</h4>
                                <div style="color:#999; font-size:0.9rem;">{{ $member->grade_class ?? '-' }}</div>
                                <div style="margin-top:0.4rem;"><span class="badge badge-info">{{ $member->position ?? '-' }}</span></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination for public members (styled) --}}
            @if($members->hasPages())
                <div style="margin-top:1.5rem; text-align:center;">
                    <div style="color:#999; margin-bottom:.5rem;">Showing <strong>{{ $members->firstItem() }}</strong> to <strong>{{ $members->lastItem() }}</strong> of <strong>{{ $members->total() }}</strong> anggota</div>
                    <div style="display:flex; justify-content:center; gap:.5rem; flex-wrap:wrap;">
                        @if($members->onFirstPage())
                            <span class="btn btn-secondary btn-sm" style="opacity:.6; cursor:default;">&laquo; Prev</span>
                        @else
                            <a href="{{ $members->previousPageUrl() }}" class="btn btn-secondary btn-sm">&laquo; Prev</a>
                        @endif

                        @php
                            $cur = $members->currentPage();
                            $last = $members->lastPage();
                            $start = max(1, $cur - 1);
                            $end = min($last, $cur + 1);
                        @endphp

                        @if($start > 1)
                            <a href="{{ $members->url(1) }}" class="btn btn-secondary btn-sm">1</a>
                            @if($start > 2)
                                <span class="btn btn-secondary btn-sm" style="pointer-events:none; opacity:.6;">…</span>
                            @endif
                        @endif

                        @for($i = $start; $i <= $end; $i++)
                            @if($i == $cur)
                                <span class="btn btn-primary btn-sm">{{ $i }}</span>
                            @else
                                <a href="{{ $members->url($i) }}" class="btn btn-secondary btn-sm">{{ $i }}</a>
                            @endif
                        @endfor

                        @if($end < $last)
                            @if($end < $last - 1)
                                <span class="btn btn-secondary btn-sm" style="pointer-events:none; opacity:.6;">…</span>
                            @endif
                            <a href="{{ $members->url($last) }}" class="btn btn-secondary btn-sm">{{ $last }}</a>
                        @endif

                        @if($members->hasMorePages())
                            <a href="{{ $members->nextPageUrl() }}" class="btn btn-secondary btn-sm">Next &raquo;</a>
                        @else
                            <span class="btn btn-secondary btn-sm" style="opacity:.6; cursor:default;">Next &raquo;</span>
                        @endif
                    </div>
                </div>
            @endif
        @else
            <div style="padding:2rem; text-align:center; color:#666;">Belum ada data anggota</div>
        @endif
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