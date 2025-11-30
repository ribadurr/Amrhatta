<header>
    <nav>
        <div class="logo-section">
            <img src="{{ asset('images/logo ambalan.png') }}" alt="Logo Pramuka" class="logo">
            <div class="brand">Gerakan Pramuka SMKN 1 Garut</div>
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('public.home') }}">Beranda</a></li>
            <li><a href="{{ route('public.events') }}">Event</a></li>
            <li><a href="{{ route('public.about') }}">Tentang</a></li>
            <li><a href="{{ route('public.members') }}">Keanggotaan</a></li>
            @auth
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            @endauth
            @guest
                <li><a href="{{ route('login') }}">Login</a></li>
            @endguest
        </ul>
    </nav>
</header>
