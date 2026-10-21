(() => {
    function initPosterLightbox() {
        const lightbox = document.getElementById('rsPosterLightbox');

        if (!lightbox || lightbox.dataset.initialized === 'true') {
            return;
        }

        lightbox.dataset.initialized = 'true';

        const image = document.getElementById('rsPosterLightboxImage');
        const caption = document.getElementById('rsPosterCaption');
        const counter = document.getElementById('rsPosterCounter');

        const closeButton = document.getElementById('rsPosterClose');
        const prevButton = document.getElementById('rsPosterPrev');
        const nextButton = document.getElementById('rsPosterNext');

        const cards = Array.from(
            document.querySelectorAll('.rs-home-poster-card[data-poster-index]')
        );

        if (!image || !caption || !counter || !closeButton ||
            !prevButton || !nextButton || !cards.length) {
            return;
        }

        const posters = cards.map((card, index) => {
            const img = card.querySelector('img');

            return {
                src: img?.currentSrc || img?.src || '',
                alt: img?.alt || `Poster edukasi kesehatan ${index + 1}`,
                trigger: card,
            };
        });

        let currentIndex = 0;
        let lastFocusedElement = null;

        function showPoster(index) {
            currentIndex = (index + posters.length) % posters.length;

            const poster = posters[currentIndex];

            image.src = poster.src;
            image.alt = poster.alt;
            caption.textContent = poster.alt;
            counter.textContent = `${currentIndex + 1} / ${posters.length}`;

            prevButton.disabled = posters.length < 2;
            nextButton.disabled = posters.length < 2;
        }

        function openLightbox(index) {
            lastFocusedElement = document.activeElement;

            showPoster(index);

            lightbox.inert = false;
            lightbox.setAttribute('aria-hidden', 'false');
            lightbox.classList.add('is-open');

            document.body.classList.add('rs-poster-lightbox-open');

            closeButton.focus();
        }

        function closeLightbox() {
            if (!lightbox.classList.contains('is-open')) {
                return;
            }

            lightbox.classList.remove('is-open');
            lightbox.setAttribute('aria-hidden', 'true');
            lightbox.inert = true;

            document.body.classList.remove('rs-poster-lightbox-open');

            image.removeAttribute('src');

            if (lastFocusedElement?.isConnected) {
                lastFocusedElement.focus();
            }
        }

        function showPrevious() {
            showPoster(currentIndex - 1);
        }

        function showNext() {
            showPoster(currentIndex + 1);
        }

        cards.forEach((card, index) => {
            card.addEventListener('click', () => {
                openLightbox(index);
            });
        });

        closeButton.addEventListener('click', closeLightbox);
        prevButton.addEventListener('click', showPrevious);
        nextButton.addEventListener('click', showNext);

        lightbox.addEventListener('click', (event) => {
            if (event.target === lightbox) {
                closeLightbox();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (!lightbox.classList.contains('is-open')) {
                return;
            }

            if (event.key === 'Escape') {
                event.preventDefault();
                closeLightbox();
            } else if (event.key === 'ArrowLeft') {
                event.preventDefault();
                showPrevious();
            } else if (event.key === 'ArrowRight') {
                event.preventDefault();
                showNext();
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initPosterLightbox, {
            once: true,
        });
    } else {
        initPosterLightbox();
    }

    // Dukungan navigasi halaman Livewire jika menggunakan wire:navigate.
    document.addEventListener('livewire:navigated', initPosterLightbox);
})();

