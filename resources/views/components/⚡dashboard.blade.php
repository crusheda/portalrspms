<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Beranda | RS PKU Muhammadiyah Sukoharjo')]
class extends Component {};

?>

<div class="rs-homepage">

    {{-- =========================================
         HERO
    ========================================== --}}
    <section class="rs-home-hero">

        <div class="rs-home-hero-overlay"></div>

        <div class="rs-container rs-home-hero-container">

            <div class="rs-home-hero-content">

                <div class="rs-home-eyebrow">
                    <span class="rs-home-eyebrow-dot"></span>
                    PORTAL RESMI RUMAH SAKIT
                </div>

                <h1>
                    Pelayanan Kesehatan
                    <span>Dengan Sepenuh Hati.</span>
                </h1>

                <p class="rs-home-hero-description">
                    RS PKU Muhammadiyah Sukoharjo hadir untuk memberikan
                    pelayanan kesehatan yang profesional, nyaman, dan
                    berlandaskan nilai-nilai Islami.
                </p>

                <div class="rs-home-hero-values">
                    <span>Amanah</span>
                    <span>Santun</span>
                    <span>Ramah</span>
                    <span>Ikhlas</span>
                </div>

                <div class="rs-home-hero-actions">

                    <a
                        href="{{ route('jadwal-dokter') }}"
                        wire:navigate
                        class="rs-home-button rs-home-button-primary"
                    >
                        <i class="bi bi-calendar2-week"></i>
                        <span>Jadwal Dokter</span>
                        <i class="bi bi-arrow-up-right"></i>
                    </a>

                    <a
                        href="https://wa.me/6285150763480"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="rs-home-button rs-home-button-light"
                    >
                        <i class="bi bi-whatsapp"></i>
                        <span>Hubungi Kami</span>
                    </a>

                </div>

                <div class="rs-home-hero-note">
                    <i class="bi bi-shield-check"></i>
                    <span>
                        Mengutamakan keselamatan, kenyamanan, dan mutu pelayanan.
                    </span>
                </div>

            </div>

        </div>

        <div class="rs-home-hero-bottom">
            <div class="rs-container">
                <div class="rs-home-hero-bottom-inner">
                    <span>RS PKU Muhammadiyah Sukoharjo</span>

                    <span class="rs-home-hero-bottom-divider"></span>

                    <span>Pelayanan Kesehatan Terpercaya</span>
                </div>
            </div>
        </div>

    </section>


    {{-- =========================================
         QUICK ACCESS
    ========================================== --}}
    <section class="rs-home-quick-section">

        <div class="rs-container">

            <div class="rs-home-quick-grid">

                <a
                    href="{{ route('jadwal-dokter') }}"
                    wire:navigate
                    class="rs-home-quick-card"
                >
                    <div class="rs-home-quick-icon">
                        <i class="bi bi-calendar2-week"></i>
                    </div>

                    <div class="rs-home-quick-content">
                        <h3>Jadwal Dokter</h3>
                        <p>Temukan jadwal praktik dokter spesialis.</p>
                    </div>

                    <i class="bi bi-arrow-up-right rs-home-quick-arrow"></i>
                </a>

                <a
                    href="{{ route('ketersediaan-tempat-tidur') }}"
                    wire:navigate
                    class="rs-home-quick-card"
                >
                    <div class="rs-home-quick-icon">
                        <i class="bi bi-hospital"></i>
                    </div>

                    <div class="rs-home-quick-content">
                        <h3>Tempat Tidur</h3>
                        <p>Lihat informasi ketersediaan tempat tidur.</p>
                    </div>

                    <i class="bi bi-arrow-up-right rs-home-quick-arrow"></i>
                </a>

                <a
                    href="https://wa.me/6285150763480"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="rs-home-quick-card"
                >
                    <div class="rs-home-quick-icon rs-home-quick-icon-whatsapp">
                        <i class="bi bi-whatsapp"></i>
                    </div>

                    <div class="rs-home-quick-content">
                        <h3>Informasi RS</h3>
                        <p>Hubungi petugas informasi melalui WhatsApp.</p>
                    </div>

                    <i class="bi bi-arrow-up-right rs-home-quick-arrow"></i>
                </a>

            </div>

        </div>

    </section>


    {{-- =========================================
         MITRA
    ========================================== --}}
    <section class="rs-home-partners">

        <div class="rs-container">

            <div class="rs-home-section-label">
                KEMITRAAN
            </div>

            <p class="rs-home-partners-description">
                Berkolaborasi untuk mendukung pelayanan kesehatan masyarakat.
            </p>

            <div class="rs-home-partners-grid">

                <div class="rs-home-partner">
                    <img src="{{ asset('img/mitra/bpjskes.jpg') }}" alt="BPJS Kesehatan" loading="lazy">
                </div>

                <div class="rs-home-partner">
                    <img src="{{ asset('img/mitra/bpjsnaker.jpg') }}" alt="BPJS Ketenagakerjaan" loading="lazy">
                </div>

                <div class="rs-home-partner">
                    <img src="{{ asset('img/mitra/taspen.png') }}" alt="Taspen" loading="lazy">
                </div>

                <div class="rs-home-partner">
                    <img src="{{ asset('img/mitra/brilife.jpg') }}" alt="BRI Life" loading="lazy">
                </div>

                <div class="rs-home-partner">
                    <img src="{{ asset('img/mitra/admedika.jpg') }}" alt="AdMedika" loading="lazy">
                </div>

                <div class="rs-home-partner">
                    <img src="{{ asset('img/mitra/alodokter.jpg') }}" alt="Alodokter" loading="lazy">
                </div>

            </div>

        </div>

    </section>


    {{-- =========================================
         KEUNGGULAN PELAYANAN
    ========================================== --}}
    <section class="rs-home-section rs-home-about">

        <div class="rs-container">

            <div class="rs-home-section-heading">

                <span class="rs-home-section-label">
                    MENGENAL KAMI
                </span>

                <h2>
                    Pelayanan yang berpusat
                    <span>pada kebutuhan Anda.</span>
                </h2>

                <p>
                    Kami berkomitmen memberikan pelayanan kesehatan yang
                    mengutamakan profesionalisme, kepedulian, dan kenyamanan
                    bagi setiap pasien serta keluarga.
                </p>

            </div>

            <div class="rs-home-feature-grid">

                <article class="rs-home-feature-card">

                    <div class="rs-home-feature-icon">
                        <i class="bi bi-heart-pulse"></i>
                    </div>

                    <h3>Pelayanan Terintegrasi</h3>

                    <p>
                        Koordinasi pelayanan kesehatan untuk mendukung
                        kebutuhan pasien secara menyeluruh.
                    </p>

                </article>

                <article class="rs-home-feature-card">

                    <div class="rs-home-feature-icon">
                        <i class="bi bi-person-check"></i>
                    </div>

                    <h3>Tenaga Profesional</h3>

                    <p>
                        Pelayanan oleh tenaga kesehatan sesuai bidang
                        kompetensi dan kebutuhan pasien.
                    </p>

                </article>

                <article class="rs-home-feature-card">

                    <div class="rs-home-feature-icon">
                        <i class="bi bi-stars"></i>
                    </div>

                    <h3>Nilai Islami</h3>

                    <p>
                        Menjunjung etika, kepedulian, dan nilai-nilai
                        Islami dalam memberikan pelayanan.
                    </p>

                </article>

                <article class="rs-home-feature-card">

                    <div class="rs-home-feature-icon">
                        <i class="bi bi-building-check"></i>
                    </div>

                    <h3>Fasilitas Pelayanan</h3>

                    <p>
                        Berbagai fasilitas kesehatan untuk mendukung
                        pemeriksaan, perawatan, dan pemulihan.
                    </p>

                </article>

                <article class="rs-home-feature-card">

                    <div class="rs-home-feature-icon">
                        <i class="bi bi-clipboard2-pulse"></i>
                    </div>

                    <h3>Mutu dan Keselamatan</h3>

                    <p>
                        Berorientasi pada keselamatan pasien dan
                        peningkatan kualitas pelayanan secara berkelanjutan.
                    </p>

                </article>

                <article class="rs-home-feature-card">

                    <div class="rs-home-feature-icon">
                        <i class="bi bi-lightbulb"></i>
                    </div>

                    <h3>Inovasi Pelayanan</h3>

                    <p>
                        Memanfaatkan pengembangan layanan dan teknologi
                        untuk membantu akses informasi kesehatan.
                    </p>

                </article>

            </div>

        </div>

    </section>


    {{-- =========================================
         IGD 24 JAM
    ========================================== --}}
    <section class="rs-home-emergency-section">

        <div class="rs-container">

            <div class="rs-home-emergency-card">

                <div class="rs-home-emergency-icon">
                    <i class="bi bi-heart-pulse-fill"></i>
                </div>

                <div class="rs-home-emergency-content">

                    <span class="rs-home-emergency-label">
                        PELAYANAN GAWAT DARURAT
                    </span>

                    <h2>
                        IGD <span>24 Jam</span>
                    </h2>

                    <p>
                        Rumah Sakit PKU Muhammadiyah Sukoharjo menyediakan
                        pelayanan gawat darurat untuk membantu menangani
                        kondisi yang membutuhkan pertolongan segera.
                    </p>

                </div>

                <div class="rs-home-emergency-action">

                    <a
                        href="tel:02715991165"
                        class="rs-home-button rs-home-button-emergency"
                    >
                        <i class="bi bi-telephone"></i>
                        <span>Telepon IGD</span>
                    </a>

                    <small>0271 599 1165</small>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================
         GALERI PELAYANAN
    ========================================== --}}
    <section class="rs-home-section rs-home-services">

        <div class="rs-container">

            <div class="rs-home-services-grid">

                <div class="rs-home-services-gallery">

                    <figure class="rs-home-gallery-main">
                        <img
                            src="{{ asset('img/pelayanan/poli2.jpg') }}"
                            alt="Fasilitas poliklinik"
                            loading="lazy"
                        >
                    </figure>

                    <figure class="rs-home-gallery-secondary">
                        <img
                            src="{{ asset('img/pelayanan/icu.jpg') }}"
                            alt="Fasilitas perawatan intensif"
                            loading="lazy"
                        >
                    </figure>

                    <figure class="rs-home-gallery-tertiary">
                        <img
                            src="{{ asset('img/pelayanan/lab2.jpg') }}"
                            alt="Fasilitas laboratorium"
                            loading="lazy"
                        >
                    </figure>

                </div>

                <div class="rs-home-services-content">

                    <span class="rs-home-section-label">
                        FASILITAS DAN PELAYANAN
                    </span>

                    <h2>
                        Mendampingi perjalanan
                        <span>kesehatan Anda.</span>
                    </h2>

                    <p>
                        Kami berupaya memberikan pelayanan kesehatan yang
                        tepat dan responsif sesuai kebutuhan pasien,
                        mulai dari pemeriksaan hingga perawatan lanjutan.
                    </p>

                    <div class="rs-home-service-list">

                        <div>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Pelayanan medis umum</span>
                        </div>

                        <div>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Poliklinik spesialis</span>
                        </div>

                        <div>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Pelayanan gawat darurat</span>
                        </div>

                        <div>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Rawat inap</span>
                        </div>

                        <div>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Laboratorium</span>
                        </div>

                        <div>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Radiologi</span>
                        </div>

                    </div>

                    <a
                        href="{{ route('profil-rs') }}"
                        wire:navigate
                        class="rs-home-text-link"
                    >
                        Mengenal Profil Rumah Sakit
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================
         POSTER KESEHATAN
    ========================================== --}}
    <section class="rs-home-section rs-home-posters">

        <div class="rs-container">

            <div class="rs-home-section-heading rs-home-section-heading-row">

                <div>
                    <span class="rs-home-section-label">
                        EDUKASI KESEHATAN
                    </span>

                    <h2>
                        Informasi untuk hidup
                        <span>lebih sehat.</span>
                    </h2>

                    <p>
                        Kenali informasi kesehatan melalui poster edukasi
                        yang dapat Anda lihat dan pelajari.
                    </p>
                </div>

            </div>

            <div class="rs-home-poster-grid">

                @for ($i = 1; $i <= 7; $i++)

                    <a
                        href="{{ asset('img/eposter/' . $i . '.jpg') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="rs-home-poster-card"
                    >

                        <img
                            src="{{ asset('img/eposter/' . $i . '.jpg') }}"
                            alt="Poster edukasi kesehatan {{ $i }}"
                            loading="lazy"
                        >

                        <div class="rs-home-poster-overlay">
                            <span>
                                <i class="bi bi-arrows-fullscreen"></i>
                                Lihat poster
                            </span>
                        </div>

                    </a>

                @endfor

            </div>

        </div>

    </section>


    {{-- =========================================
         SURVEI KEPUASAN PASIEN
    ========================================== --}}
    <section class="rs-home-section rs-home-survey">

        <div class="rs-container">

            <div class="rs-home-survey-grid">

                <div class="rs-home-survey-content">

                    <span class="rs-home-section-label">
                        SUARA ANDA BERARTI
                    </span>

                    <h2>
                        Bersama meningkatkan
                        <span>mutu pelayanan.</span>
                    </h2>

                    <p>
                        Masukan pasien dan keluarga merupakan bagian penting
                        dalam upaya evaluasi dan peningkatan kualitas
                        pelayanan RS PKU Muhammadiyah Sukoharjo.
                    </p>

                    <p>
                        Silakan pilih survei yang sesuai dengan jenis
                        pelayanan yang telah Anda terima.
                    </p>

                </div>

                <div class="rs-home-survey-cards">

                    <a
                        href="https://docs.google.com/forms/d/1hKArXARDS7jfGFZxbMwavjpeJxEMkVNMS-2l_9RO_Zw/viewform?edit_requested=true"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="rs-home-survey-card"
                    >
                        <div class="rs-home-survey-icon">
                            <i class="bi bi-house-heart"></i>
                        </div>

                        <div>
                            <h3>Rawat Inap</h3>
                            <p>Berikan penilaian pengalaman perawatan Anda.</p>
                        </div>

                        <i class="bi bi-arrow-up-right rs-home-survey-arrow"></i>
                    </a>

                    <a
                        href="https://forms.gle/mgJRxp47kSUe4Zrv6"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="rs-home-survey-card"
                    >
                        <div class="rs-home-survey-icon">
                            <i class="bi bi-person-lines-fill"></i>
                        </div>

                        <div>
                            <h3>Rawat Jalan</h3>
                            <p>Sampaikan pengalaman pelayanan poliklinik.</p>
                        </div>

                        <i class="bi bi-arrow-up-right rs-home-survey-arrow"></i>
                    </a>

                    <a
                        href="https://docs.google.com/forms/d/e/1FAIpQLSeu8DE1oejKo5kbaoboyp6fvjPpTbxUY0DzXNSVrZ1wXSWDww/viewform?usp=sharing&ouid=109848120941164858349"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="rs-home-survey-card"
                    >
                        <div class="rs-home-survey-icon">
                            <i class="bi bi-activity"></i>
                        </div>

                        <div>
                            <h3>Gawat Darurat</h3>
                            <p>Berikan masukan untuk pelayanan IGD.</p>
                        </div>

                        <i class="bi bi-arrow-up-right rs-home-survey-arrow"></i>
                    </a>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================
         MOTTO
    ========================================== --}}
    <section class="rs-home-motto">

        <div class="rs-container">

            <div class="rs-home-motto-card">

                <div class="rs-home-motto-icon">
                    <i class="bi bi-heart-fill"></i>
                </div>

                <span class="rs-home-section-label">
                    MOTTO KAMI
                </span>

                <blockquote>
                    “Kesembuhan Datangnya dari Allah,
                    <br>
                    Kepuasan Anda adalah Tanggung Jawab Kami.”
                </blockquote>

                <div class="rs-home-motto-values">
                    <span>Amanah</span>
                    <span>Santun</span>
                    <span>Ramah</span>
                    <span>Ikhlas</span>
                </div>

            </div>

        </div>

    </section>

</div>
