/**
 * Advanced Interactive Effects & Animations
 * Adds dynamic interactions for better UX
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // ==========================================
    // 1. RIPPLE EFFECT ON BUTTONS
    // ==========================================
    function createRipple(event) {
        const button = event.currentTarget;
        const ripple = document.createElement('span');
        
        const rect = button.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = event.clientX - rect.left - size / 2;
        const y = event.clientY - rect.top - size / 2;
        
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.classList.add('ripple');
        
        // Remove existing ripple
        const existingRipple = button.querySelector('.ripple');
        if (existingRipple) existingRipple.remove();
        
        button.appendChild(ripple);
    }
    
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('mousedown', createRipple);
    });
    
    // ==========================================
    // 2. SMOOTH SCROLL TO ANCHOR
    // ==========================================
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // ==========================================
    // 3. LAZY LOADING IMAGES
    // ==========================================
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.style.animation = 'fadeIn 0.5s ease-out';
                observer.unobserve(img);
            }
        });
    }, {
        threshold: 0.1
    });
    
    document.querySelectorAll('img').forEach(img => {
        imageObserver.observe(img);
    });
    
    // ==========================================
    // 4. ANIMATE ON SCROLL (ELEMENTS)
    // ==========================================
    const elementObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
                // Optional: unobserve after animation
                // elementObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.2
    });
    
    // Observe cards and sections
    document.querySelectorAll('.event-card, .member-card, .stat-card, .level-card, .benefit-item').forEach(el => {
        elementObserver.observe(el);
    });
    
    // ==========================================
    // 5. FORM VALIDATION WITH ANIMATION
    // ==========================================
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('is-invalid');
                    // Shake animation
                    input.style.animation = 'shake 0.5s';
                    setTimeout(() => {
                        input.style.animation = '';
                    }, 500);
                } else {
                    input.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    });
    
    // Remove error class on input
    document.querySelectorAll('input, textarea, select').forEach(input => {
        input.addEventListener('change', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
            }
        });
    });
    
    // ==========================================
    // 6. NAVBAR ACTIVE STATE
    // ==========================================
    const navLinks = document.querySelectorAll('.nav-links a, .sidebar-nav a');
    navLinks.forEach(link => {
        // Check if link is current page
        if (window.location.href.includes(link.href)) {
            link.classList.add('active');
        }
    });
    
    // ==========================================
    // 7. TOOLTIPS
    // ==========================================
    function initTooltips() {
        document.querySelectorAll('[data-tooltip]').forEach(el => {
            el.addEventListener('mouseenter', function() {
                // Tooltip already in CSS with ::after pseudo-element
            });
        });
    }
    initTooltips();
    
    // ==========================================
    // 8. COUNTER ANIMATION (FOR STATS)
    // ==========================================
    function animateCounter(element, target, duration = 2000) {
        let current = 0;
        const increment = target / (duration / 16);
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current);
        }, 16);
    }
    
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.dataset.animated) {
                entry.target.dataset.animated = true;
                const number = parseInt(entry.target.textContent);
                if (!isNaN(number)) {
                    animateCounter(entry.target, number);
                }
            }
        });
    }, { threshold: 0.5 });
    
    document.querySelectorAll('.stat-number').forEach(el => {
        statsObserver.observe(el);
    });
    
    // ==========================================
    // 9. MOBILE MENU TOGGLE
    // ==========================================
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('#nav-menu');
    
    if (hamburger && navMenu) {
        hamburger.addEventListener('click', function(e) {
            e.stopPropagation();
            navMenu.classList.toggle('active');
            hamburger.classList.toggle('active');
        });
    }
    
    // Close menu when link is clicked
    if (navMenu) {
        document.querySelectorAll('#nav-menu a').forEach(link => {
            link.addEventListener('click', function() {
                navMenu.classList.remove('active');
                hamburger?.classList.remove('active');
            });
        });
    }
    
    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        if (hamburger && navMenu && !e.target.closest('nav')) {
            navMenu.classList.remove('active');
            hamburger.classList.remove('active');
        }
    });
    
    // ==========================================
    // 10. DARK MODE TOGGLE
    // ==========================================
    const darkModeToggle = document.querySelector('.dark-mode-toggle');
    if (darkModeToggle) {
        // Check saved preference
        const isDark = localStorage.getItem('darkMode') === 'true';
        if (isDark) {
            document.body.classList.add('dark-mode');
            darkModeToggle.textContent = '☀️';
        }
        
        darkModeToggle.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            const isDarkMode = document.body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', isDarkMode);
            this.textContent = isDarkMode ? '☀️' : '🌙';
        });
    }
    
    // ==========================================
    // 11. SEARCH/FILTER ANIMATION
    // ==========================================
    const searchInputs = document.querySelectorAll('input[type="search"], input[placeholder*="search" i]');
    searchInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.transform = 'scale(1.02)';
            this.style.boxShadow = '0 0 20px rgba(218, 165, 32, 0.5)';
        });
        
        input.addEventListener('blur', function() {
            this.style.transform = 'scale(1)';
            this.style.boxShadow = '';
        });
    });
    
    // ==========================================
    // 12. TABLE ROW HOVER EFFECT
    // ==========================================
    const tableRows = document.querySelectorAll('.admin-table tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = 'rgba(218, 165, 32, 0.1)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
        });
    });
    
    // ==========================================
    // 13. FORM SUCCESS/ERROR ANIMATION
    // ==========================================
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            if (alert.classList.contains('alert-success')) {
                alert.style.animation = 'slideInDown 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
                
                // Auto dismiss after 5 seconds
                setTimeout(() => {
                    alert.style.animation = 'slideUp 0.3s ease-out forwards';
                    setTimeout(() => alert.remove(), 300);
                }, 5000);
            }
        }, 100);
    });
    
    // ==========================================
    // 14. PARALLAX EFFECT
    // ==========================================
    const parallaxElements = document.querySelectorAll('[data-parallax]');
    if (parallaxElements.length > 0) {
        window.addEventListener('scroll', () => {
            parallaxElements.forEach(el => {
                const scrollPosition = window.pageYOffset;
                const elementOffset = el.offsetTop;
                const distance = scrollPosition - elementOffset;
                el.style.transform = `translateY(${distance * 0.5}px)`;
            });
        });
    }
    
    // ==========================================
    // 15. PAGE TRANSITION
    // ==========================================
    function addPageTransition() {
        // Fade in on page load
        document.body.style.animation = 'fadeIn 0.5s ease-out';
        
        // Fade out on navigation
        document.querySelectorAll('a:not([target="_blank"]):not([href^="#"])').forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.href && !this.href.includes('javascript:')) {
                    // e.preventDefault();
                    // document.body.style.animation = 'fadeOut 0.3s ease-out';
                    // setTimeout(() => {
                    //     window.location = this.href;
                    // }, 300);
                }
            });
        });
    }
    addPageTransition();
    
    // ==========================================
    // 16. INTERSECTION OBSERVER FOR ANIMATIONS
    // ==========================================
    const sections = document.querySelectorAll('section, .container');
    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1
    });
    
    sections.forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(20px)';
        section.style.transition = 'all 0.6s ease-out';
        sectionObserver.observe(section);
    });
    
    // ==========================================
    // 17. LOADING STATE
    // ==========================================
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<span class="spinner"></span> Memproses...';
                submitBtn.disabled = true;
            }
        });
    });
    
    // ==========================================
    // 18. CUSTOM SELECT STYLING
    // ==========================================
    document.querySelectorAll('select.form-control').forEach(select => {
        select.addEventListener('change', function() {
            this.style.color = this.value ? '#fff' : '#999';
        });
    });
    
    // ==========================================
    // 19. IMAGE GALLERY LIGHTBOX
    // ==========================================
    document.querySelectorAll('img[data-lightbox]').forEach(img => {
        img.style.cursor = 'pointer';
        img.addEventListener('click', function() {
            const modal = document.createElement('div');
            modal.className = 'lightbox-modal';
            modal.innerHTML = `
                <div class="lightbox-content">
                    <img src="${this.src}" alt="${this.alt}">
                    <button class="lightbox-close">&times;</button>
                </div>
            `;
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.9);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 9999;
                animation: fadeIn 0.3s ease-out;
            `;
            
            modal.querySelector('.lightbox-content').style.cssText = `
                position: relative;
                max-width: 90vw;
                max-height: 90vh;
            `;
            
            modal.querySelector('img').style.cssText = `
                max-width: 100%;
                max-height: 100%;
                border-radius: 10px;
                box-shadow: 0 0 30px rgba(218, 165, 32, 0.5);
            `;
            
            const closeBtn = modal.querySelector('.lightbox-close');
            closeBtn.style.cssText = `
                position: absolute;
                top: -40px;
                right: 0;
                background: none;
                border: none;
                color: #DAA520;
                font-size: 40px;
                cursor: pointer;
                transition: all 0.3s;
            `;
            
            closeBtn.addEventListener('mouseover', function() {
                this.style.transform = 'scale(1.2)';
            });
            
            closeBtn.addEventListener('mouseout', function() {
                this.style.transform = 'scale(1)';
            });
            
            closeBtn.addEventListener('click', function() {
                modal.style.animation = 'fadeOut 0.3s ease-out';
                setTimeout(() => modal.remove(), 300);
            });
            
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.style.animation = 'fadeOut 0.3s ease-out';
                    setTimeout(() => this.remove(), 300);
                }
            });
            
            document.body.appendChild(modal);
        });
    });
    
    // ==========================================
    // 20. NOTIFICATION/TOAST SYSTEM
    // ==========================================
    window.showNotification = function(message, type = 'info', duration = 3000) {
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.innerHTML = message;
        toast.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            z-index: 10000;
            animation: slideInRight 0.4s ease-out;
            background: ${type === 'success' ? '#4CAF50' : type === 'error' ? '#f44336' : '#2196F3'};
        `;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.animation = 'slideOutRight 0.3s ease-out';
            setTimeout(() => toast.remove(), 300);
        }, duration);
    };
    
    // ==========================================
    // 21. SMOOTH PAGE RELOAD
    // ==========================================
    document.querySelectorAll('form button[type="submit"]').forEach(btn => {
        btn.addEventListener('click', function() {
            // Optional: show loading animation
        });
    });
    
    // ==========================================
    // 22. KEYBOARD SHORTCUTS
    // ==========================================
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + K untuk search (jika ada)
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            const searchBox = document.querySelector('input[type="search"]');
            if (searchBox) searchBox.focus();
        }
        
        // Escape untuk close modal
        if (e.key === 'Escape') {
            const modal = document.querySelector('.lightbox-modal');
            if (modal) modal.click();
        }
    });
    
    console.log('🎨 Advanced animations & interactions loaded!');
});

// Add fade out animation keyframe
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
    @keyframes slideOutRight {
        to {
            opacity: 0;
            transform: translateX(100px);
        }
    }
    @keyframes slideUp {
        to {
            opacity: 0;
            transform: translateY(-20px);
        }
    }
`;
document.head.appendChild(style);
