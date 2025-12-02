<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Pramuka SMKN 1 Garut</title>
    @vite(['resources/css/admin.css'])
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('images/logo ambalan.png') }}" alt="Logo Pramuka" class="logo">
            <h3>Admin Panel</h3>
            <p style="color: #999; font-size: 0.9rem; margin-top: 0.5rem;">Pramuka SMKN 1 Garut</p>
        </div>
        
        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                📊 Dashboard
            </a>
            
            <div class="nav-divider">
                <span>MANAJEMEN DATA</span>
            </div>
            
            <a href="{{ route('admin.events.index') }}" class="{{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                📅 Events
            </a>
            <a href="{{ route('admin.achievements.index') }}" class="{{ request()->routeIs('admin.achievements.*') ? 'active' : '' }}">
                🏆 Prestasi
            </a>
            <a href="{{ route('admin.coaches.index') }}" class="{{ request()->routeIs('admin.coaches.*') ? 'active' : '' }}">
                👨‍🏫 Pembina
            </a>
            <a href="{{ route('admin.member.index') }}" class="{{ request()->routeIs('admin.member.*') ? 'active' : '' }}">
                👤 Anggota
            </a>
            
            <div class="sidebar-divider"></div>
            
            <a href="{{ route('public.home') }}" target="_blank" class="nav-external">
                🌐 Lihat Website
            </a>
            
            <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
                ⚙️ Pengaturan Profil
            </a>
            
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="logout-btn">
                    🚪 Logout
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="topbar">
            <div class="topbar-left">
                <h2>@yield('title')</h2>
            </div>
            <div class="topbar-right">
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <span class="user-role">Administrator</span>
                </div>
            </div>
        </div>

        <div class="content-wrapper">
            @yield('content')
        </div>

        <footer class="admin-footer">
            <p>&copy; {{ date('Y') }} Pramuka SMKN 1 Garut. All Rights Reserved.</p>
        </footer>
    </div>
</body>
</html>