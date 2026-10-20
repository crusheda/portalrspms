import './bootstrap';
import 'bootstrap';

import './components/radio-player';
import './jadwal-dokter';
import './ketersediaan-tempat-tidur';

document.addEventListener('click', function (event) {
    const dropdown = event.target.closest('.rs-nav-dropdown');

    // Klik di luar dropdown akan menutup semua submenu.
    if (!dropdown) {
        document.querySelectorAll('.rs-nav-dropdown.is-open').forEach((item) => {
            item.classList.remove('is-open');

            const toggle = item.querySelector(':scope > a, :scope > button');

            if (toggle) {
                toggle.setAttribute('aria-expanded', 'false');
            }
        });

        return;
    }

    // Perilaku tap khusus untuk mobile/tablet.
    if (window.matchMedia('(max-width: 991.98px)').matches) {
        const toggle = event.target.closest(':scope > a, :scope > button');

        // Pastikan yang diklik memang tombol/link pemicu dropdown,
        // bukan link yang berada di dalam submenu.
        if (
            event.target.closest('.rs-nav-dropdown-menu') ||
            !toggle ||
            !dropdown.querySelector('.rs-nav-dropdown-menu')
        ) {
            return;
        }

        event.preventDefault();

        const shouldOpen = !dropdown.classList.contains('is-open');

        document.querySelectorAll('.rs-nav-dropdown.is-open').forEach((item) => {
            item.classList.remove('is-open');

            const itemToggle = item.querySelector(':scope > a, :scope > button');

            if (itemToggle) {
                itemToggle.setAttribute('aria-expanded', 'false');
            }
        });

        if (shouldOpen) {
            dropdown.classList.add('is-open');
            toggle.setAttribute('aria-expanded', 'true');
        }
    }
});

/* =========================================
    GLOBAL SCROLL TO TOP
========================================= */
(() => {
    function initScrollToTop() {
        const button = document.getElementById('rsScrollToTop');

        if (!button || button.dataset.initialized === 'true') {
            return;
        }

        button.dataset.initialized = 'true';

        const radioPlayer = document.getElementById('rsRadioPlayer');
        const reduceMotion = window.matchMedia(
            '(prefers-reduced-motion: reduce)'
        ).matches;

        function updateScrollToTop() {
            const isVisible = window.scrollY > 320;

            button.classList.toggle('is-visible', isVisible);
            button.setAttribute('aria-hidden', String(!isVisible));
            button.tabIndex = isVisible ? 0 : -1;

            let bottom = window.matchMedia('(max-width: 575.98px)').matches
                ? 18
                : 24;

            if (
                isVisible &&
                radioPlayer &&
                !radioPlayer.hidden
            ) {
                const playerRect = radioPlayer.getBoundingClientRect();
                const buttonWidth = button.offsetWidth;

                const buttonRight = window.innerWidth -
                    button.getBoundingClientRect().right;

                const buttonLeft = button.getBoundingClientRect().left;

                const overlapsHorizontally =
                    buttonLeft < playerRect.right &&
                    buttonLeft + buttonWidth > playerRect.left;

                const playerIsVisible =
                    playerRect.bottom > 0 &&
                    playerRect.top < window.innerHeight;

                if (overlapsHorizontally && playerIsVisible) {
                    bottom = Math.max(
                        bottom,
                        window.innerHeight - playerRect.top + 14
                    );
                }
            }

            button.style.bottom = `${bottom}px`;
        }

        button.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: reduceMotion ? 'auto' : 'smooth'
            });
        });

        window.addEventListener('scroll', updateScrollToTop, {
            passive: true
        });

        window.addEventListener('resize', updateScrollToTop);

        if (radioPlayer) {
            new MutationObserver(updateScrollToTop).observe(radioPlayer, {
                attributes: true,
                attributeFilter: ['hidden', 'class', 'style']
            });
        }

        updateScrollToTop();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initScrollToTop, {
            once: true
        });
    } else {
        initScrollToTop();
    }

    document.addEventListener('livewire:navigated', initScrollToTop);

    // VIDEO PLAYER profil.mp4
    const profileVideoModal = document.getElementById('rsProfileVideoModal');
    const profileVideo = document.getElementById('rsProfileVideo');

    if (profileVideoModal && profileVideo) {
        profileVideoModal.addEventListener('shown.bs.modal', async () => {
            try {
                await profileVideo.play();
            } catch (error) {
                // Jika autoplay ditolak browser, pengguna dapat menekan tombol Play.
            }
        });

        profileVideoModal.addEventListener('hidden.bs.modal', () => {
            profileVideo.pause();
            profileVideo.currentTime = 0;
        });
    }

})();
