<header>
    <nav>
        <div class="logo-section">
            <div class="logo">🦅</div>
            <a href="{{ route('home') }}" style="text-decoration: none;">
                <span class="brand">Pramuka SMKN 1 Garut</span>
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="{{ route('events') }}" class="{{ request()->routeIs('events') ? 'active' : '' }}">Event</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Tentang</a></li>
            <li><a href="{{ route('membership') }}" class="{{ request()->routeIs('members') ? 'active' : '' }}">Keanggotaan</a></li>
        </ul>
    </nav>
</header>