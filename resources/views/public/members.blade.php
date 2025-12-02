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

        <div id="members-container">
            @include('public.partials.members_list')
        </div>

        <script>
            (function(){
                // Delegate clicks on pagination links with class .ajax-page inside #members-container
                const container = document.getElementById('members-container');
                if (!container) return;

                container.addEventListener('click', function(e){
                    const el = e.target.closest && e.target.closest('.ajax-page');
                    if (!el) return;
                    e.preventDefault();
                    const url = el.getAttribute('href');
                    if (!url) return;

                    // show simple loading state
                    const oldOpacity = container.style.opacity;
                    container.style.opacity = '0.6';

                    fetch(url, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    }).then(function(resp){
                        if (!resp.ok) throw new Error('Network error');
                        return resp.text();
                    }).then(function(html){
                        container.innerHTML = html;
                        // update URL without reload
                        window.history.pushState({}, '', url);
                        container.style.opacity = oldOpacity || '';
                        // scroll to members section
                        container.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }).catch(function(){
                        container.style.opacity = oldOpacity || '';
                    });
                });

                // handle back/forward navigation
                window.addEventListener('popstate', function(){
                    const url = window.location.href;
                    // fetch current page into container
                    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                        .then(resp => resp.ok ? resp.text() : '')
                        .then(html => { if(html) container.innerHTML = html; })
                        .catch(()=>{});
                });
            })();
        </script>
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