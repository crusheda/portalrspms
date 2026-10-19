<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Profil RS | RS PKU Muhammadiyah Sukoharjo')]
class extends Component
{
    //
};

?>

<div class="rs-profile-page">
    @php
        /*
         * Simpan dokumen resmi di:
         * public/dokumen/profil-rs/
         *
         * Tombol unduh akan aktif otomatis setelah file tersedia.
         * Jangan unggah dokumen yang belum disahkan oleh pihak RS.
         */
        $dokumenRs = [
            [
                'kategori' => 'Akreditasi',
                'judul' => 'Sertifikat Akreditasi Rumah Sakit',
                'deskripsi' => 'Dokumen sertifikat akreditasi resmi rumah sakit.',
                'nama_file' => 'sertifikat-akreditasi-rs.pdf',
                'path' => 'dokumen/sertifikat-akreditasi-rs.pdf',
                'icon' => 'bi-patch-check',
                'label' => 'PDF',
            ],
            [
                'kategori' => 'Akreditasi',
                'judul' => 'Dokumen Akreditasi RS Tahun 2026',
                'deskripsi' => 'Tempatkan dokumen akreditasi tahun 2026 di sini jika sudah tersedia dan disahkan.',
                'nama_file' => 'akreditasi-rs-2026.pdf',
                'path' => 'dokumen/akreditasi-rs-2026.pdf',
                'icon' => 'bi-award',
                'label' => 'PDF',
            ],
            [
                'kategori' => 'Perizinan',
                'judul' => 'Dokumen Perizinan Operasional Rumah Sakit',
                'deskripsi' => 'Dokumen perizinan resmi yang dapat dipublikasikan.',
                'nama_file' => 'perizinan-rs.pdf',
                'path' => 'dokumen/perizinan-rs.pdf',
                'icon' => 'bi-file-earmark-text',
                'label' => 'PDF',
            ],
            [
                'kategori' => 'Profil',
                'judul' => 'Profil Rumah Sakit',
                'deskripsi' => 'Ringkasan profil, identitas, dan informasi umum rumah sakit.',
                'nama_file' => 'profil-rs-pku-muhammadiyah-sukoharjo.pdf',
                'path' => 'dokumen/profil-rs-pku-muhammadiyah-sukoharjo.pdf',
                'icon' => 'bi-hospital',
                'label' => 'PDF',
            ],
            [
                'kategori' => 'Pelayanan',
                'judul' => 'Brosur Informasi Pelayanan',
                'deskripsi' => 'Informasi layanan rumah sakit yang telah disetujui untuk publikasi.',
                'nama_file' => 'brosur-pelayanan-rs.pdf',
                'path' => 'dokumen/brosur-pelayanan-rs.pdf',
                'icon' => 'bi-journal-medical',
                'label' => 'PDF',
            ],
            [
                'kategori' => 'Tata Kelola',
                'judul' => 'Struktur Organisasi Rumah Sakit',
                'deskripsi' => 'Struktur organisasi resmi yang telah disetujui untuk dipublikasikan.',
                'nama_file' => 'struktur-organisasi-rs.pdf',
                'path' => 'dokumen/struktur-organisasi-rs.pdf',
                'icon' => 'bi-diagram-3',
                'label' => 'PDF',
            ],
            [
                'kategori' => 'Pelayanan',
                'judul' => 'Maklumat Pelayanan',
                'deskripsi' => 'Maklumat pelayanan rumah sakit, jika tersedia untuk publik.',
                'nama_file' => 'maklumat-pelayanan-rs.pdf',
                'path' => 'dokumen/maklumat-pelayanan-rs.pdf',
                'icon' => 'bi-megaphone',
                'label' => 'PDF',
            ],
            [
                'kategori' => 'Informasi Publik',
                'judul' => 'Panduan Informasi Pengunjung',
                'deskripsi' => 'Panduan umum bagi pasien dan pengunjung rumah sakit.',
                'nama_file' => 'panduan-informasi-pengunjung.pdf',
                'path' => 'dokumen/panduan-informasi-pengunjung.pdf',
                'icon' => 'bi-info-circle',
                'label' => 'PDF',
            ],
        ];

        $sejarahRs = [
            [
                'tahun' => '1992',
                'judul' => 'Wakaf Tanah',
                'deskripsi' => 'Rumah sakit memperoleh wakaf tanah dari keluarga Ibu Hj. Sunarto Batik Putri Pantes seluas 1.100 meter persegi.',
                'icon' => 'bi-tree',
                'jenis' => 'Awal perjalanan',
            ],
            [
                'tahun' => '1993',
                'judul' => 'Pembangunan Rumah Bersalin',
                'deskripsi' => 'PDM Sukoharjo memperoleh bantuan dari Hj. Khodijah Al Kubro (Emirat Arab) untuk membangun Rumah Bersalin PKU Muhammadiyah Sukoharjo.',
                'icon' => 'bi-heart-pulse',
                'jenis' => 'Pengembangan layanan',
            ],
            [
                'tahun' => '1995',
                'judul' => 'Peresmian Rumah Bersalin',
                'deskripsi' => 'Bangunan Rumah Bersalin PKU Muhammadiyah Sukoharjo diresmikan oleh Bupati Sukoharjo, Bapak Ir. Tedjo Suminto, pada 4 Desember 1995.',
                'icon' => 'bi-flag',
                'jenis' => 'Tonggak sejarah',
            ],
            [
                'tahun' => '2009',
                'judul' => 'Perubahan Status',
                'deskripsi' => 'Berubah status menjadi Klinik Rawat Inap Pelayanan Medik Dasar PKU Muhammadiyah Sukoharjo berdasarkan SK Dinas Kesehatan Kabupaten Sukoharjo Nomor 0/KRIPMD/III2009 sebagaimana tercantum pada dokumen profil lama.',
                'icon' => 'bi-building-check',
                'jenis' => 'Perkembangan institusi',
            ],
            [
                'tahun' => '2010',
                'judul' => 'Pembentukan Panitia Pembangunan',
                'deskripsi' => 'Pimpinan Daerah Muhammadiyah Sukoharjo membentuk panitia pembangunan Rumah Sakit PKU Muhammadiyah Sukoharjo.',
                'icon' => 'bi-people',
                'jenis' => 'Pengembangan institusi',
            ],
            [
                'tahun' => '2011',
                'judul' => 'Pembangunan Gedung Rumah Sakit',
                'deskripsi' => 'Pembelian tanah di sebelah barat menjadikan luas lahan yang dimiliki sekitar 3.210 m². Pembangunan gedung empat lantai dengan kapasitas 100 tempat tidur, dua ruang operasi, IGD, laboratorium, radiologi, serta sarana pendukung dilanjutkan pada 20 Maret 2011.',
                'icon' => 'bi-hospital',
                'jenis' => 'Infrastruktur',
            ],
            [
                'tahun' => '2011',
                'judul' => 'Izin Operasional Sementara',
                'deskripsi' => 'Memperoleh Surat Izin Operasional Sementara Rumah Sakit pada 18 November 2011 dengan Nomor 445/9855/XI/2011.',
                'icon' => 'bi-file-earmark-check',
                'jenis' => 'Perizinan',
            ],
            [
                'tahun' => '2014',
                'judul' => 'Izin Mendirikan Rumah Sakit',
                'deskripsi' => 'Memperoleh SK Dinas Kesehatan Kabupaten Sukoharjo Nomor 445/769/I/2014 tentang izin mendirikan Rumah Sakit Umum PKU Muhammadiyah di Jl. Mayor Sunaryo No. 37 Sukoharjo pada 18 Januari 2014.',
                'icon' => 'bi-file-earmark-text',
                'jenis' => 'Perizinan',
            ],
            [
                'tahun' => '2016',
                'judul' => 'Izin Operasional dan Penetapan Kelas C',
                'deskripsi' => 'Memperoleh Surat Izin Operasional dan Penetapan Rumah Sakit Umum Kelas C dari Dinas Kesehatan Kabupaten Sukoharjo dengan SK Nomor 445/7936/VI/2016 pada 14 Juni 2016.',
                'icon' => 'bi-patch-check',
                'jenis' => 'Perizinan',
            ],
            [
                'tahun' => '2017',
                'judul' => 'Perizinan Lingkungan dan Air Tanah',
                'deskripsi' => 'Dokumen profil lama mencatat perizinan pembuangan air limbah/IPLC pada 7 November 2017 dan izin air bawah tanah pada 13 November 2017.',
                'icon' => 'bi-droplet',
                'jenis' => 'Perizinan pendukung',
            ],
            [
                'tahun' => '2018',
                'judul' => 'Izin Penyimpanan Sementara Limbah B3',
                'deskripsi' => 'Memperoleh izin penyimpanan sementara limbah B3 dengan Nomor 503/654.1/001/LB3/I/2018 pada 9 Januari 2018, sesuai informasi dalam profil lama.',
                'icon' => 'bi-recycle',
                'jenis' => 'Keselamatan lingkungan',
            ],
            [
                'tahun' => '2019',
                'judul' => 'Izin Pemanfaatan Tenaga Nuklir',
                'deskripsi' => 'Dokumen profil lama mencatat izin pemanfaatan tenaga nuklir oleh BAPETEN dengan Nomor 061349.010.11.170619 pada 17 Juni 2019.',
                'icon' => 'bi-radioactive',
                'jenis' => 'Keselamatan fasilitas',
            ],
            [
                'tahun' => '2020',
                'judul' => 'Sertifikat Laik Fungsi',
                'deskripsi' => 'Memperoleh Sertifikat Laik Fungsi dari Dinas Pekerjaan Umum dan Penataan Ruang Kabupaten Sukoharjo dengan Nomor 045.2/7321/XII/2020 pada 2 Desember 2020.',
                'icon' => 'bi-building-check',
                'jenis' => 'Kelayakan bangunan',
            ],
            [
                'tahun' => '2021',
                'judul' => 'Sertifikat Kelayakan Instalasi',
                'deskripsi' => 'Profil lama mencatat sertifikat laik operasi instalasi listrik pada 23 Desember 2021 dan izin proteksi alarm kebakaran pada 25 Desember 2021.',
                'icon' => 'bi-lightning-charge',
                'jenis' => 'Keselamatan fasilitas',
            ],
            [
                'tahun' => '2022',
                'judul' => 'Perizinan dan Pengelolaan Fasilitas',
                'deskripsi' => 'Dokumen profil lama mencatat izin lift, pemeriksaan instalasi penyalur petir, serta perjanjian pengangkutan dan pengelolaan limbah B3. Pada 10 Agustus 2022, rumah sakit juga memperoleh perizinan berusaha berbasis risiko melalui OSS dan penetapan sebagai Rumah Sakit Umum Kelas C.',
                'icon' => 'bi-shield-check',
                'jenis' => 'Perizinan dan mutu',
            ],
            [
                'tahun' => '2023',
                'judul' => 'Akreditasi Paripurna',
                'deskripsi' => 'Menurut profil lama, rumah sakit memperoleh tingkat kelulusan Paripurna Bintang Lima dari Lembaga Akreditasi Rumah Sakit Indonesia (LARSI), dengan sertifikat yang tercatat berlaku sampai 25 Maret 2027. Pastikan status dan dokumen terbaru dikonfirmasi sebelum dipublikasikan.',
                'icon' => 'bi-award',
                'jenis' => 'Mutu pelayanan',
            ],
            [
                'tahun' => '2025',
                'judul' => 'Pengembangan Gedung dan Layanan',
                'deskripsi' => 'Profil lama memuat rencana pengembangan gedung empat lantai di bagian utara rumah sakit untuk bangsal dengan konsep Kelas Rawat Inap Standar (KRIS). Status realisasi perlu diperbarui berdasarkan kondisi terkini.',
                'icon' => 'bi-buildings',
                'jenis' => 'Pengembangan fasilitas',
            ],
        ];
    @endphp

    {{-- HERO --}}
    <section class="rs-profile-hero">
        <div class="rs-profile-hero-pattern"></div>
        <div class="rs-container rs-profile-hero-inner">
            <div class="rs-profile-hero-copy" data-profile-reveal>
                <div class="rs-profile-eyebrow">
                    <span class="rs-profile-eyebrow-dot"></span>
                    PROFIL RUMAH SAKIT
                </div>

                <h1>
                    Mengenal Lebih Dekat
                    <span>RS PKU Muhammadiyah Sukoharjo</span>
                </h1>

                <p>
                    Bertumbuh bersama masyarakat dalam pelayanan kesehatan
                    yang profesional, berlandaskan nilai Islami, serta
                    mengutamakan keselamatan dan kebutuhan pasien.
                </p>

                <div class="rs-profile-hero-actions">
                    <a href="#sejarah-rs" class="rs-profile-button rs-profile-button-primary">
                        <i class="bi bi-clock-history"></i>
                        Telusuri Sejarah
                    </a>
                    <a href="#dokumen-rs" class="rs-profile-button rs-profile-button-glass">
                        <i class="bi bi-file-earmark-arrow-down"></i>
                        Dokumen Rumah Sakit
                    </a>
                </div>

                <div class="rs-profile-hero-location">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>Jl. Mayor Sunaryo No. 37, Sukoharjo, Jawa Tengah</span>
                </div>
            </div>

            <div class="rs-profile-hero-visual" data-profile-reveal>
                <div class="rs-profile-hero-image-main">
                    <img
                        src="{{ asset('img/pku/gedung/baru_11.png') }}"
                        alt="Gedung RS PKU Muhammadiyah Sukoharjo"
                        onerror="this.style.display='none'; this.parentElement.classList.add('is-placeholder')"
                    >
                    <div class="rs-profile-image-fallback">
                        <i class="bi bi-hospital"></i>
                        <span>RS PKU Muhammadiyah Sukoharjo</span>
                    </div>
                </div>

                <div class="rs-profile-floating-card rs-profile-floating-card-top">
                    <span class="rs-profile-floating-icon"><i class="bi bi-heart-pulse"></i></span>
                    <span><strong>Pelayanan Kesehatan</strong><small>Profesional dan humanis</small></span>
                </div>

                <div class="rs-profile-floating-card rs-profile-floating-card-bottom">
                    <span class="rs-profile-asri-mark">ASRI</span>
                    <span><strong>Nilai Pelayanan</strong><small>Amanah · Santun · Ramah · Ikhlas</small></span>
                </div>

                <div class="rs-profile-hero-orbit"></div>
            </div>
        </div>

        <div class="rs-profile-hero-bottom">
            <div class="rs-container">
                <a href="#profil-singkat" aria-label="Gulir ke profil singkat">
                    <span>Kenali perjalanan kami</span>
                    <i class="bi bi-arrow-down"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- INTRO / PROFIL SINGKAT --}}
    <section class="rs-section rs-profile-intro" id="profil-singkat">
        <div class="rs-container">
            <div class="rs-profile-intro-grid">
                <div class="rs-profile-intro-visual" data-profile-reveal>
                    <div class="rs-profile-intro-image rs-profile-intro-image-large">
                        <img src="{{ asset('img/pku/gedung/baru_21.png') }}" alt="Fasilitas RS PKU Muhammadiyah Sukoharjo"
                            onerror="this.style.display='none'; this.parentElement.classList.add('is-placeholder')">
                        <i class="bi bi-hospital"></i>
                    </div>
                    <div class="rs-profile-intro-image rs-profile-intro-image-small">
                        <img src="{{ asset('img/pku/gedung/baru_3_cropped1.png') }}" alt="Pengembangan gedung rumah sakit"
                            onerror="this.style.display='none'; this.parentElement.classList.add('is-placeholder')">
                        <i class="bi bi-buildings"></i>
                    </div>
                    <div class="rs-profile-intro-stamp">
                        <i class="bi bi-heart-pulse-fill"></i>
                        <span>Melayani dengan<br><strong>sepenuh hati</strong></span>
                    </div>
                </div>

                <div class="rs-profile-intro-copy" data-profile-reveal>
                    <div class="rs-section-label">Siapa Kami</div>
                    <h2>Rumah Sakit yang tumbuh bersama masyarakat Sukoharjo</h2>
                    <p class="rs-profile-lead">
                        RS PKU Muhammadiyah Sukoharjo merupakan rumah sakit
                        milik Pimpinan Daerah Muhammadiyah (PDM) Kabupaten
                        Sukoharjo yang menyelenggarakan pelayanan kesehatan
                        bagi masyarakat.
                    </p>
                    <p>
                        Pelayanan rumah sakit meliputi upaya penyembuhan,
                        pemulihan, peningkatan, pencegahan, serta pelayanan
                        rujukan sesuai kemampuan dan ketentuan yang berlaku.
                        Dalam menjalankan perannya, rumah sakit terus berupaya
                        mengembangkan mutu pelayanan, tata kelola, sumber daya
                        manusia, serta sarana dan prasarana.
                    </p>
                    <p>
                        Nilai Amanah, Santun, Ramah, dan Ikhlas (ASRI) menjadi
                        semangat pelayanan yang ingin dihadirkan kepada pasien,
                        keluarga, dan masyarakat.
                    </p>

                    <div class="rs-profile-principles">
                        <div><i class="bi bi-shield-check"></i><span>Keselamatan pasien</span></div>
                        <div><i class="bi bi-person-heart"></i><span>Pelayanan humanis</span></div>
                        <div><i class="bi bi-graph-up-arrow"></i><span>Perbaikan berkelanjutan</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- IDENTITAS --}}
    <section class="rs-section rs-section-soft rs-profile-identity">
        <div class="rs-container">
            <div class="rs-profile-section-heading" data-profile-reveal>
                <div class="rs-section-label">Identitas Rumah Sakit</div>
                <h2>Informasi Umum</h2>
                <p>Ringkasan identitas dan informasi dasar rumah sakit.</p>
            </div>

            <div class="rs-profile-identity-grid">
                <article class="rs-profile-info-card" data-profile-reveal>
                    <span class="rs-profile-info-icon"><i class="bi bi-hospital"></i></span>
                    <div><small>Nama Institusi</small><h3>RS PKU Muhammadiyah Sukoharjo</h3><p>Rumah sakit di bawah naungan Pimpinan Daerah Muhammadiyah Kabupaten Sukoharjo.</p></div>
                </article>
                <article class="rs-profile-info-card" data-profile-reveal>
                    <span class="rs-profile-info-icon"><i class="bi bi-geo-alt"></i></span>
                    <div><small>Alamat</small><h3>Jl. Mayor Sunaryo No. 37</h3><p>Kabupaten Sukoharjo, Provinsi Jawa Tengah.</p></div>
                </article>
                <article class="rs-profile-info-card" data-profile-reveal>
                    <span class="rs-profile-info-icon"><i class="bi bi-buildings"></i></span>
                    <div><small>Klasifikasi dalam dokumen lama</small><h3>Rumah Sakit Umum Kelas C</h3><p>Data ini tercantum dalam profil lama; pembaruan mengikuti dokumen resmi terbaru.</p></div>
                </article>
                <article class="rs-profile-info-card" data-profile-reveal>
                    <span class="rs-profile-info-icon"><i class="bi bi-stars"></i></span>
                    <div><small>Tata Nilai</small><h3>ASRI</h3><p>Amanah, Santun, Ramah, dan Ikhlas sebagai nilai pelayanan rumah sakit.</p></div>
                </article>
            </div>
        </div>
    </section>

    {{-- MOTTO --}}
    <section class="rs-profile-motto">
        <div class="rs-container">
            <div class="rs-profile-motto-card" data-profile-reveal>
                <div class="rs-profile-motto-icon"><i class="bi bi-quote"></i></div>
                <div class="rs-profile-motto-copy">
                    <div class="rs-profile-motto-label">Motto Rumah Sakit</div>
                    <blockquote>“Kesembuhan datangnya dari Allah, kepuasan Anda adalah tanggung jawab kami.”</blockquote>
                </div>
                <div class="rs-profile-motto-decoration"><i class="bi bi-heart-pulse"></i></div>
            </div>
        </div>
    </section>

    {{-- VISI MISI --}}
    <section class="rs-section rs-profile-vision">
        <div class="rs-container">
            <div class="rs-profile-section-heading" data-profile-reveal>
                <div class="rs-section-label">Arah dan Komitmen</div>
                <h2>Visi, Misi, Tujuan, dan Tata Nilai</h2>
                <p>Landasan untuk menyelenggarakan pelayanan yang bermutu dan berkesinambungan.</p>
            </div>

            <div class="rs-profile-vision-grid">
                <article class="rs-profile-vision-card rs-profile-vision-main" data-profile-reveal>
                    <span class="rs-profile-vision-icon"><i class="bi bi-eye"></i></span>
                    <div class="rs-profile-vision-label">Visi</div>
                    <h3>Menjadi Rumah Sakit Bernuansa Islami, dengan Pelayanan Cepat dan Ramah.</h3>
                    <div class="rs-profile-vision-watermark"><i class="bi bi-eye"></i></div>
                </article>

                <article class="rs-profile-vision-card" data-profile-reveal>
                    <span class="rs-profile-vision-icon"><i class="bi bi-signpost-split"></i></span>
                    <div class="rs-profile-vision-label">Misi</div>
                    <ol class="rs-profile-check-list">
                        <li>Menyelenggarakan rumah sakit yang bernuansa Islami.</li>
                        <li>Menyelenggarakan pelayanan kesehatan yang bermutu dan dikelola secara berkesinambungan.</li>
                        <li>Mewujudkan SDM yang profesional, berakhlak mulia, dan sejahtera.</li>
                        <li>Mewujudkan budaya kerja yang produktif dan kondusif.</li>
                        <li>Mewujudkan sarana dan prasarana yang andal.</li>
                    </ol>
                </article>

                <article class="rs-profile-vision-card" data-profile-reveal>
                    <span class="rs-profile-vision-icon"><i class="bi bi-bullseye"></i></span>
                    <div class="rs-profile-vision-label">Tujuan</div>
                    <ul class="rs-profile-check-list">
                        <li>Terwujudnya tata kelola rumah sakit yang Islami.</li>
                        <li>Terwujudnya peningkatan mutu pelayanan rumah sakit.</li>
                        <li>Terwujudnya kualitas SDM yang profesional, berakhlak mulia, dan sejahtera.</li>
                        <li>Terwujudnya budaya kerja yang produktif dan kondusif.</li>
                        <li>Terwujudnya ketersediaan sarana dan prasarana yang andal.</li>
                    </ul>
                </article>

                <article class="rs-profile-vision-card rs-profile-values-card" data-profile-reveal>
                    <span class="rs-profile-vision-icon"><i class="bi bi-heart"></i></span>
                    <div class="rs-profile-vision-label">Tata Nilai</div>
                    <h3 class="rs-profile-asri-large">ASRI</h3>
                    <div class="rs-profile-values-list">
                        <span><b>A</b> Amanah</span>
                        <span><b>S</b> Santun</span>
                        <span><b>R</b> Ramah</span>
                        <span><b>I</b> Ikhlas</span>
                    </div>
                </article>
            </div>
        </div>
    </section>

    {{-- SEJARAH TIMELINE --}}
    <section class="rs-section rs-section-soft rs-profile-history" id="sejarah-rs">
        <div class="rs-container">
            <div class="rs-profile-section-heading" data-profile-reveal>
                <div class="rs-section-label">Perjalanan dan Perkembangan</div>
                <h2>Sejarah RS PKU Muhammadiyah Sukoharjo</h2>
                <p>
                    Menelusuri perjalanan dari wakaf tanah hingga perkembangan
                    layanan dan fasilitas rumah sakit. Linimasa berikut disusun
                    berdasarkan informasi pada profil lama dan perlu diperbarui
                    jika terdapat dokumen resmi yang lebih mutakhir.
                </p>
            </div>

            <div class="rs-profile-history-summary" data-profile-reveal>
                <div><span class="rs-profile-history-summary-icon"><i class="bi bi-calendar3"></i></span><span><strong>1992</strong><small>Awal perjalanan</small></span></div>
                <div><span class="rs-profile-history-summary-icon"><i class="bi bi-signpost"></i></span><span><strong>{{ count($sejarahRs) }} catatan</strong><small>Peristiwa historis</small></span></div>
                <div><span class="rs-profile-history-summary-icon"><i class="bi bi-book-half"></i></span><span><strong>1992–2025</strong><small>Rentang catatan sejarah</small></span></div>
            </div>

            <div class="rs-profile-timeline" data-profile-timeline>
                <div class="rs-profile-timeline-line"><span></span></div>

                @foreach ($sejarahRs as $index => $item)
                    <article class="rs-profile-timeline-item {{ $index % 2 === 0 ? 'is-left' : 'is-right' }}"
                        data-timeline-item style="--timeline-index: {{ $index }}">
                        <div class="rs-profile-timeline-marker">
                            <span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>

                        <div class="rs-profile-timeline-card">
                            <div class="rs-profile-timeline-card-top">
                                <span class="rs-profile-timeline-category">{{ $item['jenis'] }}</span>
                                <span class="rs-profile-timeline-icon"><i class="bi {{ $item['icon'] }}"></i></span>
                            </div>

                            <div class="rs-profile-timeline-year">{{ $item['tahun'] }}</div>
                            <h3>{{ $item['judul'] }}</h3>
                            <p>{{ $item['deskripsi'] }}</p>
                            <div class="rs-profile-timeline-card-bottom">
                                <span><i class="bi bi-check2-circle"></i> Catatan sejarah</span>
                                <span class="rs-profile-timeline-index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="rs-profile-history-note" data-profile-reveal>
                <i class="bi bi-info-circle"></i>
                <p>
                    <strong>Catatan pembaruan data:</strong> beberapa nomor
                    perizinan, status pembangunan, dan status akreditasi di atas
                    mengikuti informasi dari halaman profil lama. Sebelum
                    dipublikasikan sebagai informasi resmi, cocokkan kembali
                    dengan dokumen terbaru yang dimiliki rumah sakit.
                </p>
            </div>
        </div>
    </section>

    {{-- DIREKSI --}}
    <section class="rs-section rs-profile-leadership">
        <div class="rs-container">
            <div class="rs-profile-section-heading" data-profile-reveal>
                <div class="rs-section-label">Kepemimpinan</div>
                <h2>Jajaran Direksi</h2>
                <p>Nama dan jabatan ditampilkan mengikuti data pada template profil lama. Perbarui apabila ada perubahan susunan direksi.</p>
            </div>

            <div class="rs-profile-leadership-grid">
                <article class="rs-profile-leader-card" data-profile-reveal>
                    <div class="rs-profile-leader-photo">
                        <img src="{{ asset('img/pejabat/indarto.png') }}" alt="dr. Indarto, M.Si., M.M."
                            onerror="this.style.display='none'; this.parentElement.classList.add('is-placeholder')">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div class="rs-profile-leader-content">
                        <span class="rs-profile-leader-role">Direktur Utama</span>
                        <h3>dr. Indarto, M.Si., M.M.</h3>
                        <div class="rs-profile-leader-line"></div>
                    </div>
                </article>

                <article class="rs-profile-leader-card" data-profile-reveal>
                    <div class="rs-profile-leader-photo">
                        <img src="{{ asset('img/pejabat/ryan.png') }}" alt="dr. Ryandika Aulia Oktorizal"
                            onerror="this.style.display='none'; this.parentElement.classList.add('is-placeholder')">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div class="rs-profile-leader-content">
                        <span class="rs-profile-leader-role">Direktur Pelayanan dan Pengembangan</span>
                        <h3>dr. Ryandika Aulia Oktorizal</h3>
                        <div class="rs-profile-leader-line"></div>
                    </div>
                </article>

                <article class="rs-profile-leader-card" data-profile-reveal>
                    <div class="rs-profile-leader-photo">
                        <img src="{{ asset('img/pejabat/resita.png') }}" alt="dr. Resita Lukitawati"
                            onerror="this.style.display='none'; this.parentElement.classList.add('is-placeholder')">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div class="rs-profile-leader-content">
                        <span class="rs-profile-leader-role">Direktur Keuangan</span>
                        <h3>dr. Resita Lukitawati</h3>
                        <div class="rs-profile-leader-line"></div>
                    </div>
                </article>

                <article class="rs-profile-leader-card" data-profile-reveal>
                    <div class="rs-profile-leader-photo">
                        <img src="{{ asset('img/pejabat/eko.png') }}" alt="KRT. Eko Pujiatmoko, S.E., M.Ak."
                            onerror="this.style.display='none'; this.parentElement.classList.add('is-placeholder')">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div class="rs-profile-leader-content">
                        <span class="rs-profile-leader-role">Direktur AIK dan Sumber Daya</span>
                        <h3>KRT. Eko Pujiatmoko, S.E., M.Ak.</h3>
                        <div class="rs-profile-leader-line"></div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    {{-- DOKUMEN PENTING --}}
    <section class="rs-section rs-section-soft rs-profile-documents" id="dokumen-rs">
        <div class="rs-container">
            <div class="rs-profile-documents-header" data-profile-reveal>
                <div>
                    <div class="rs-section-label">Pusat Dokumen</div>
                    <h2>Dokumen Penting Rumah Sakit</h2>
                    <p>
                        Akses dokumen profil dan informasi rumah sakit yang
                        telah disetujui untuk dipublikasikan.
                    </p>
                </div>
                <div class="rs-profile-documents-badge">
                    <i class="bi bi-file-earmark-check"></i>
                    <span>Dokumen resmi</span>
                </div>
            </div>

            <div class="rs-profile-documents-notice">
                <i class="bi bi-shield-lock"></i>
                <p>
                    Dokumen hanya dapat diunduh setelah file ditempatkan di
                    direktori publik. Pastikan setiap file sudah diverifikasi
                    dan mendapat persetujuan publikasi. Jangan unggah dokumen
                    internal atau dokumen yang memuat data pribadi pasien.
                </p>
            </div>

            <div class="rs-profile-documents-grid">
                @foreach ($dokumenRs as $dokumen)
                    @php
                        $dokumenTersedia = file_exists(public_path($dokumen['path']));
                    @endphp

                    <article class="rs-profile-document-card" data-profile-reveal>
                        <div class="rs-profile-document-icon">
                            <i class="bi {{ $dokumen['icon'] }}"></i>
                        </div>

                        <div class="rs-profile-document-main">
                            <span class="rs-profile-document-category">{{ $dokumen['kategori'] }}</span>
                            <h3>{{ $dokumen['judul'] }}</h3>
                            <p>{{ $dokumen['deskripsi'] }}</p>

                            <div class="rs-profile-document-file">
                                <i class="bi bi-file-earmark-pdf"></i>
                                <span>{{ $dokumen['nama_file'] }}</span>
                            </div>
                        </div>

                        @if ($dokumenTersedia)
                            <a class="rs-profile-document-download"
                                href="{{ asset($dokumen['path']) }}"
                                download="{{ $dokumen['nama_file'] }}"
                                aria-label="Unduh {{ $dokumen['judul'] }}"
                                title="Unduh {{ $dokumen['judul'] }}">
                                <span>Unduh file</span>
                                <i class="bi bi-download"></i>
                            </a>
                        @else
                            <span class="rs-profile-document-unavailable" title="File belum ditempatkan di direktori publik">
                                <span>Belum tersedia</span>
                                <i class="bi bi-clock"></i>
                            </span>
                        @endif
                    </article>
                @endforeach
            </div>

            <div class="rs-profile-document-footer">
                <i class="bi bi-folder2-open"></i>
                <div>
                    <strong>Lokasi penyimpanan file</strong>
                    <p>Letakkan file PDF di <code>public/dokumen/profil-rs/</code> dengan nama file yang tercantum pada setiap kartu. Tombol unduh akan aktif otomatis jika file sudah tersedia.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- PENUTUP / KONTAK --}}
    <section class="rs-profile-closing">
        <div class="rs-container">
            <div class="rs-profile-closing-card" data-profile-reveal>
                <div class="rs-profile-closing-content">
                    <span class="rs-profile-closing-eyebrow">RS PKU Muhammadiyah Sukoharjo</span>
                    <h2>Pelayanan yang berangkat dari amanah dan kepedulian.</h2>
                    <p>
                        Dapatkan informasi layanan, jadwal praktik dokter,
                        serta informasi rumah sakit melalui kanal resmi yang
                        tersedia pada portal ini.
                    </p>
                    <div class="rs-profile-closing-actions">
                        <a href="{{ route('jadwal-dokter') }}" class="rs-profile-button rs-profile-button-white">
                            <i class="bi bi-calendar2-week"></i> Jadwal Dokter
                        </a>
                        <a href="{{ route('ketersediaan-tempat-tidur') }}" class="rs-profile-button rs-profile-button-outline-white">
                            <i class="bi bi-hospital"></i> Ketersediaan Tempat Tidur
                        </a>
                    </div>
                </div>
                <div class="rs-profile-closing-art"><i class="bi bi-heart-pulse"></i><span>ASRI</span></div>
            </div>
        </div>
    </section>

    @script
    <script>
        (() => {
            const root = document.querySelector('.rs-profile-page');

            if (!root || root.dataset.profileInitialized === 'true') {
                return;
            }

            root.dataset.profileInitialized = 'true';

            const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const revealItems = root.querySelectorAll('[data-profile-reveal]');
            const timelineItems = root.querySelectorAll('[data-timeline-item]');

            if (reduceMotion || !('IntersectionObserver' in window)) {
                revealItems.forEach((item) => item.classList.add('is-visible'));
                timelineItems.forEach((item) => item.classList.add('is-visible'));
                return;
            }

            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.12,
                rootMargin: '0px 0px -35px 0px'
            });

            revealItems.forEach((item) => revealObserver.observe(item));

            const timelineObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.16,
                rootMargin: '0px 0px -25px 0px'
            });

            timelineItems.forEach((item) => timelineObserver.observe(item));

            const timeline = root.querySelector('.rs-profile-timeline');
            const lineFill = timeline?.querySelector('.rs-profile-timeline-line span');

            if (timeline && lineFill) {
                const updateTimelineProgress = () => {
                    const rect = timeline.getBoundingClientRect();
                    const viewportPoint = window.innerHeight * 0.72;
                    const progress = Math.min(
                        1,
                        Math.max(0, (viewportPoint - rect.top) / Math.max(rect.height, 1))
                    );

                    lineFill.style.height = `${progress * 100}%`;
                };

                window.addEventListener('scroll', updateTimelineProgress, { passive: true });
                window.addEventListener('resize', updateTimelineProgress);
                updateTimelineProgress();
            }
        })();
    </script>
    @endscript
</div>
