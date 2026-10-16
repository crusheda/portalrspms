<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Ketersediaan Tempat Tidur | RS PKU Muhammadiyah Sukoharjo')]
class extends Component {
};

?>

<div data-public-page="ketersediaan-tempat-tidur" data-api-url="{{ url('/api/informasi/tt') }}">
    <section class="rs-page-hero">
        <div class="rs-container">
            <div class="rs-page-hero-content">
                <div class="rs-eyebrow"><i class="bi bi-hospital"></i> INFORMASI RAWAT INAP</div>
                <h1>Ketersediaan Tempat Tidur</h1>
                <p>Pantau ketersediaan tempat tidur berdasarkan informasi ruangan dari sistem rumah sakit.</p>
                <div class="rs-breadcrumb">
                    <a href="{{ route('beranda') }}" wire:navigate>Beranda</a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Ketersediaan Tempat Tidur</span>
                </div>
            </div>
        </div>
    </section>

    <section class="rs-section">
        <div class="rs-container">
            <div class="rs-beds-heading">
                <div>
                    <div class="rs-section-label">Informasi Rawat Inap</div>
                    <h2>Ringkasan Tempat Tidur</h2>
                    <p>Data ketersediaan tempat tidur berdasarkan informasi dari sistem rumah sakit.</p>
                </div>
                <div class="rs-beds-heading-actions">
                    <span class="rs-live-badge"><span class="rs-live-dot"></span> Pembaruan otomatis</span>
                    <button type="button" id="ttRefresh" class="rs-refresh-button"><i class="bi bi-arrow-clockwise"></i> Refresh sekarang</button>
                </div>
            </div>

            <div class="rs-tt-alert" id="ttAlert" hidden role="alert"></div>

            <div class="rs-beds-summary">
                <article class="rs-beds-summary-card">
                    <div class="rs-beds-summary-top"><span>Total Tempat Tidur</span><i class="bi bi-hospital"></i></div>
                    <strong id="ttTotal">—</strong>
                    <small>Seluruh bed yang diterima dari API</small>
                </article>
                <article class="rs-beds-summary-card available">
                    <div class="rs-beds-summary-top"><span>Tersedia</span><i class="bi bi-check-circle"></i></div>
                    <strong id="ttAvailable">—</strong>
                    <small>Status API = 1</small>
                </article>
                <article class="rs-beds-summary-card reserved">
                    <div class="rs-beds-summary-top"><span>Terpesan</span><i class="bi bi-calendar-check"></i></div>
                    <strong id="ttReserved">—</strong>
                    <small>Status API = 2</small>
                </article>
                <article class="rs-beds-summary-card occupied">
                    <div class="rs-beds-summary-top"><span>Terisi</span><i class="bi bi-person-fill"></i></div>
                    <strong id="ttOccupied">—</strong>
                    <small>Status API = 3</small>
                </article>
            </div>

            <div class="rs-occupancy-panel">
                <div class="rs-occupancy-heading">
                    <div><h3>Distribusi Status Tempat Tidur</h3><p>Proporsi dihitung dari seluruh data yang dikembalikan oleh API.</p></div>
                    <strong id="ttPercent">—</strong>
                </div>
                <div class="rs-occupancy-track" id="ttOccupancyTrack" role="img" aria-label="Distribusi status tempat tidur">
                    <span class="available" id="ttBarAvailable" style="width:0"></span>
                    <span class="reserved" id="ttBarReserved" style="width:0"></span>
                    <span class="occupied" id="ttBarOccupied" style="width:0"></span>
                    <span class="unknown" id="ttBarUnknown" style="width:0"></span>
                </div>
                <div class="rs-occupancy-legend">
                    <span><i class="available-dot"></i> Tersedia (<b id="ttLegendAvailable">—</b>)</span>
                    <span><i class="reserved-dot"></i> Terpesan (<b id="ttLegendReserved">—</b>)</span>
                    <span><i class="occupied-dot"></i> Terisi (<b id="ttLegendOccupied">—</b>)</span>
                    <span><i class="unknown-dot"></i> Lainnya (<b id="ttLegendUnknown">—</b>)</span>
                </div>
            </div>

            <div class="rs-bed-filter">
                <div class="rs-bed-filter-title">
                    <div><h3>Rincian Tempat Tidur</h3><p>Cari berdasarkan ruangan, kamar, atau label tempat tidur.</p></div>
                    <div class="rs-update-state"><i class="bi bi-clock-history"></i><span id="ttUpdatedAt">Belum diperbarui</span></div>
                </div>
                <div class="rs-bed-filter-grid">
                    <div class="rs-field">
                        <label for="ttSearch">Pencarian</label>
                        <div class="rs-input-wrap"><i class="bi bi-search"></i><input id="ttSearch" type="search" placeholder="Cari ruangan / kamar / bed..." autocomplete="off"></div>
                    </div>
                    <div class="rs-field">
                        <label for="ttStatusFilter">Status tempat tidur</label>
                        <select id="ttStatusFilter">
                            <option value="">Semua status</option>
                            <option value="1">Bed Masih Tersedia</option>
                            <option value="2">Bed Telah Terpesan</option>
                            <option value="3">Bed Telah Terisi</option>
                            <option value="other">Status lainnya</option>
                        </select>
                    </div>
                    <div class="rs-field">
                        <label for="ttRoomFilter">Ruangan</label>
                        <select id="ttRoomFilter"><option value="">Semua ruangan</option></select>
                    </div>
                </div>
                <div class="rs-bed-filter-footer">
                    <span id="ttResultCount" aria-live="polite">Memuat data...</span>
                    <span>Refresh berikutnya dalam <strong id="ttCountdown">60</strong> detik</span>
                </div>
            </div>

            <div class="rs-bed-table-card">
                <div class="table-responsive">
                    <table class="table rs-bed-table align-middle mb-0">
                        <thead>
                            <tr><th class="text-center">No.</th><th>Ruangan</th><th>Kamar</th><th>Tempat Tidur</th><th>Status</th></tr>
                        </thead>
                        <tbody id="ttTableBody">
                            <tr><td colspan="5"><div class="rs-bed-empty"><span class="rs-spinner"></span><strong>Memuat informasi tempat tidur...</strong></div></td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="rs-pagination">
                    <span id="ttPageInfo">—</span>
                    <div>
                        <button type="button" id="ttPrev" class="rs-page-button" disabled><i class="bi bi-chevron-left"></i> Sebelumnya</button>
                        <button type="button" id="ttNext" class="rs-page-button" disabled>Berikutnya <i class="bi bi-chevron-right"></i></button>
                    </div>
                </div>
            </div>

            <div class="rs-disclaimer">
                <i class="bi bi-info-circle"></i>
                <p><strong>Informasi:</strong> Status mengikuti kode dari endpoint rumah sakit: 1 = tersedia, 2 = terpesan, dan 3 = terisi sebagaimana implementasi halaman lama. Data diperbarui otomatis setiap 60 detik. Ketersediaan dapat berubah sewaktu-waktu dan bukan konfirmasi pemesanan tempat tidur.</p>
            </div>
        </div>
    </section>
</div>
