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
    <section
        class="rs-home-hero"
        style="--rs-home-hero-bg: url('{{ asset('img/pku/gedung/drone-pku.jpg') }}')"
    >
        <div class="rs-home-hero-overlay"></div>

        <div class="rs-container rs-home-hero-container">

            <div class="rs-home-hero-content">

                <div class="rs-home-eyebrow">
                    <span class="rs-home-eyebrow-dot"></span>
                    PORTAL RESMI
                </div>

                <h1>
                    Rumah Sakit
                    <span>PKU Muhammadiyah</span>
                    Sukoharjo
                </h1>

                <p class="rs-home-hero-description">
                    Memberikan pelayanan kesehatan yang profesional, nyaman,
                    dan berlandaskan nilai-nilai Islami.
                </p>

                <div class="rs-home-hero-values">
                    <span>Amanah</span>
                    <span>Santun</span>
                    <span>Ramah</span>
                    <span>Ikhlas</span>
                </div>

                <div class="rs-home-hero-actions">

                    {{-- Baris Pertama: Jadwal Dokter dan Hubungi Kami --}}
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

                    {{-- Radio Muhammadiyah --}}
                    <button
                        type="button"
                        class="rs-home-button rs-home-button-radio rs-home-button-radio-small"
                        data-radio-open
                        aria-label="Putar Radio Muhammadiyah"
                        title="Radio Muhammadiyah"
                    >
                        <i class="bi bi-play-circle rs-radio-play-icon"></i>

                        <span class="rs-radio-button-text">
                            <i class="bi bi-broadcast-pin"></i>
                            Radio Muhammadiyah
                        </span>
                    </button>

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
                Berkolaborasi dengan berbagai mitra untuk mendukung pelayanan
                kesehatan yang berkualitas bagi masyarakat.
            </p>

            <div class="rs-home-partners-track-wrapper">
                <div class="rs-home-partners-track">

                    @php
                        $mitra = [
                            ['file' => 'bpjskes.jpg', 'nama' => 'BPJS Kesehatan', 'width' => 120],
                            ['file' => 'bpjsnaker.jpg', 'nama' => 'BPJS Ketenagakerjaan', 'width' => 120],
                            ['file' => 'taspen.png', 'nama' => 'Taspen', 'width' => 100],
                            ['file' => 'brilife.jpg', 'nama' => 'BRI Life', 'width' => 100],
                            ['file' => 'admedika.jpg', 'nama' => 'AdMedika', 'width' => 100],
                            ['file' => 'alodokter.jpg', 'nama' => 'Alodokter', 'width' => 100],
                            ['file' => 'arah.jpg', 'nama' => 'ARAH', 'width' => 100],
                            ['file' => 'kkp.jpg', 'nama' => 'KKP', 'width' => 90],
                            ['file' => 'bjs.jpg', 'nama' => 'BJS', 'width' => 100],
                            ['file' => 'iforte.jpg', 'nama' => 'iForte', 'width' => 100],
                            ['file' => 'indihome.jpg', 'nama' => 'IndiHome', 'width' => 100],
                            ['file' => 'jr.jpg', 'nama' => 'Jasa Raharja', 'width' => 100],
                            ['file' => 'lazismu.jpg', 'nama' => 'Lazismu', 'width' => 100],
                            ['file' => 'mdmc.jpg', 'nama' => 'MDMC', 'width' => 100],
                            ['file' => 'pmi.jpg', 'nama' => 'PMI', 'width' => 100],
                            ['file' => 'pos.jpg', 'nama' => 'Pos Indonesia', 'width' => 100],
                            ['file' => 'suryamedika.jpg', 'nama' => 'Surya Medika', 'width' => 120],
                            ['file' => 'telkom.jpg', 'nama' => 'Telkom', 'width' => 100],
                            ['file' => 'tirtamakmur.jpg', 'nama' => 'Tirta Makmur', 'width' => 80],
                            ['file' => 'kai.png', 'nama' => 'Kereta Api Indonesia', 'width' => 60],
                        ];
                    @endphp

                    {{-- Daftar pertama --}}
                    @foreach ($mitra as $item)
                        <div class="rs-home-partner">
                            <img
                                src="{{ asset('img/mitra/' . $item['file']) }}"
                                alt="{{ $item['nama'] }}"
                                width="{{ $item['width'] }}"
                                loading="lazy"
                            >
                        </div>
                    @endforeach

                    {{-- Duplikasi untuk membuat animasi berulang tanpa jeda --}}
                    @foreach ($mitra as $item)
                        <div class="rs-home-partner" aria-hidden="true">
                            <img
                                src="{{ asset('img/mitra/' . $item['file']) }}"
                                alt=""
                                width="{{ $item['width'] }}"
                                loading="lazy"
                            >
                        </div>
                    @endforeach

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

                    {{-- <small>0271 599 1165</small> --}}

                </div>

            </div>

        </div>

    </section>

    {{-- =========================================
        FASILITAS DAN PELAYANAN
    ========================================== --}}
    <section class="rs-home-section rs-home-services">

        <div class="rs-container">

            {{-- BAGIAN 1: KOMITMEN PELAYANAN --}}
            <div class="rs-service-feature">

                <div class="rs-service-feature-gallery">
                    <div class="rs-service-photo rs-service-photo-main">
                        <img
                            src="{{ asset('img/pelayanan/poli2.jpg') }}"
                            alt="Fasilitas poliklinik RS PKU Muhammadiyah Sukoharjo"
                            loading="lazy"
                        >
                        <span class="rs-service-photo-caption">
                            <i class="bi bi-heart-pulse"></i>
                            Pelayanan Poliklinik
                        </span>
                    </div>

                    <div class="rs-service-photo rs-service-photo-secondary">
                        <img
                            src="{{ asset('img/pelayanan/poli4.jpg') }}"
                            alt="Ruang pelayanan poliklinik"
                            loading="lazy"
                        >
                    </div>

                    <div class="rs-service-photo rs-service-photo-tertiary">
                        <img
                            src="{{ asset('img/pelayanan/icu.jpg') }}"
                            alt="Fasilitas perawatan intensif"
                            loading="lazy"
                        >
                    </div>

                    <div class="rs-service-gallery-decoration" aria-hidden="true">
                        <i class="bi bi-plus-lg"></i>
                    </div>
                </div>

                <div class="rs-service-feature-content">

                    <span class="rs-home-section-label">
                        <i class="bi bi-heart-pulse"></i>
                        KOMITMEN PELAYANAN
                    </span>

                    <h2>
                        Hadir untuk kesehatan,
                        <span>peduli sepenuh hati.</span>
                    </h2>

                    <p>
                        RS PKU Muhammadiyah Sukoharjo berupaya memberikan
                        pelayanan kesehatan yang profesional, ramah, dan
                        responsif sesuai kebutuhan pasien. Kami berkomitmen
                        mendampingi setiap langkah menuju kesehatan yang lebih baik.
                    </p>

                    <div class="rs-service-benefits">

                        <div class="rs-service-benefit">
                            <span class="rs-service-benefit-icon">
                                <i class="bi bi-shield-check"></i>
                            </span>
                            <div>
                                <h3>Pelayanan Profesional</h3>
                                <p>Didukung tenaga medis dan tenaga kesehatan yang kompeten.</p>
                            </div>
                        </div>

                        <div class="rs-service-benefit">
                            <span class="rs-service-benefit-icon">
                                <i class="bi bi-people"></i>
                            </span>
                            <div>
                                <h3>Ramah dan Peduli</h3>
                                <p>Mengutamakan sikap santun, kepedulian, dan kenyamanan pasien.</p>
                            </div>
                        </div>

                        <div class="rs-service-benefit">
                            <span class="rs-service-benefit-icon">
                                <i class="bi bi-heart"></i>
                            </span>
                            <div>
                                <h3>Pelayanan Menyeluruh</h3>
                                <p>Mendukung kebutuhan kesehatan mulai dari pemeriksaan hingga perawatan.</p>
                            </div>
                        </div>

                        <div class="rs-service-benefit">
                            <span class="rs-service-benefit-icon">
                                <i class="bi bi-credit-card-2-front"></i>
                            </span>
                            <div>
                                <h3>Layanan BPJS</h3>
                                <p>Melayani pasien BPJS sesuai ketentuan dan prosedur yang berlaku.</p>
                            </div>
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


            {{-- BAGIAN 2: FASILITAS RAWAT INAP --}}
            <div class="rs-service-feature rs-service-feature-inpatient">

                <div class="rs-service-feature-gallery rs-service-inpatient-gallery">

                    <div class="rs-service-photo rs-service-inpatient-photo-one">
                        <img
                            src="{{ asset('img/pelayanan/ranapkls3_2.jpg') }}"
                            alt="Fasilitas kamar rawat inap"
                            loading="lazy"
                        >
                    </div>

                    <div class="rs-service-photo rs-service-inpatient-photo-two">
                        <img
                            src="{{ asset('img/pelayanan/ranapvip.jpg') }}"
                            alt="Fasilitas kamar rawat inap VIP"
                            loading="lazy"
                        >
                    </div>

                    <div class="rs-service-photo rs-service-inpatient-photo-three">
                        <img
                            src="{{ asset('img/pelayanan/ranapkls3.jpg') }}"
                            alt="Ruang perawatan pasien"
                            loading="lazy"
                        >
                    </div>

                    <div class="rs-service-photo rs-service-inpatient-photo-four">
                        <img
                            src="{{ asset('img/pelayanan/ranapkls1_2.jpg') }}"
                            alt="Fasilitas ruang rawat inap"
                            loading="lazy"
                        >
                    </div>

                    <div class="rs-service-gallery-note">
                        <span class="rs-service-gallery-note-icon">
                            <i class="bi bi-house-heart"></i>
                        </span>
                        <div>
                            <strong>Nyaman untuk Pemulihan</strong>
                            <span>Lingkungan perawatan yang mendukung proses penyembuhan.</span>
                        </div>
                    </div>

                </div>

                <div class="rs-service-feature-content">

                    <span class="rs-home-section-label">
                        <i class="bi bi-hospital"></i>
                        FASILITAS RAWAT INAP
                    </span>

                    <h2>
                        Ruang perawatan yang
                        <span>mendukung pemulihan.</span>
                    </h2>

                    <p>
                        Kami berupaya menghadirkan lingkungan perawatan yang
                        bersih, nyaman, dan mendukung kebutuhan pasien selama
                        menjalani perawatan. Pilihan ruang perawatan disesuaikan
                        dengan ketersediaan fasilitas dan ketentuan yang berlaku.
                    </p>

                    <div class="rs-service-ward-list">

                        <div class="rs-service-ward-item">
                            <span><i class="bi bi-check2"></i></span>
                            <div>
                                <strong>Bangsal Kebidanan</strong>
                                <small>Perawatan terkait kesehatan ibu.</small>
                            </div>
                        </div>

                        <div class="rs-service-ward-item">
                            <span><i class="bi bi-check2"></i></span>
                            <div>
                                <strong>Bangsal Anak</strong>
                                <small>Perawatan bagi pasien anak.</small>
                            </div>
                        </div>

                        <div class="rs-service-ward-item">
                            <span><i class="bi bi-check2"></i></span>
                            <div>
                                <strong>Bangsal Dewasa</strong>
                                <small>Fasilitas perawatan pasien dewasa.</small>
                            </div>
                        </div>

                        <div class="rs-service-ward-item">
                            <span><i class="bi bi-check2"></i></span>
                            <div>
                                <strong>Ruang Isolasi</strong>
                                <small>Ruang perawatan sesuai indikasi medis.</small>
                            </div>
                        </div>

                    </div>

                    <a
                        href="{{ route('ketersediaan-tempat-tidur') }}"
                        wire:navigate
                        class="rs-home-text-link"
                    >
                        Lihat Ketersediaan Tempat Tidur
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            </div>


            {{-- BAGIAN 3: BERBAGAI LAYANAN KESEHATAN --}}
            <div class="rs-service-feature rs-service-feature-last">

                <div class="rs-service-feature-gallery rs-service-medical-gallery">

                    <div class="rs-service-photo rs-service-medical-photo-main">
                        <img
                            src="{{ asset('img/pelayanan/lab2.jpg') }}"
                            alt="Fasilitas laboratorium"
                            loading="lazy"
                        >
                        <span class="rs-service-photo-caption">
                            <i class="bi bi-eyedropper"></i>
                            Laboratorium
                        </span>
                    </div>

                    <div class="rs-service-photo rs-service-medical-photo-secondary">
                        <img
                            src="{{ asset('img/pelayanan/poli33.jpg') }}"
                            alt="Fasilitas pelayanan medis"
                            loading="lazy"
                        >
                    </div>

                    <div class="rs-service-photo rs-service-medical-photo-tertiary">
                        <img
                            src="{{ asset('img/pelayanan/radiologi.jpg') }}"
                            alt="Fasilitas radiologi"
                            loading="lazy"
                        >
                    </div>

                    <div class="rs-service-medical-badge">
                        <i class="bi bi-clipboard2-pulse"></i>
                        <span>
                            <strong>Terintegrasi</strong>
                            <small>Beragam kebutuhan pelayanan medis</small>
                        </span>
                    </div>

                </div>

                <div class="rs-service-feature-content">

                    <span class="rs-home-section-label">
                        <i class="bi bi-activity"></i>
                        LAYANAN KESEHATAN
                    </span>

                    <h2>
                        Berbagai layanan untuk
                        <span>kebutuhan kesehatan Anda.</span>
                    </h2>

                    <p>
                        Dari pemeriksaan kesehatan hingga tindakan medis,
                        berbagai layanan disediakan untuk mendukung kebutuhan
                        pasien. Setiap pelayanan diberikan sesuai indikasi medis,
                        kebutuhan pasien, dan fasilitas yang tersedia.
                    </p>

                    <div class="rs-service-catalog">

                        <div class="rs-service-catalog-item">
                            <span><i class="bi bi-person-heart"></i></span>
                            <div>
                                <strong>Pelayanan Medis Umum</strong>
                                <small>Pemeriksaan dan konsultasi kesehatan.</small>
                            </div>
                        </div>

                        <div class="rs-service-catalog-item">
                            <span><i class="bi bi-person-badge"></i></span>
                            <div>
                                <strong>Poliklinik Spesialis</strong>
                                <small>Pelayanan sesuai bidang spesialisasi medis.</small>
                            </div>
                        </div>

                        <div class="rs-service-catalog-item">
                            <span><i class="bi bi-droplet-half"></i></span>
                            <div>
                                <strong>Laboratorium</strong>
                                <small>Pemeriksaan penunjang untuk kebutuhan medis.</small>
                            </div>
                        </div>

                        <div class="rs-service-catalog-item">
                            <span><i class="bi bi-radioactive"></i></span>
                            <div>
                                <strong>Radiologi</strong>
                                <small>Pemeriksaan penunjang melalui pencitraan medis.</small>
                            </div>
                        </div>

                        <div class="rs-service-catalog-item">
                            <span><i class="bi bi-hospital"></i></span>
                            <div>
                                <strong>Rawat Inap dan Intensif</strong>
                                <small>Perawatan sesuai kondisi dan kebutuhan pasien.</small>
                            </div>
                        </div>

                        <div class="rs-service-catalog-item">
                            <span><i class="bi bi-activity"></i></span>
                            <div>
                                <strong>Gawat Darurat (IGD)</strong>
                                <small>Penanganan awal kondisi kegawatdaruratan.</small>
                            </div>
                        </div>

                        <div class="rs-service-catalog-item">
                            <span><i class="bi bi-heart-pulse"></i></span>
                            <div>
                                <strong>Kamar Operasi dan Bedah</strong>
                                <small>Tindakan operasi sesuai indikasi medis.</small>
                            </div>
                        </div>

                    </div>

                    <a
                        href="{{ route('profil-rs') }}"
                        wire:navigate
                        class="rs-home-text-link"
                    >
                        Jelajahi Profil dan Layanan Kami
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            </div>

        </div>

    </section>

    {{-- =========================================
        VIDEO PROFIL RUMAH SAKIT
    ========================================== --}}
    <section class="rs-home-section rs-home-video">

        <div class="rs-container">

            <div class="rs-home-video-heading">
                <span class="rs-home-section-label">
                    <i class="bi bi-play-circle"></i>
                    VIDEO PROFIL RS
                </span>

                <h2>
                    Mengenal lebih dekat
                    <span>rumah sakit kami.</span>
                </h2>

                <p>
                    Kenali lingkungan, fasilitas, dan komitmen pelayanan
                    RS PKU Muhammadiyah Sukoharjo melalui video profil rumah sakit kami.
                </p>
            </div>

            <div class="rs-home-video-preview">

                <img
                    src="{{ asset('media/thumbnail.jpg') }}"
                    alt="Video profil RS PKU Muhammadiyah Sukoharjo"
                    loading="lazy"
                >

                <div class="rs-home-video-overlay"></div>

                <div class="rs-home-video-preview-content">
                    <span class="rs-home-video-tag">
                        <i class="bi bi-hospital"></i>
                        RS PKU Muhammadiyah Sukoharjo
                    </span>

                    <h3>
                        Melayani dengan sepenuh hati,
                        untuk kesehatan yang lebih baik.
                    </h3>

                    <button
                        type="button"
                        class="rs-home-video-play"
                        data-bs-toggle="modal"
                        data-bs-target="#rsProfileVideoModal"
                        aria-label="Putar video profil rumah sakit"
                    >
                        <span class="rs-home-video-play-icon">
                            <i class="bi bi-play-fill"></i>
                        </span>
                        <span>Putar Video Profil RS</span>
                    </button>
                </div>

                <span class="rs-home-video-corner-icon" aria-hidden="true">
                    <i class="bi bi-play-circle"></i>
                </span>

            </div>

        </div>

    </section>


    {{-- MODAL VIDEO PROFIL --}}
    <div
        class="modal fade rs-profile-video-modal"
        id="rsProfileVideoModal"
        tabindex="-1"
        aria-labelledby="rsProfileVideoModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <div>
                        <span class="rs-profile-video-modal-label">
                            VIDEO PROFIL
                        </span>

                        <h5 class="modal-title" id="rsProfileVideoModalLabel">
                            RS PKU Muhammadiyah Sukoharjo
                        </h5>
                    </div>

                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Tutup video"
                    ></button>
                </div>

                <div class="modal-body">
                    <video
                        id="rsProfileVideo"
                        class="rs-profile-video-player"
                        controls
                        playsinline
                        preload="none"
                        poster="{{ asset('media/thumbnail.jpg') }}"
                    >
                        <source
                            src="{{ asset('media/profil.mp4') }}"
                            type="video/mp4"
                        >

                        Browser Anda tidak mendukung pemutaran video.
                    </video>
                </div>

            </div>
        </div>
    </div>

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
                        SUARA ANDA SANGAT BERARTI BAGI KAMI
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
                            <p>Berikan penilaian pengalaman perawatan Inap Anda.</p>
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
                            <p>Sampaikan pengalaman pelayanan Poliklinik.</p>
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
