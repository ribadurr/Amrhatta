<footer>
    <div class="footer-content">
        <div class="footer-section">
            <h3>Pramuka SMKN 1 Garut</h3>
            <p>Membentuk Karakter, Membangun Prestasi</p>
            <p style="margin-top: 1rem;">Satyaku Kudarmakan, Darmaku Kubaktikan</p>
        </div>
        
        <div class="footer-section">
            <h4>Menu</h4>
            <ul class="footer-links">
                <li><a href="{{ route('public.home') }}">Beranda</a></li>
                <li><a href="{{ route('public.events') }}">Event</a></li>
                <li><a href="{{ route('public.about') }}">Tentang</a></li>
                <li><a href="{{ route('public.members') }}">Keanggotaan</a></li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h4>Kontak</h4>
            <ul class="footer-contact">
                <li>📍 SMKN 1 Garut, Jawa Barat</li>
                <li>📞 (0262) 123456</li>
                <li>✉️ pramuka@smkn1garut.sch.id</li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h4>Ikuti Kami</h4>
            <div class="social-links">
                <a href="#" class="social-icon">📘</a>
                <a href="#" class="social-icon">📷</a>
                <a href="#" class="social-icon">🐦</a>
                <a href="#" class="social-icon">▶️</a>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} Pramuka SMKN 1 Garut. All Rights Reserved.</p>
    </div>
</footer>