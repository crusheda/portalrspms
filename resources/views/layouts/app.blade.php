<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta
        name="description"
        content="{{ $metaDescription ?? 'Portal RS PKU Muhammadiyah Sukoharjo. Informasi profil rumah sakit, jadwal dokter, dan ketersediaan tempat tidur.' }}"
    >

    <meta
        name="keywords"
        content="rumah sakit, rspkuskh, pku sukoharjo, rawat jalan, rawat inap, rs bpjs"
    >

    <meta name="author" content="RS PKU Muhammadiyah Sukoharjo">
    <meta name="theme-color" content="#087f5b">

    <title>{{ $title ?? 'Portal RS PKU Muhammadiyah Sukoharjo' }}</title>

    <link
        rel="apple-touch-icon"
        sizes="76x76"
        href="{{ asset('img/pku/pku_ico.png') }}"
    >

    <link
        rel="icon"
        type="image/png"
        sizes="96x96"
        href="{{ asset('img/pku/pku_ico.png') }}"
    >

    <link
        rel="shortcut icon"
        href="{{ asset('img/pku/pku_ico.png') }}"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body>

    {{-- NAVBAR GLOBAL --}}
    <header class="rs-navbar">
        <div class="rs-container">
            <div class="rs-navbar-inner">

                {{-- BRAND --}}
                <a href="{{ route('beranda') }}"
                    wire:navigate
                    class="rs-brand"
                    aria-label="Beranda RS PKU Muhammadiyah Sukoharjo">

                    <img
                        src="{{ asset('img/pku/logo-1-sm-green.png') }}"
                        alt="Logo RS PKU Muhammadiyah Sukoharjo"
                        style="width:100%"
                    >

                    {{-- <div class="rs-brand-text">
                        <div class="rs-brand-title">
                            RS PKU MUHAMMADIYAH
                        </div>

                        <div class="rs-brand-subtitle">
                            SUKOHARJO
                        </div>
                    </div> --}}
                </a>

                {{-- MOBILE TOGGLE --}}
                <button
                    class="rs-menu-toggle"
                    type="button"
                    id="rsMenuToggle"
                    aria-label="Buka navigasi"
                    aria-expanded="false"
                    aria-controls="rsNavigation"
                >
                    <i class="bi bi-list"></i>
                </button>

                {{-- NAVIGATION --}}
                <nav class="rs-nav" id="rsNavigation">

                    {{-- Beranda --}}
                    <a href="{{ route('beranda') }}"
                    wire:navigate
                    @class(['rs-nav-link', 'active' => request()->routeIs('beranda')])
                    @if(request()->routeIs('beranda')) aria-current="page" @endif>
                        <i class="bi bi-house-door"></i>
                        <span>Beranda</span>
                    </a>

                    {{-- Profil RS --}}
                    <a href="{{ route('profil-rs') }}"
                    wire:navigate
                    @class(['rs-nav-link', 'active' => request()->routeIs('profil-rs')])
                    @if(request()->routeIs('profil-rs')) aria-current="page" @endif>
                        <i class="bi bi-hospital"></i>
                        <span>Profil RS</span>
                    </a>

                    {{-- Tentang --}}
                    <a href="{{ route('tentang') }}"
                    wire:navigate
                    @class(['rs-nav-link', 'active' => request()->routeIs('tentang')])
                    @if(request()->routeIs('tentang')) aria-current="page" @endif>
                        <i class="bi bi-hospital"></i>
                        <span>Tentang</span>
                    </a>

                    {{-- Dropdown Publik --}}
                    <div
                        id="rsPublicDropdown"
                        @class([
                            'rs-nav-dropdown',
                            'is-active' => request()->routeIs(
                                'jadwal-dokter',
                                'ketersediaan-tempat-tidur'
                            ),
                        ])
                    >
                        <button
                            type="button"
                            id="rsPublicDropdownToggle"
                            class="rs-nav-link rs-nav-dropdown-toggle"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <i class="bi bi-grid"></i>
                            <span>Informasi</span>
                            <i class="bi bi-chevron-down rs-dropdown-chevron"></i>
                        </button>

                        <div class="rs-nav-dropdown-menu">

                            {{-- Jadwal Dokter --}}
                            <a
                                href="{{ route('jadwal-dokter') }}"
                                wire:navigate
                                @class([
                                    'rs-nav-dropdown-menu-item','rs-nav-dropdown-item',
                                    'active' => request()->routeIs('jadwal-dokter'),
                                ])
                                @if(request()->routeIs('jadwal-dokter'))
                                    aria-current="page"
                                @endif
                            >
                                <i class="bi bi-calendar2-week"></i>

                                <span class="rs-dropdown-text">
                                    <strong>Jadwal Dokter</strong>
                                    <small>Lihat Jadwal Praktik Dokter Spesialis</small>
                                </span>
                            </a>

                            {{-- Ketersediaan Tempat Tidur --}}
                            <a
                                href="{{ route('ketersediaan-tempat-tidur') }}"
                                wire:navigate
                                @class([
                                    'rs-nav-dropdown-menu-item','rs-nav-dropdown-item',
                                    'active' => request()->routeIs('ketersediaan-tempat-tidur'),
                                ])
                                @if(request()->routeIs('ketersediaan-tempat-tidur'))
                                    aria-current="page"
                                @endif
                            >
                                <i class="bi bi-hospital"></i>

                                <span class="rs-dropdown-text">
                                    <strong>Tempat Tidur</strong>
                                    <small>Lihat Ketersediaan Tempat Tidur</small>
                                </span>
                            </a>

                        </div>
                    </div>

                    {{-- Dropdown Rekrutmen --}}
                    <div
                        id="rsRecruitmentDropdown"
                        @class([
                            'rs-nav-dropdown',
                            'is-active' => request()->routeIs(
                                'rekrutmen.pengumuman',
                                'rekrutmen.registrasi',
                                'rekrutmen.hasil-seleksi'
                            ),
                        ])
                    >
                        <button
                            type="button"
                            id="rsRecruitmentDropdownToggle"
                            class="rs-nav-link rs-nav-dropdown-toggle"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <i class="bi bi-people"></i>
                            <span>Rekrutmen</span>
                            <i class="bi bi-chevron-down rs-dropdown-chevron"></i>
                        </button>

                        <div class="rs-nav-dropdown-menu">

                            {{-- Pengumuman --}}
                            <button
                                type="button"
                                class="rs-nav-dropdown-menu-item rs-nav-dropdown-item"
                                disabled
                                aria-disabled="true"
                            >
                                <i class="bi bi-megaphone"></i>

                                <span class="rs-dropdown-text">
                                    <strong>Pengumuman</strong>
                                    <small>Informasi lowongan pekerjaan</small>
                                </span>
                            </button>

                            {{-- Registrasi --}}
                            <button
                                type="button"
                                class="rs-nav-dropdown-menu-item rs-nav-dropdown-item"
                                disabled
                                aria-disabled="true"
                            >
                                <i class="bi bi-person-plus"></i>

                                <span class="rs-dropdown-text">
                                    <strong>Registrasi</strong>
                                    <small>Pendaftaran calon pegawai</small>
                                </span>
                            </button>

                            {{-- Hasil Seleksi --}}
                            <button
                                type="button"
                                class="rs-nav-dropdown-menu-item rs-nav-dropdown-item"
                                disabled
                                aria-disabled="true"
                            >
                                <i class="bi bi-clipboard-check"></i>

                                <span class="rs-dropdown-text">
                                    <strong>Hasil Seleksi</strong>
                                    <small>Informasi hasil seleksi calon pegawai</small>
                                </span>
                            </button>

                        </div>
                    </div>

                </nav>

            </div>
        </div>
    </header>

    {{-- KONTEN HALAMAN --}}
    <main>
        {{ $slot }}
    </main>

    {{-- FLOATING RADIO PLAYER --}}
    @persist('radio-player')
        <div id="rsRadioPlayer" class="rs-radio-player" hidden>

            {{-- Header --}}
            <div class="rs-radio-player-header">
                <div class="rs-radio-player-brand">
                    <i class="bi bi-broadcast-pin"></i>

                    <div>
                        <strong>Radio Muhammadiyah</strong>
                        <small>
                            <span class="rs-radio-live-dot"></span>
                            LIVE
                        </small>
                    </div>
                </div>

                <div class="rs-radio-player-controls">
                    <button
                        type="button"
                        id="rsRadioMinimize"
                        class="rs-radio-control"
                        aria-label="Minimalkan radio"
                        title="Minimalkan"
                    >
                        <i class="bi bi-dash-lg"></i>
                    </button>

                    <button
                        type="button"
                        id="rsRadioClose"
                        class="rs-radio-control"
                        aria-label="Tutup radio"
                        title="Tutup radio"
                    >
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>

            {{-- Audio --}}
            <div id="rsRadioPlayerBody" class="rs-radio-player-body">
                <audio
                    id="rsRadioFrame"
                    controls
                    preload="none"
                    style="width: 100%;"
                ></audio>
            </div>

        </div>
    @endpersist

    {{-- FOOTER GLOBAL --}}
    <footer class="rs-footer" id="kontak">
        <div class="rs-container">

            <div class="row g-4">

                <div class="col-12 col-lg-5">
                    <div class="d-flex align-items-center gap-3 mb-3">

                        <img src="{{ asset('img/pku/logo-rs.png') }}" alt="Logo RS PKU Muhammadiyah Sukoharjo"
                            width="50" height="50" style="object-fit:contain"
                            onerror="this.style.display='none'">

                        <div>
                            <h3 class="mb-1">
                                RS PKU Muhammadiyah Sukoharjo
                            </h3>

                            <div style="font-size:11px">
                                ⭐⭐⭐⭐⭐ Terakreditasi Paripurna
                            </div>
                        </div>

                    </div>

                    <p>
                        Portal informasi RS PKU Muhammadiyah Sukoharjo
                        untuk membantu masyarakat mengakses informasi
                        layanan rumah sakit.
                    </p>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">

                    <h3>Kontak</h3>

                    <p>
                        <i class="bi bi-geo-alt me-2"></i>
                        Jl. Mayor Sunaryo No. 37, Sukoharjo, JT
                    </p>

                    <p>
                        <i class="bi bi-telephone me-2"></i>
                        IGD 24 Jam:
                        <a href="tel:02715991165">0271 599 1165</a>
                    </p>

                    <p>
                        <i class="bi bi-telephone me-2"></i>
                        Informasi RS:
                        <a href="tel:0271593979">0271 593 979</a>
                    </p>

                    <p>
                        <i class="bi bi-whatsapp me-2"></i>
                        <a
                            href="https://wa.me/6285150763480"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            WhatsApp Informasi
                        </a>
                    </p>

                </div>

                <div class="col-12 col-sm-6 col-lg-4">
                    <h3>Menu</h3>

                    <p>
                        <a href="{{ route('beranda') }}" wire:navigate>
                            Beranda
                        </a>
                    </p>

                    <p>
                        <a href="{{ route('profil-rs') }}" wire:navigate>
                            Profil RS
                        </a>
                    </p>

                    <p>
                        <a href="{{ route('tentang') }}" wire:navigate>
                            Tentang
                        </a>
                    </p>

                    <p>
                        <a href="{{ route('jadwal-dokter') }}" wire:navigate>
                            Jadwal Dokter
                        </a>
                    </p>

                    <p>
                        <a href="{{ route('ketersediaan-tempat-tidur') }}" wire:navigate>
                            Ketersediaan Tempat Tidur
                        </a>
                    </p>
                </div>

            </div>

            <div class="rs-footer-bottom">
                &copy; {{ date('Y') }} IT RS PKU Muhammadiyah Sukoharjo.
                Hak cipta dilindungi.
            </div>

        </div>
    </footer>

    {{-- GLOBAL SCROLL TO TOP --}}
    <button
        type="button"
        id="rsScrollToTop"
        class="rs-scroll-to-top"
        aria-label="Kembali ke atas"
        title="Kembali ke atas"
        aria-hidden="true"
        tabindex="-1"
    >
        <i class="bi bi-arrow-up"></i>
        <span class="rs-scroll-to-top-ripple"></span>
    </button>

    @livewireScripts

    <script>
        function initRsNavbar() {
            const toggle = document.getElementById('rsMenuToggle');
            const navigation = document.getElementById('rsNavigation');
            const dropdown = document.getElementById('rsPublicDropdown');
            const dropdownToggle = document.getElementById('rsPublicDropdownToggle');

            if (!toggle || !navigation || !dropdown || !dropdownToggle) {
                return;
            }

            // Hindari memasang event listener berulang.
            if (toggle.dataset.initialized === 'true') {
                return;
            }

            toggle.dataset.initialized = 'true';

            function closeDropdown() {
                dropdown.classList.remove('is-open');
                dropdownToggle.setAttribute('aria-expanded', 'false');
            }

            function closeMobileNavigation() {
                navigation.classList.remove('show');
                toggle.setAttribute('aria-expanded', 'false');
                closeDropdown();
            }

            toggle.addEventListener('click', function () {
                const isOpen = navigation.classList.toggle('show');

                toggle.setAttribute('aria-expanded', String(isOpen));

                if (!isOpen) {
                    closeDropdown();
                }
            });

            dropdownToggle.addEventListener('click', function (event) {
                event.stopPropagation();

                const isOpen = dropdown.classList.toggle('is-open');

                dropdownToggle.setAttribute('aria-expanded', String(isOpen));
            });

            /* Dropdown otomatis terbuka saat cursor diarahkan ke Publik */
            dropdown.addEventListener('mouseenter', function () {
                if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
                    dropdown.classList.add('is-open');
                    dropdownToggle.setAttribute('aria-expanded', 'true');
                }
            });

            /* Tutup dropdown dengan sedikit jeda agar submenu bisa diklik */
            dropdown.addEventListener('mouseleave', function () {
                if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
                    setTimeout(function () {
                        if (!dropdown.matches(':hover')) {
                            dropdown.classList.remove('is-open');
                            dropdownToggle.setAttribute('aria-expanded', 'false');
                        }
                    }, 150);
                }
            });

            // Klik di luar dropdown akan menutup menu.
            document.addEventListener('click', function (event) {
                if (!dropdown.contains(event.target)) {
                    closeDropdown();
                }
            });

            // Escape menutup dropdown.
            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    closeDropdown();
                }
            });

            // Tutup navigasi mobile setelah memilih halaman.
            navigation.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', closeMobileNavigation);
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            initRsNavbar();
            updateRsNavbarOnScroll();
        });

        document.addEventListener('livewire:navigated', function () {
            initRsNavbar();
            updateRsNavbarOnScroll();
        });

        function updateRsNavbarOnScroll() {
            const navbar = document.querySelector('.rs-navbar');

            if (!navbar) {
                return;
            }

            navbar.classList.toggle('is-scrolled', window.scrollY > 24);
        }

        /* Hindari memasang event listener scroll berulang */
        if (!window.rsNavbarScrollInitialized) {
            window.rsNavbarScrollInitialized = true;

            window.addEventListener('scroll', updateRsNavbarOnScroll, {
                passive: true
            });
        }
    </script>
</body>

</html>
