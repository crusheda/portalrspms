<?php

use Livewire\Component;

new class extends Component
{
    //
};

?>

<div>

    {{-- HERO --}}
    <section class="rs-hero">
        <div class="rs-container">
            <div class="rs-hero-grid">

                <div>
                    <div class="rs-eyebrow">
                        <i class="bi bi-heart-pulse"></i>
                        PORTAL RESMI RUMAH SAKIT
                    </div>

                    <h1>
                        Pelayanan Kesehatan
                        <span>Terpercaya</span>
                        untuk Anda dan Keluarga
                    </h1>

                    <p class="rs-hero-description">
                        Selamat datang di Rumah Sakit PKU Muhammadiyah Sukoharjo.
                        Kami berkomitmen memberikan pelayanan kesehatan yang
                        Amanah, Santun, Ramah, dan Ikhlas (ASRI).
                    </p>

                    <div class="d-flex flex-wrap gap-3">
                        <a
                            href="{{ route('jadwal-dokter') }}" wire:navigate
                            class="rs-button-primary"
                        >
                            <i class="bi bi-calendar2-week"></i>
                            Jadwal Dokter
                        </a>

                        <a
                            href="#layanan"
                            class="rs-button-outline"
                        >
                            Jelajahi Layanan
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="rs-hero-image">
                    <img
                        src="{{ asset('images/hero-rs.jpg') }}"
                        alt="Rumah Sakit PKU Muhammadiyah Sukoharjo"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"
                    >

                    <div
                        class="rs-hero-image-placeholder"
                        style="display:none"
                    >
                        <i class="bi bi-hospital"></i>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- AKSES CEPAT --}}
    <section class="rs-quick-access">
        <div class="rs-container">
            <div class="rs-quick-grid">

                <a
                    href="{{ route('jadwal-dokter') }}" wire:navigate
                    class="rs-quick-item"
                >
                    <div class="rs-quick-icon">
                        <i class="bi bi-calendar2-week"></i>
                    </div>

                    <div>
                        <div class="rs-quick-title">
                            Jadwal Dokter
                        </div>

                        <p class="rs-quick-description">
                            Informasi jadwal praktik dokter.
                        </p>
                    </div>
                </a>

                <a
                    href="{{ route('ketersediaan-tempat-tidur') }}" wire:navigate
                    class="rs-quick-item"
                >
                    <div class="rs-quick-icon">
                        <i class="bi bi-hospital"></i>
                    </div>

                    <div>
                        <div class="rs-quick-title">
                            Ketersediaan Tempat Tidur
                        </div>

                        <p class="rs-quick-description">
                            Informasi ketersediaan tempat tidur rawat inap.
                        </p>
                    </div>
                </a>

                <a
                    href="https://rspkusukoharjo.com/"
                    class="rs-quick-item"
                >
                    <div class="rs-quick-icon">
                        <i class="bi bi-globe2"></i>
                    </div>

                    <div>
                        <div class="rs-quick-title">
                            Portal Resmi
                        </div>

                        <p class="rs-quick-description">
                            Kunjungi website resmi rumah sakit.
                        </p>
                    </div>
                </a>

            </div>
        </div>
    </section>

    {{-- TENTANG KAMI --}}
    <section class="rs-section" id="profil-rs">
        <div class="rs-container">
            <div class="rs-about-grid">

                <div class="rs-about-visual">
                    <i class="bi bi-hospital"></i>
                </div>

                <div class="rs-about-content">
                    <div class="rs-section-label">
                        Lebih Dekat dengan Kami
                    </div>

                    <h2>
                        Pelayanan Kesehatan yang Mengutamakan Anda
                    </h2>

                    <p>
                        RS PKU Muhammadiyah Sukoharjo terus berupaya
                        memberikan pelayanan kesehatan yang profesional,
                        berkualitas, dan berlandaskan nilai-nilai Islami.
                    </p>

                    <div class="rs-feature">
                        <div class="rs-feature-icon">
                            <i class="bi bi-heart-pulse"></i>
                        </div>

                        <div>
                            <h3>Fasilitas Kesehatan Terintegrasi</h3>

                            <p>
                                Mendukung koordinasi pelayanan dan perawatan
                                pasien sesuai kebutuhan medis.
                            </p>
                        </div>
                    </div>

                    <div class="rs-feature">
                        <div class="rs-feature-icon">
                            <i class="bi bi-person-check"></i>
                        </div>

                        <div>
                            <h3>Tenaga Medis Profesional</h3>

                            <p>
                                Pelayanan yang mengutamakan kompetensi,
                                keselamatan, dan kenyamanan pasien.
                            </p>
                        </div>
                    </div>

                    <div class="rs-feature">
                        <div class="rs-feature-icon">
                            <i class="bi bi-moon-stars"></i>
                        </div>

                        <div>
                            <h3>Pelayanan Berbasis Islami</h3>

                            <p>
                                Mengedepankan nilai Amanah, Santun,
                                Ramah, dan Ikhlas (ASRI).
                            </p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a
                            href="{{ route('tentang') }}" wire:navigate
                            class="rs-button-primary"
                        >
                            Mengenal Rumah Sakit
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- LAYANAN --}}
    <section class="rs-section rs-section-soft" id="layanan">
        <div class="rs-container">

            <div class="rs-section-heading">
                <div class="rs-section-label">
                    Pelayanan Rumah Sakit
                </div>

                <h2>
                    Layanan Kesehatan untuk Kebutuhan Anda
                </h2>

                <p>
                    Temukan informasi layanan kesehatan yang tersedia
                    di RS PKU Muhammadiyah Sukoharjo.
                </p>
            </div>

            <div class="row g-4">

                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="rs-card">
                        <div class="rs-card-icon">
                            <i class="bi bi-person-hearts"></i>
                        </div>

                        <h3>Rawat Jalan</h3>

                        <p>
                            Informasi pemeriksaan dan pelayanan poliklinik
                            untuk kebutuhan kesehatan pasien.
                        </p>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="rs-card">
                        <div class="rs-card-icon">
                            <i class="bi bi-hospital"></i>
                        </div>

                        <h3>Rawat Inap</h3>

                        <p>
                            Informasi fasilitas perawatan dan ketersediaan
                            tempat tidur rawat inap.
                        </p>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="rs-card">
                        <div class="rs-card-icon">
                            <i class="bi bi-activity"></i>
                        </div>

                        <h3>Gawat Darurat</h3>

                        <p>
                            Informasi pelayanan kegawatdaruratan rumah sakit.
                            Untuk kondisi darurat, segera menuju IGD.
                        </p>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="rs-card">
                        <div class="rs-card-icon">
                            <i class="bi bi-calendar2-check"></i>
                        </div>

                        <h3>Jadwal Dokter</h3>

                        <p>
                            Cari informasi jadwal praktik dokter berdasarkan
                            layanan dan waktu praktik.
                        </p>

                        <a
                            href="{{ route('jadwal-dokter') }}" wire:navigate
                            class="d-inline-flex align-items-center gap-2 mt-3 text-success fw-semibold"
                        >
                            Lihat Jadwal
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="rs-card">
                        <div class="rs-card-icon">
                            <i class="bi bi-clipboard2-pulse"></i>
                        </div>

                        <h3>Laboratorium dan Radiologi</h3>

                        <p>
                            Informasi layanan penunjang medis untuk
                            mendukung pemeriksaan pasien.
                        </p>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="rs-card">
                        <div class="rs-card-icon">
                            <i class="bi bi-door-open"></i>
                        </div>

                        <h3>Ketersediaan Tempat Tidur</h3>

                        <p>
                            Informasi ketersediaan tempat tidur rawat inap
                            berdasarkan data yang tersedia.
                        </p>

                        <a
                            href="{{ route('ketersediaan-tempat-tidur') }}" wire:navigate
                            class="d-inline-flex align-items-center gap-2 mt-3 text-success fw-semibold"
                        >
                            Lihat Ketersediaan
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- RAWAT INAP --}}
    <section class="rs-section" id="rawat-inap">
        <div class="rs-container">
            <div class="rs-inpatient">

                <div class="rs-inpatient-visual">
                    <i class="bi bi-house-heart"></i>
                </div>

                <div>
                    <div class="rs-section-label">
                        Fasilitas Rawat Inap
                    </div>

                    <h2>
                        Perawatan yang Nyaman untuk Mendukung Pemulihan
                    </h2>

                    <p>
                        Informasi fasilitas rawat inap membantu pasien dan
                        keluarga mengenal layanan perawatan rumah sakit.
                        Ketersediaan aktual tempat tidur dapat berubah
                        sesuai kondisi pelayanan.
                    </p>

                    <ul class="rs-check-list">
                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            Bangsal Kebidanan
                        </li>

                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            Bangsal Anak
                        </li>

                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            Bangsal Dewasa
                        </li>

                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            Bangsal Isolasi
                        </li>
                    </ul>

                    <a
                        href="{{ route('ketersediaan-tempat-tidur') }}" wire:navigate
                        class="rs-button-primary"
                    >
                        Cek Tempat Tidur
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- BERITA --}}
    <section class="rs-section rs-section-soft" id="berita">
        <div class="rs-container">

            <div class="rs-section-heading">
                <div class="rs-section-label">
                    Informasi Rumah Sakit
                </div>

                <h2>
                    Informasi dan Berita Terkini
                </h2>

                <p>
                    Ikuti informasi dan perkembangan pelayanan
                    RS PKU Muhammadiyah Sukoharjo.
                </p>
            </div>

            <div class="row g-4">

                <div class="col-12 col-md-4">
                    <article class="rs-news-card">
                        <div class="rs-news-visual">
                            <i class="bi bi-megaphone"></i>
                        </div>

                        <div class="rs-news-content">
                            <h3>Informasi Pelayanan Rumah Sakit</h3>

                            <p>
                                Informasi pelayanan akan ditampilkan
                                setelah modul berita tersedia.
                            </p>
                        </div>
                    </article>
                </div>

                <div class="col-12 col-md-4">
                    <article class="rs-news-card">
                        <div class="rs-news-visual">
                            <i class="bi bi-heart-pulse"></i>
                        </div>

                        <div class="rs-news-content">
                            <h3>Edukasi Kesehatan</h3>

                            <p>
                                Informasi edukasi kesehatan dapat
                                dikembangkan melalui modul berita.
                            </p>
                        </div>
                    </article>
                </div>

                <div class="col-12 col-md-4">
                    <article class="rs-news-card">
                        <div class="rs-news-visual">
                            <i class="bi bi-building"></i>
                        </div>

                        <div class="rs-news-content">
                            <h3>Kegiatan Rumah Sakit</h3>

                            <p>
                                Informasi kegiatan rumah sakit akan
                                ditampilkan setelah sumber berita tersedia.
                            </p>
                        </div>
                    </article>
                </div>

            </div>
        </div>
    </section>
</div>
