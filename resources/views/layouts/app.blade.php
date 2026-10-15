<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description"
        content="Portal RS PKU Muhammadiyah Sukoharjo. Informasi profil rumah sakit, jadwal dokter, dan ketersediaan tempat tidur.">

    <meta name="theme-color" content="#087f5b">

    <title>{{ $title ?? 'RS PKU Muhammadiyah Sukoharjo' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

</head>

<body>

    {{-- NAVBAR GLOBAL --}}
    <header class="rs-navbar">
        <div class="rs-container">
            <div class="rs-navbar-inner">

                <a href="{{ route('beranda') }}" wire:navigate class="rs-brand">

                    <img src="{{ asset('images/logo-rs.png') }}" alt="Logo RS PKU Muhammadiyah Sukoharjo"
                        onerror="this.style.display='none'">

                    <div>
                        <div class="rs-brand-title">
                            RS PKU MUHAMMADIYAH
                        </div>

                        <div class="rs-brand-subtitle">
                            SUKOHARJO
                        </div>
                    </div>
                </a>

                <button class="btn btn-outline-success d-lg-none" type="button" id="rsMenuToggle"
                    aria-label="Buka navigasi" aria-expanded="false">
                    <i class="bi bi-list fs-5"></i>
                </button>

                <nav class="rs-nav" id="rsNavigation">

                    <a href="{{ route('beranda') }}" wire:navigate wire:current="active">
                        Beranda
                    </a>

                    <a href="{{ route('profil-rs') }}" wire:navigate wire:current="active">
                        Profil RS
                    </a>

                    <a href="{{ route('tentang') }}" wire:navigate wire:current="active">
                        Tentang
                    </a>

                    <a href="{{ route('jadwal-dokter') }}" wire:navigate wire:current="active">
                        Jadwal Dokter
                    </a>

                    <a href="{{ route('ketersediaan-tempat-tidur') }}" wire:navigate wire:current="active">
                        Ketersediaan Tempat Tidur
                    </a>

                </nav>

            </div>
        </div>
    </header>

    {{-- KONTEN HALAMAN --}}
    <main>
        {{ $slot }}
    </main>

    {{-- FOOTER GLOBAL --}}
    <footer class="rs-footer" id="kontak">
        <div class="rs-container">

            <div class="row g-4">

                <div class="col-12 col-lg-5">
                    <div class="d-flex align-items-center gap-3 mb-3">

                        <img src="{{ asset('images/logo-rs.png') }}" alt="Logo RS PKU Muhammadiyah Sukoharjo"
                            width="50" height="50" style="object-fit:contain"
                            onerror="this.style.display='none'">

                        <div>
                            <h3 class="mb-1">
                                RS PKU Muhammadiyah Sukoharjo
                            </h3>

                            <div style="font-size:11px">
                                Amanah, Santun, Ramah, Ikhlas
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
                        Sukoharjo, Jawa Tengah
                    </p>

                    <p>
                        <a href="https://rspkusukoharjo.com/">
                            Website Resmi Rumah Sakit
                        </a>
                    </p>
                </div>

                <div class="col-12 col-sm-6 col-lg-4">
                    <h3>Navigasi</h3>

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
                &copy; {{ date('Y') }} RS PKU Muhammadiyah Sukoharjo.
                Hak cipta dilindungi.
            </div>

        </div>
    </footer>

    @livewireScripts

    <script>
        function initRsNavbar() {
            const toggle = document.getElementById('rsMenuToggle');
            const navigation = document.getElementById('rsNavigation');

            if (!toggle || !navigation || toggle.dataset.initialized) {
                return;
            }

            toggle.dataset.initialized = 'true';

            toggle.addEventListener('click', function() {
                const isOpen = navigation.classList.toggle('show');

                toggle.setAttribute('aria-expanded', String(isOpen));
            });

            navigation.querySelectorAll('a').forEach(function(link) {
                link.addEventListener('click', function() {
                    navigation.classList.remove('show');

                    toggle.setAttribute('aria-expanded', 'false');
                });
            });
        }

        document.addEventListener('DOMContentLoaded', initRsNavbar);

        document.addEventListener('livewire:navigated', initRsNavbar);
    </script>

</body>

</html>
