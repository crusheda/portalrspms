<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Jadwal Dokter Spesialis | RS PKU Muhammadiyah Sukoharjo')]
class extends Component {
};

?>

<div data-public-page="jadwal-dokter" data-api-url="{{ url('/api/bpjs/bridging/antrean/poli') }}" data-pdf-url="{{ url('/api/bpjs/bridging/antrean/poli/pdf') }}">
    <section class="rs-page-hero">
        <div class="rs-container">
            <div class="rs-page-hero-content">
                <div class="rs-eyebrow"><i class="bi bi-calendar2-week"></i> INFORMASI PELAYANAN</div>
                <h1>Jadwal Dokter Spesialis</h1>
                <p>Jadwal ini membantu pasien dalam merencanakan kunjungan sesuai dengan kebutuhan medis yang diperlukan.
                    Disarankan untuk selalu memeriksa jadwal terbaru melalui website resmi atau dapat menghubungi layanan informasi Kami.</p>
                <div class="rs-breadcrumb">
                    <a href="{{ route('beranda') }}" wire:navigate>Beranda</a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Jadwal Dokter</span>
                </div>
            </div>
        </div>
    </section>

    <section class="rs-section">
        <div class="rs-container">
            <div class="rs-schedule-intro">
                <div>
                    <div class="rs-section-label">Integrasi BPJS Kesehatan</div>
                    <h2>Temukan Jadwal Dokter Anda</h2>
                    <p>Informasi Jadwal Dokter Spesialis yang tersedia melalui integrasi dengan layanan BPJS Kesehatan.</p>
                </div>
                <div class="rs-live-badge"><span class="rs-live-dot"></span> Sumber: layanan BPJS</div>
            </div>

            <div class="rs-schedule-stats">
                <div class="rs-schedule-stat">
                    <span class="rs-stat-icon"><i class="bi bi-person-badge"></i></span>
                    <div><small>Dokter pada minggu ini</small><strong id="jadwal-count-dokter">—</strong></div>
                </div>
                <div class="rs-schedule-stat">
                    <span class="rs-stat-icon"><i class="bi bi-hospital"></i></span>
                    <div><small>Poliklinik ditemukan</small><strong id="jadwal-count-poli">—</strong></div>
                </div>
                <div class="rs-schedule-stat">
                    <span class="rs-stat-icon"><i class="bi bi-calendar-check"></i></span>
                    <div><small>Jadwal praktik</small><strong id="jadwal-count-total">—</strong></div>
                </div>
            </div>

            <div class="rs-filter-panel">
                <div class="rs-filter-grid">
                    <div class="rs-field">
                        <label for="jadwalWeek">Pilih minggu</label>
                        <input id="jadwalWeek" type="week" autocomplete="off">
                    </div>
                    <div class="rs-field rs-search-field">
                        <label for="jadwalSearch">Cari dokter atau poliklinik</label>
                        <div class="rs-input-wrap">
                            <i class="bi bi-search"></i>
                            <input id="jadwalSearch" type="search" placeholder="Nama dokter / poli..." autocomplete="off">
                        </div>
                    </div>
                    <div class="rs-field">
                        <label for="jadwalPoli">Poliklinik</label>
                        <select id="jadwalPoli"><option value="">Semua poliklinik</option></select>
                    </div>
                    <div class="rs-field">
                        <label for="jadwalHari">Hari praktik</label>
                        <select id="jadwalHari">
                            <option value="">Semua hari</option>
                            <option>Senin</option><option>Selasa</option><option>Rabu</option>
                            <option>Kamis</option><option>Jumat</option><option>Sabtu</option><option>Minggu</option>
                        </select>
                    </div>
                </div>

                <div class="rs-filter-actions">
                    <button type="button" id="jadwalReset" class="rs-reset-button"><i class="bi bi-arrow-counterclockwise"></i> Reset filter</button>
                    <div class="rs-export-actions">
                        <button type="button" id="jadwalExportCsv" class="rs-button-soft" disabled><i class="bi bi-file-earmark-spreadsheet"></i> Export Excel / CSV</button>
                        {{-- <button type="button" id="jadwalExportPdf" class="rs-button-danger" disabled><i class="bi bi-file-earmark-pdf"></i> Export PDF</button> --}}
                    </div>
                </div>

                <div class="rs-filter-result">
                    <span id="jadwalResultCount" aria-live="polite">Menyiapkan jadwal...</span>
                    <span id="jadwalLastUpdate">Data belum dimuat</span>
                </div>
            </div>

            <div id="jadwalAlert" class="rs-data-alert" hidden role="alert"></div>

            <div class="rs-table-card">
                <div class="rs-table-heading">
                    <div><h3>Daftar Jadwal Praktik</h3><p>Hasil mengikuti minggu yang dipilih dan filter aktif.</p></div>
                    <span class="rs-source-chip"><i class="bi bi-shield-check"></i> Integrasi BPJS</span>
                </div>
                <div class="table-responsive">
                    <table class="table rs-jadwal-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>Dokter</th>
                                <th>Poliklinik</th>
                                <th>Tanggal</th>
                                <th>Hari</th>
                                <th>Waktu Praktik</th>
                                <th class="text-center">Kapasitas</th>
                            </tr>
                        </thead>
                        <tbody id="jadwalTableBody">
                            <tr><td colspan="7"><div class="rs-table-state"><span class="rs-spinner"></span><strong>Memuat jadwal dari BPJS...</strong><small>Mohon tunggu, data minggu terpilih sedang diambil.</small></div></td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="rs-pagination">
                    <span id="jadwalPageInfo">—</span>
                    <div>
                        <button type="button" id="jadwalPrev" class="rs-page-button" disabled><i class="bi bi-chevron-left"></i> Sebelumnya</button>
                        <button type="button" id="jadwalNext" class="rs-page-button" disabled>Berikutnya <i class="bi bi-chevron-right"></i></button>
                    </div>
                </div>
            </div>

            <div class="rs-disclaimer">
                <i class="bi bi-info-circle"></i>
                <p><strong>Informasi:</strong> Jadwal berasal dari data integrasi BPJS yang disediakan oleh endpoint aplikasi. Jadwal dapat berubah. Pastikan jadwal sebelum berkunjung melalui kanal resmi rumah sakit.</p>
            </div>
        </div>
    </section>
</div>
