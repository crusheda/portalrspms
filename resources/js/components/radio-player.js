(() => {
    if (window.rsRadioPlayerInitialized) return;

    window.rsRadioPlayerInitialized = true;

    const RADIO_URL = 'https://b3.stri.my.id:4320/radio';

    let player;
    let frame;
    let minimizeButton;
    let closeButton;

    function getElements() {
        player = document.getElementById('rsRadioPlayer');
        frame = document.getElementById('rsRadioFrame');
        minimizeButton = document.getElementById('rsRadioMinimize');
        closeButton = document.getElementById('rsRadioClose');
    }

    function openRadio() {
        if (!player || !frame) getElements();
        if (!player || !frame) return;

        player.hidden = false;
        player.classList.remove('is-minimized');

        minimizeButton?.setAttribute('aria-label', 'Minimalkan radio');

        if (!frame.dataset.loaded) {
            frame.src = RADIO_URL;
            frame.dataset.loaded = 'true';
            frame.play().catch(() => {});
        }
    }

    function minimizeRadio() {
        if (!player) return;

        const minimized = player.classList.toggle('is-minimized');

        minimizeButton?.setAttribute(
            'aria-label',
            minimized ? 'Perbesar radio' : 'Minimalkan radio'
        );

        minimizeButton?.setAttribute(
            'title',
            minimized ? 'Perbesar' : 'Minimalkan'
        );

        if (minimizeButton) {
            minimizeButton.innerHTML = minimized
                ? '<i class="bi bi-arrows-angle-expand"></i>'
                : '<i class="bi bi-dash-lg"></i>';
        }
    }

    function closeRadio() {
        if (!player || !frame) return;

        frame.pause();
        frame.removeAttribute('src');
        frame.load();
        delete frame.dataset.loaded;

        player.hidden = true;
        player.classList.remove('is-minimized');

        if (minimizeButton) {
            minimizeButton.innerHTML = '<i class="bi bi-dash-lg"></i>';
            minimizeButton.setAttribute('aria-label', 'Minimalkan radio');
            minimizeButton.setAttribute('title', 'Minimalkan');
        }
    }

    function initialize() {
        getElements();
        if (!player) return;

        document.addEventListener('click', event => {
            if (event.target.closest('[data-radio-open]')) {
                event.preventDefault();
                openRadio();
                return;
            }

            if (event.target.closest('#rsRadioMinimize')) {
                minimizeRadio();
                return;
            }

            if (event.target.closest('#rsRadioClose')) {
                closeRadio();
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initialize, {
            once: true,
        });
    } else {
        initialize();
    }
})();
