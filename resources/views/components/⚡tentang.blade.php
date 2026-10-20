<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Tentang Kami | RS PKU Muhammadiyah Sukoharjo')]
class extends Component
{
    //
};

?>

<div class="rs-tentang-page">

    {{-- HERO --}}
    <section class="rs-tentang-hero">
        <div class="rs-container">
            <div class="rs-tentang-hero-content">
                <span class="rs-tentang-badge">
                    <i class="bi bi-heart-pulse"></i>
                    Tentang Kami
                </span>

                <h1>
                    Melayani dengan
                    <span>Sepenuh Hati</span>
                </h1>

                <p>
                    RS PKU Muhammadiyah Sukoharjo berkomitmen memberikan
                    pelayanan kesehatan yang profesional, humanis,
                    dan berlandaskan nilai-nilai Islami.
                </p>

                <div class="rs-tentang-hero-actions">
                    <a href="#lokasi-rumah-sakit" class="rs-tentang-btn-primary">
                        <i class="bi bi-geo-alt"></i>
                        Lokasi Rumah Sakit
                    </a>

                    <a href="#kontak-unit" class="rs-tentang-btn-outline">
                        <i class="bi bi-headset"></i>
                        Hubungi Kami
                    </a>
                </div>
            </div>

            <div class="rs-tentang-hero-decoration">
                <div class="rs-tentang-decoration-circle circle-one"></div>
                <div class="rs-tentang-decoration-circle circle-two"></div>

                <div class="rs-tentang-hero-icon">
                    <i class="bi bi-hospital"></i>
                </div>

                <div class="rs-tentang-floating-card">
                    <div class="rs-tentang-floating-icon">
                        <i class="bi bi-heart-pulse"></i>
                    </div>

                    <div>
                        <strong>A . S . R . I</strong>
                        <span>Amanah, Santun, Ramah, Ikhlas</span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- NILAI PELAYANAN --}}
    <section class="rs-section">
        <div class="rs-container">
            <div class="rs-about-grid">

                <div class="rs-about-visual rs-tentang-visual">
                    <div class="rs-tentang-visual-inner">
                        <div class="rs-tentang-visual-icon">
                            <i class="bi bi-heart-pulse"></i>
                        </div>

                        <strong>
                            Kesembuhan Datangnya dari Allah,
                            Kepuasan Anda adalah tanggungjawab kami.
                        </strong>

                        <div class="rs-tentang-visual-decoration">
                            <i class="bi bi-plus-lg"></i>
                            <i class="bi bi-plus-lg"></i>
                            <i class="bi bi-plus-lg"></i>
                        </div>
                    </div>
                </div>

                <div class="rs-about-content">
                    <div class="rs-section-label">
                        Nilai Pelayanan
                    </div>

                    <h2>Pelayanan yang Mengutamakan Pasien</h2>

                    <p>
                        Pelayanan kesehatan yang baik tidak hanya
                        mengutamakan tindakan medis, tetapi juga
                        komunikasi, kepedulian, keselamatan,
                        dan kenyamanan pasien.
                    </p>

                    <p>
                        RS PKU Muhammadiyah Sukoharjo berupaya memberikan
                        pelayanan yang mengedepankan profesionalisme,
                        keramahan, serta nilai-nilai Islami dalam setiap
                        interaksi dengan pasien dan keluarga.
                    </p>

                    <p>
                        Melalui portal ini, masyarakat dapat memperoleh
                        informasi mengenai rumah sakit, lokasi, layanan,
                        dan kontak dengan lebih mudah.
                    </p>

                    <div class="rs-tentang-highlight">
                        <div class="rs-tentang-highlight-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>

                        <div>
                            <strong>Komitmen Pelayanan ASRI</strong>

                            <p>
                                Amanah, Santun, Ramah, dan Ikhlas
                                sebagai nilai dalam memberikan pelayanan.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- NILAI ASRI --}}
    <section class="rs-section rs-section-soft">
        <div class="rs-container">

            <div class="rs-section-heading">
                <div class="rs-section-label">
                    Nilai Kami
                </div>

                <h2>ASRI dalam Pelayanan</h2>

                <p>
                    Nilai yang menjadi landasan pendekatan pelayanan
                    rumah sakit kepada pasien dan masyarakat.
                </p>
            </div>

            <div class="row g-4">

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="rs-card rs-tentang-value-card">
                        <div class="rs-card-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>

                        <h3>Amanah</h3>

                        <p>
                            Menjaga kepercayaan dalam memberikan
                            pelayanan kepada pasien.
                        </p>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="rs-card rs-tentang-value-card">
                        <div class="rs-card-icon">
                            <i class="bi bi-chat-heart"></i>
                        </div>

                        <h3>Santun</h3>

                        <p>
                            Mengutamakan komunikasi yang baik
                            dan menghormati setiap pasien.
                        </p>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="rs-card rs-tentang-value-card">
                        <div class="rs-card-icon">
                            <i class="bi bi-emoji-smile"></i>
                        </div>

                        <h3>Ramah</h3>

                        <p>
                            Memberikan pengalaman pelayanan yang
                            bersahabat dan penuh kepedulian.
                        </p>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="rs-card rs-tentang-value-card">
                        <div class="rs-card-icon">
                            <i class="bi bi-heart"></i>
                        </div>

                        <h3>Ikhlas</h3>

                        <p>
                            Melayani dengan ketulusan dan
                            mengutamakan kemaslahatan pasien.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- LOKASI RUMAH SAKIT --}}
    <section class="rs-section" id="lokasi-rumah-sakit">
        <div class="rs-container">

            <div class="rs-section-heading">
                <div class="rs-section-label">
                    Temukan Kami
                </div>

                <h2>Lokasi Rumah Sakit</h2>

                <p>
                    Kunjungi RS PKU Muhammadiyah Sukoharjo. <br>
                    Gunakan peta untuk melihat lokasi dan mendapatkan
                    petunjuk arah menuju rumah sakit.
                </p>
            </div>

            <div class="rs-tentang-location-layout">

                {{-- GOOGLE MAPS --}}
                <div class="rs-tentang-map-card">
                    <div class="rs-tentang-map-header">
                        <div class="rs-tentang-map-header-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>

                        <div>
                            <strong>RS PKU Muhammadiyah Sukoharjo</strong>
                            <span>Lokasi rumah sakit di Google Maps</span>
                        </div>

                        <span class="rs-tentang-map-live">
                            <span></span>
                            Maps
                        </span>
                    </div>

                    <div class="rs-tentang-map-frame">
                        <iframe
                            src="https://maps.google.com/maps?q=RS%20PKU%20Muhammadiyah%20Sukoharjo%2C%20Jl.%20Mayor%20Sunaryo%20No.%2037%2C%20Gawanan%2C%20Sukoharjo&t=&z=16&ie=UTF8&iwloc=&output=embed"
                            title="Lokasi RS PKU Muhammadiyah Sukoharjo di Google Maps"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            allowfullscreen>
                        </iframe>
                    </div>

                    <div class="rs-tentang-map-footer">
                        <div class="rs-tentang-map-footer-info">
                            <i class="bi bi-info-circle"></i>

                            <span>
                                Peta disediakan oleh Google Maps.
                            </span>
                        </div>

                        <a
                            href="https://www.google.com/maps/search/?api=1&query=RS+PKU+Muhammadiyah+Sukoharjo+Jl.+Mayor+Sunaryo+No.+37"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="rs-tentang-directions-btn">

                            <i class="bi bi-sign-turn-right"></i>
                            Petunjuk Arah
                            <i class="bi bi-arrow-up-right"></i>
                        </a>
                    </div>
                </div>


                {{-- INFORMASI ALAMAT --}}
                <div class="rs-tentang-location-info">

                    <div class="rs-tentang-location-card">
                        <div class="rs-tentang-contact-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>

                        <div>
                            <span class="rs-tentang-info-label">
                                Alamat Rumah Sakit
                            </span>

                            <h3>RS PKU Muhammadiyah Sukoharjo</h3>

                            <p>
                                Jl. Mayor Sunaryo No. 37,
                                Gawanan, Kabupaten Sukoharjo,
                                Jawa Tengah 57512.
                            </p>

                            <a
                                href="https://www.google.com/maps/search/?api=1&query=RS+PKU+Muhammadiyah+Sukoharjo"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="rs-tentang-text-link">

                                Lihat di Google Maps
                                <i class="bi bi-arrow-up-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="rs-tentang-location-card">
                        <div class="rs-tentang-contact-icon">
                            <i class="bi bi-telephone"></i>
                        </div>

                        <div>
                            <span class="rs-tentang-info-label">
                                Telepon IGD
                            </span>

                            <h3>0271 599 1165</h3>

                            <p>
                                Layanan Instalasi Gawat Darurat
                                tersedia 24 jam.
                            </p>

                            <a
                                href="tel:+622715991165"
                                class="rs-tentang-text-link">

                                Hubungi IGD
                                <i class="bi bi-arrow-up-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="rs-tentang-location-card">
                        <div class="rs-tentang-contact-icon">
                            <i class="bi bi-whatsapp"></i>
                        </div>

                        <div>
                            <span class="rs-tentang-info-label">
                                WhatsApp Informasi RS
                            </span>

                            <h3>0851-5076-3480</h3>

                            <p>
                                Untuk pertanyaan dan informasi umum
                                pada jam kerja kantor.
                            </p>

                            <a
                                href="https://wa.me/6285150763480"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="rs-tentang-text-link">

                                Chat WhatsApp
                                <i class="bi bi-arrow-up-right"></i>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>


    {{-- KONTAK UNIT RUMAH SAKIT --}}
    <section class="rs-section rs-section-soft" id="kontak-unit">
        <div class="rs-container">

            <div class="rs-section-heading">
                <div class="rs-section-label">
                    Pusat Informasi
                </div>

                <h2>Hubungi Kami</h2>

                <p>
                    Butuh informasi lebih lanjut? Silakan menghubungi bagian terkait.
                </p>
            </div>


            {{-- KONTAK UTAMA --}}
            <div class="rs-tentang-main-contact">

                <div class="rs-tentang-main-contact-icon">
                    <i class="bi bi-headset"></i>
                </div>

                <div class="rs-tentang-main-contact-content">

                    <h3>Bagian Informasi Rumah Sakit</h3>

                    <p>
                        Pusat informasi umum mengenai rumah sakit,
                        layanan, jadwal dokter, dan kebutuhan pengunjung.
                    </p>

                    <div class="rs-tentang-main-contact-actions">

                        <a
                            href="tel:+62271593979"
                            class="rs-tentang-contact-action">

                            <i class="bi bi-telephone-fill"></i>
                            0271 593 979
                        </a>

                        <a
                            href="https://wa.me/6285150763480"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="rs-tentang-contact-action rs-tentang-contact-action-whatsapp">

                            <i class="bi bi-whatsapp"></i>
                            0851-5076-3480
                        </a>

                    </div>

                    <small>
                        Telepon dan WhatsApp Bagian Informasi:
                        jam kerja kantor.
                    </small>
                </div>

                <div class="rs-tentang-main-contact-decoration">
                    <i class="bi bi-chat-dots"></i>
                </div>

            </div>


            {{-- DAFTAR UNIT --}}
            <div class="rs-tentang-unit-grid" hidden>

                {{-- INFORMASI --}}
                <article class="rs-tentang-unit-card">
                    <div class="rs-tentang-unit-top">
                        <div class="rs-tentang-unit-icon">
                            <i class="bi bi-info-circle"></i>
                        </div>

                        <span class="rs-tentang-unit-badge">
                            Kontak tersedia
                        </span>
                    </div>

                    <h3>Bagian Informasi RS</h3>

                    <p>
                        Membantu pengunjung mendapatkan informasi
                        umum mengenai layanan rumah sakit, jadwal dokter,
                        serta mengarahkan pertanyaan ke unit terkait.
                    </p>

                    <div class="rs-tentang-unit-contact">
                        <i class="bi bi-telephone"></i>

                        <a href="tel:+62271593979">
                            0271 593 979
                        </a>
                    </div>

                    <div class="rs-tentang-unit-contact">
                        <i class="bi bi-whatsapp"></i>

                        <a
                            href="https://wa.me/6285150763480"
                            target="_blank"
                            rel="noopener noreferrer">

                            0851-5076-3480
                        </a>
                    </div>

                    <span class="rs-tentang-unit-note">
                        Jam kerja kantor
                    </span>
                </article>


                {{-- IGD --}}
                <article class="rs-tentang-unit-card">
                    <div class="rs-tentang-unit-top">
                        <div class="rs-tentang-unit-icon rs-unit-icon-emergency">
                            <i class="bi bi-heart-pulse"></i>
                        </div>

                        <span class="rs-tentang-unit-badge rs-badge-emergency">
                            24 jam
                        </span>
                    </div>

                    <h3>Instalasi Gawat Darurat (IGD)</h3>

                    <p>
                        Layanan kegawatdaruratan medis untuk pasien
                        yang membutuhkan pemeriksaan dan penanganan
                        segera.
                    </p>

                    <div class="rs-tentang-unit-contact">
                        <i class="bi bi-telephone"></i>

                        <a href="tel:+622715991165">
                            0271 599 1165
                        </a>
                    </div>

                    <span class="rs-tentang-unit-note">
                        Telepon IGD 24 jam
                    </span>
                </article>


                {{-- HUMAS --}}
                <article class="rs-tentang-unit-card">
                    <div class="rs-tentang-unit-top">
                        <div class="rs-tentang-unit-icon">
                            <i class="bi bi-megaphone"></i>
                        </div>

                        <span class="rs-tentang-unit-badge">
                            Melalui Informasi RS
                        </span>
                    </div>

                    <h3>Bagian Humas RS</h3>

                    <p>
                        Untuk pertanyaan mengenai publikasi, hubungan
                        media, dokumentasi kegiatan, kerja sama,
                        dan informasi kelembagaan rumah sakit.
                    </p>

                    <div class="rs-tentang-unit-contact">
                        <i class="bi bi-headset"></i>

                        <a href="tel:+62271593979">
                            Hubungi Informasi RS
                        </a>
                    </div>

                    <span class="rs-tentang-unit-note">
                        Minta diarahkan ke Bagian Humas
                    </span>
                </article>


                {{-- DIKLAT --}}
                <article class="rs-tentang-unit-card">
                    <div class="rs-tentang-unit-top">
                        <div class="rs-tentang-unit-icon">
                            <i class="bi bi-mortarboard"></i>
                        </div>

                        <span class="rs-tentang-unit-badge">
                            Melalui Informasi RS
                        </span>
                    </div>

                    <h3>Bagian Diklat RS</h3>

                    <p>
                        Untuk informasi pendidikan dan pelatihan,
                        kegiatan pembelajaran, permohonan praktik,
                        serta pertanyaan mengenai kegiatan pengembangan
                        kompetensi.
                    </p>

                    <div class="rs-tentang-unit-contact">
                        <i class="bi bi-headset"></i>

                        <a href="tel:+62271593979">
                            Hubungi Informasi RS
                        </a>
                    </div>

                    <span class="rs-tentang-unit-note">
                        Minta diarahkan ke Bagian Diklat
                    </span>
                </article>


                {{-- PENGADUAN --}}
                <article class="rs-tentang-unit-card">
                    <div class="rs-tentang-unit-top">
                        <div class="rs-tentang-unit-icon">
                            <i class="bi bi-chat-square-text"></i>
                        </div>

                        <span class="rs-tentang-unit-badge">
                            Melalui Informasi RS
                        </span>
                    </div>

                    <h3>Informasi Pengaduan dan Saran</h3>

                    <p>
                        Untuk menanyakan prosedur penyampaian keluhan,
                        masukan, atau saran terkait pelayanan rumah sakit.
                    </p>

                    <div class="rs-tentang-unit-contact">
                        <i class="bi bi-telephone"></i>

                        <a href="tel:+62271593979">
                            Hubungi Informasi RS
                        </a>
                    </div>

                    <span class="rs-tentang-unit-note">
                        Minta diarahkan ke petugas terkait
                    </span>
                </article>


                {{-- KERJA SAMA --}}
                <article class="rs-tentang-unit-card">
                    <div class="rs-tentang-unit-top">
                        <div class="rs-tentang-unit-icon">
                            <i class="bi bi-people"></i>
                        </div>

                        <span class="rs-tentang-unit-badge">
                            Melalui Informasi RS
                        </span>
                    </div>

                    <h3>Informasi Kerja Sama</h3>

                    <p>
                        Untuk pertanyaan awal mengenai kegiatan
                        kemitraan, kunjungan institusi, dan permohonan
                        kerja sama dengan rumah sakit.
                    </p>

                    <div class="rs-tentang-unit-contact">
                        <i class="bi bi-telephone"></i>

                        <a href="tel:+62271593979">
                            Hubungi Informasi RS
                        </a>
                    </div>

                    <span class="rs-tentang-unit-note">
                        Minta diarahkan ke unit terkait
                    </span>
                </article>

            </div>


            {{-- EMAIL --}}
            <div class="rs-tentang-email-card">
                <div class="rs-tentang-email-icon">
                    <i class="bi bi-envelope"></i>
                </div>

                <div class="rs-tentang-email-content">
                    <span>Surat dan pertanyaan melalui email</span>

                    <h3>pku.sukoharjo@gmail.com</h3>

                    <p>
                        Gunakan email untuk menyampaikan pertanyaan
                        atau korespondensi umum kepada rumah sakit.
                    </p>
                </div>

                <a
                    href="mailto:pku.sukoharjo@gmail.com"
                    class="rs-tentang-email-button">

                    <i class="bi bi-envelope-fill"></i>
                    Kirim Email
                </a>
            </div>

            <div class="rs-tentang-contact-disclaimer" hidden>
                <i class="bi bi-info-circle"></i>

                <p>
                    Silakan menghubungi Bagian Informasi RS untuk
                    mendapatkan arahan ke petugas yang sesuai.
                </p>
            </div>

        </div>
    </section>


    {{-- CALL TO ACTION --}}
    <section class="rs-tentang-cta-section" hidden>
        <div class="rs-container">
            <div class="rs-tentang-cta">

                <div class="rs-tentang-cta-icon">
                    <i class="bi bi-chat-heart"></i>
                </div>

                <div class="rs-tentang-cta-content">
                    <span>Kami siap membantu Anda</span>

                    <h2>Masih memiliki pertanyaan?</h2>

                    <p>
                        Hubungi Bagian Informasi Rumah Sakit untuk
                        mendapatkan informasi lebih lanjut.
                    </p>
                </div>

                <a
                    href="https://wa.me/6285150763480"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="rs-tentang-cta-button">

                    <i class="bi bi-whatsapp"></i>
                    Hubungi Kami
                </a>

            </div>
        </div>
    </section>

</div>
