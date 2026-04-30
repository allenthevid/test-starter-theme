document.addEventListener('DOMContentLoaded', function () {

    // -------------------------------------------------------------------------
    // Mobile Menu Toggle
    // -------------------------------------------------------------------------
    const hamburgerBtn = document.getElementById('hamburgerMenuBtn');
    const mobileMenu   = document.getElementById('mobileMenu');
    const siteHeader   = document.querySelector('.site-header');

    if (hamburgerBtn && mobileMenu && siteHeader) {

        function updateMenuPosition() {
            const headerHeight   = siteHeader.offsetHeight;
            const adminBar       = document.getElementById('wpadminbar');
            const adminBarHeight = adminBar ? adminBar.offsetHeight : 0;
            const banner         = document.getElementById('siteBanner');
            const bannerHeight   = (banner && banner.style.display !== 'none') ? banner.offsetHeight : 0;
            mobileMenu.style.top = (headerHeight + adminBarHeight + bannerHeight) + 'px';
        }

        updateMenuPosition();
        window.addEventListener('resize', updateMenuPosition);

        hamburgerBtn.addEventListener('click', function () {
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('show');
            hamburgerBtn.classList.toggle('active');
            hamburgerBtn.setAttribute('aria-expanded', mobileMenu.classList.contains('show'));
        });

        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function () {
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('show');
                hamburgerBtn.classList.remove('active');
                hamburgerBtn.setAttribute('aria-expanded', 'false');
            });
        });

        document.addEventListener('click', function (event) {
            if (!event.target.closest('.site-header') && mobileMenu.classList.contains('show')) {
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('show');
                hamburgerBtn.classList.remove('active');
                hamburgerBtn.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // -------------------------------------------------------------------------
    // Site Banner Dismiss
    // -------------------------------------------------------------------------
    const banner        = document.getElementById('siteBanner');
    const closeBannerBtn = document.getElementById('closeBanner');

    if (banner && closeBannerBtn) {
        if (sessionStorage.getItem('bannerClosed')) {
            banner.style.display = 'none';
        }

        closeBannerBtn.addEventListener('click', function () {
            banner.style.display = 'none';
            sessionStorage.setItem('bannerClosed', 'true');
        });
    }

    // -------------------------------------------------------------------------
    // Stat Counters — animate on scroll into view
    // -------------------------------------------------------------------------
    const counters = document.querySelectorAll('.stat-counter');

    if (counters.length) {
        const animateCounter = (el) => {
            const target    = parseInt(el.dataset.target, 10);
            const suffix    = el.dataset.suffix || '';
            const steps     = 60;
            const stepTime  = 2000 / steps;
            const increment = Math.ceil(target / steps);
            let current     = 0;

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
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        counters.forEach(counter => observer.observe(counter));
    }

});
