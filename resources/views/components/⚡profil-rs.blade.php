<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Profil RS | RS PKU Muhammadiyah Sukoharjo')]
class extends Component
{
    //
};

?>

<div>
    {{-- PAGE HEADER --}}
    <section class="rs-section rs-section-soft">
        <div class="rs-container">
            <div class="rs-section-heading mb-0">
                <div class="rs-section-label">
                    Informasi Rumah Sakit
                </div>

                <h2>Profil RS PKU Muhammadiyah Sukoharjo</h2>

                <p>
                    Mengenal lebih dekat identitas, sejarah, dan
                    pelayanan RS PKU Muhammadiyah Sukoharjo.
                </p>
            </div>
        </div>
    </section>

    {{-- PROFIL --}}
    <section class="rs-section">
        <div class="rs-container">
            <div class="rs-about-grid">
                <div class="rs-about-visual">
                    <i class="bi bi-hospital"></i>
                </div>

                <div class="rs-about-content">
                    <div class="rs-section-label">
                        Profil Rumah Sakit
                    </div>

                    <h2>
                        RS PKU Muhammadiyah Sukoharjo
                    </h2>

                    <p>
                        RS PKU Muhammadiyah Sukoharjo merupakan institusi
                        pelayanan kesehatan yang berkomitmen memberikan
                        pelayanan secara profesional dengan mengutamakan
                        keselamatan, kenyamanan, dan kebutuhan pasien.
                    </p>

                    <p>
                        Sebagai bagian dari pelayanan kesehatan
                        Muhammadiyah, rumah sakit mengedepankan nilai
                        Amanah, Santun, Ramah, dan Ikhlas dalam pelayanan.
                    </p>

                    <a href="{{ route('tentang') }}"
                       class="rs-button-primary">
                        Tentang Rumah Sakit
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- IDENTITAS --}}
    <section class="rs-section rs-section-soft">
        <div class="rs-container">
            <div class="rs-section-heading">
                <div class="rs-section-label">
                    Identitas Rumah Sakit
                </div>

                <h2>Informasi Umum</h2>
            </div>

            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <div class="rs-card">
                        <div class="rs-card-icon">
                            <i class="bi bi-building"></i>
                        </div>

                        <h3>Nama Rumah Sakit</h3>

                        <p>
                            RS PKU Muhammadiyah Sukoharjo
                        </p>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="rs-card">
                        <div class="rs-card-icon">
                            <i class="bi bi-heart-pulse"></i>
                        </div>

                        <h3>Komitmen Pelayanan</h3>

                        <p>
                            Amanah, Santun, Ramah, dan Ikhlas (ASRI).
                        </p>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="rs-card">
                        <div class="rs-card-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>

                        <h3>Lokasi</h3>

                        <p>
                            Kabupaten Sukoharjo, Jawa Tengah.
                        </p>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="rs-card">
                        <div class="rs-card-icon">
                            <i class="bi bi-people"></i>
                        </div>

                        <h3>Pelayanan Kesehatan</h3>

                        <p>
                            Informasi pelayanan kesehatan dan fasilitas
                            rumah sakit akan dikembangkan pada portal ini.
                        </p>
                    </div>
                </div>
            </div>

            <div class="alert alert-light border mt-4 mb-0">
                <i class="bi bi-info-circle me-2"></i>

                Informasi sejarah, alamat lengkap, visi, misi, dan
                identitas resmi rumah sakit akan disesuaikan dengan
                data resmi yang digunakan oleh rumah sakit.
            </div>
        </div>
    </section>
</div>
