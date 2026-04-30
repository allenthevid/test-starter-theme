// Hamburger Menu Toggle
document.addEventListener('DOMContentLoaded', function() {
    const hamburgerBtn = document.getElementById('hamburgerMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const siteHeader = document.querySelector('.site-header');

    if (hamburgerBtn && mobileMenu && siteHeader) {
        // Set mobile menu top position based on header height
        function updateMenuPosition() {
            const headerHeight = siteHeader.offsetHeight;
            const adminBar = document.getElementById('wpadminbar');
            const adminBarHeight = adminBar ? adminBar.offsetHeight : 0;
            const banner = document.getElementById('siteBanner');
            const bannerHeight = (banner && banner.style.display !== 'none') ? banner.offsetHeight : 0;
            mobileMenu.style.top = (headerHeight + adminBarHeight + bannerHeight) + 'px';
        }

        // Initial position
        updateMenuPosition();

        // Update on window resize
        window.addEventListener('resize', updateMenuPosition);

        // Toggle menu on hamburger click
        hamburgerBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('show');
            hamburgerBtn.classList.toggle('active');
            hamburgerBtn.setAttribute('aria-expanded', mobileMenu.classList.contains('show'));
        });

        // Close menu when a link is clicked
        const menuLinks = mobileMenu.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('show');
                hamburgerBtn.classList.remove('active');
                hamburgerBtn.setAttribute('aria-expanded', 'false');
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.site-header')) {
                if (mobileMenu.classList.contains('show')) {
                    mobileMenu.classList.add('hidden');
                    mobileMenu.classList.remove('show');
                    hamburgerBtn.classList.remove('active');
                    hamburgerBtn.setAttribute('aria-expanded', 'false');
                }
            }
        });
    }


    // Banner
    const banner = document.getElementById('siteBanner');
    const closeBannerBtn = document.getElementById('closeBanner');

    if (banner && closeBannerBtn) {
        // Check if user already closed it
        if (sessionStorage.getItem('bannerClosed')) {
            banner.style.display = 'none';
        }

        closeBannerBtn.addEventListener('click', function () {
            banner.style.display = 'none';
            sessionStorage.setItem('bannerClosed', 'true');
        });

        // Also account for banner height in mobile menu position
        function getBannerHeight() {
            return banner && banner.style.display !== 'none' ? banner.offsetHeight : 0;
        }
    }

    const counters = document.querySelectorAll('.stat-counter');

    if (!counters.length) return;

    const animateCounter = (el) => {
        const target = parseInt(el.dataset.target, 10);
        const suffix = el.dataset.suffix || '';
        const duration = 2000; // ms
        const steps = 60;
        const stepTime = duration / steps;
        let current = 0;

        const increment = Math.ceil(target / steps);

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            el.textContent = current + suffix;
        }, stepTime);
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target); // only animate once
            }
        });
    }, { threshold: 0.3 });

    counters.forEach(counter => observer.observe(counter));
});