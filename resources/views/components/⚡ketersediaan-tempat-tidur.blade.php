<?php

use Livewire\Component;

new class extends Component {
    public string $search = '';
    public string $status = '';
    public string $gedung = '';

    public function resetFilter(): void
    {
        $this->reset('search', 'status', 'gedung');
    }

    public function getRuangListProperty(): array
    {
        return collect($this->dataDummy())->pluck('gedung')->unique()->sort()->values()->all();
    }

    public function getDataTampilProperty()
    {
        return collect($this->dataDummy())
            ->filter(function (array $item): bool {
                $keyword = mb_strtolower(trim($this->search));
                $cocokSearch = $keyword === '' || str_contains(mb_strtolower($item['ruang']), $keyword) || str_contains(mb_strtolower($item['gedung']), $keyword);
                $cocokGedung = $this->gedung === '' || $item['gedung'] === $this->gedung;
                $cocokStatus = $this->status === '' || $item['status'] === $this->status;

                return $cocokSearch && $cocokGedung && $cocokStatus;
            })
            ->values();
    }

    public function getRingkasanProperty(): array
    {
        $data = collect($this->dataDummy());

        return [
            'total' => $data->sum('total'),
            'terisi' => $data->sum('terisi'),
            'tersedia' => $data->sum('tersedia'),
            'ruang' => $data->count(),
        ];
    }

    private function dataDummy(): array
    {
        return [
            ['ruang' => 'Mawar', 'gedung' => 'Gedung A', 'kelas' => 'Kelas I', 'total' => 24, 'terisi' => 18, 'tersedia' => 6, 'status' => 'Tersedia', 'update' => '14:20 WIB'],
            ['ruang' => 'Melati', 'gedung' => 'Gedung A', 'kelas' => 'Kelas II', 'total' => 30, 'terisi' => 26, 'tersedia' => 4, 'status' => 'Terbatas', 'update' => '14:20 WIB'],
            ['ruang' => 'Anggrek', 'gedung' => 'Gedung B', 'kelas' => 'Kelas I', 'total' => 20, 'terisi' => 20, 'tersedia' => 0, 'status' => 'Penuh', 'update' => '14:18 WIB'],
            ['ruang' => 'Dahlia', 'gedung' => 'Gedung B', 'kelas' => 'Kelas III', 'total' => 32, 'terisi' => 23, 'tersedia' => 9, 'status' => 'Tersedia', 'update' => '14:19 WIB'],
            ['ruang' => 'Perinatal', 'gedung' => 'Gedung C', 'kelas' => 'Khusus', 'total' => 12, 'terisi' => 8, 'tersedia' => 4, 'status' => 'Tersedia', 'update' => '14:16 WIB'],
            ['ruang' => 'Isolasi', 'gedung' => 'Gedung C', 'kelas' => 'Isolasi', 'total' => 10, 'terisi' => 7, 'tersedia' => 3, 'status' => 'Terbatas', 'update' => '14:17 WIB'],
            ['ruang' => 'ICU', 'gedung' => 'Gedung D', 'kelas' => 'Intensif', 'total' => 8, 'terisi' => 7, 'tersedia' => 1, 'status' => 'Terbatas', 'update' => '14:15 WIB'],
            ['ruang' => 'HCU', 'gedung' => 'Gedung D', 'kelas' => 'Intensif', 'total' => 6, 'terisi' => 4, 'tersedia' => 2, 'status' => 'Tersedia', 'update' => '14:15 WIB'],
        ];
    }
};
?>

<div>
    <section class="rs-page-hero">
        <div class="rs-container">
            <div class="rs-page-hero-content">
                <div class="rs-eyebrow"><i class="bi bi-hospital"></i> INFORMASI RAWAT INAP</div>
                <h1>Ketersediaan Tempat Tidur</h1>
                <p>Lihat ringkasan kapasitas dan ketersediaan tempat tidur rawat inap berdasarkan ruang perawatan.</p>
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
                    <div class="rs-section-label">Ringkasan Kapasitas</div>
                    <h2>Informasi Tempat Tidur Rawat Inap</h2>
                    <p>Contoh tampilan dashboard ketersediaan tempat tidur rumah sakit.</p>
                </div>
                <div class="rs-demo-badge"><i class="bi bi-info-circle"></i> Data simulasi / dummy</div>
            </div>

            <div class="rs-beds-summary">
                <article class="rs-beds-summary-card">
                    <div class="rs-beds-summary-top"><span>Total Tempat Tidur</span><i class="bi bi-hospital"></i></div>
                    <strong>{{ $this->ringkasan['total'] }}</strong>
                    <small>Akumulasi seluruh ruang contoh</small>
                </article>
                <article class="rs-beds-summary-card">
                    <div class="rs-beds-summary-top"><span>Tempat Tidur Terisi</span><i class="bi bi-person-fill"></i>
                    </div>
                    <strong>{{ $this->ringkasan['terisi'] }}</strong>
                    <small>Dalam contoh data simulasi</small>
                </article>
                <article class="rs-beds-summary-card available">
                    <div class="rs-beds-summary-top"><span>Tempat Tidur Tersedia</span><i
                            class="bi bi-check-circle"></i></div>
                    <strong>{{ $this->ringkasan['tersedia'] }}</strong>
                    <small>Dalam contoh data simulasi</small>
                </article>
                <article class="rs-beds-summary-card">
                    <div class="rs-beds-summary-top"><span>Ruang Perawatan</span><i class="bi bi-door-open"></i></div>
                    <strong>{{ $this->ringkasan['ruang'] }}</strong>
                    <small>Ruang contoh pada halaman</small>
                </article>
            </div>

            <div class="rs-occupancy-panel">
                <div class="rs-occupancy-heading">
                    <div>
                        <h3>Gambaran Penggunaan Kapasitas</h3>
                        <p>Perbandingan tempat tidur terisi dan tersedia dari data dummy.</p>
                    </div>
                    <strong>{{ $this->ringkasan['total'] > 0 ? round(($this->ringkasan['terisi'] / $this->ringkasan['total']) * 100) : 0 }}%
                        terisi</strong>
                </div>
                <div class="rs-occupancy-track" role="img" aria-label="Proporsi tempat tidur terisi dan tersedia">
                    <span class="occupied"
                        style="width: {{ $this->ringkasan['total'] > 0 ? ($this->ringkasan['terisi'] / $this->ringkasan['total']) * 100 : 0 }}%"></span>
                    <span class="available"
                        style="width: {{ $this->ringkasan['total'] > 0 ? ($this->ringkasan['tersedia'] / $this->ringkasan['total']) * 100 : 0 }}%"></span>
                </div>
                <div class="rs-occupancy-legend">
                    <span><i class="occupied-dot"></i> Terisi ({{ $this->ringkasan['terisi'] }})</span>
                    <span><i class="available-dot"></i> Tersedia ({{ $this->ringkasan['tersedia'] }})</span>
                </div>
            </div>

            <div class="rs-bed-filter">
                <div class="rs-bed-filter-title">
                    <div>
                        <h3>Rincian Ruang Perawatan</h3>
                        <p>Gunakan filter untuk mencari ruang dan status.</p>
                    </div>
                    <button type="button" wire:click="resetFilter" class="rs-reset-button"><i
                            class="bi bi-arrow-counterclockwise"></i> Reset filter</button>
                </div>
                <div class="rs-bed-filter-grid">
                    <div class="rs-field">
                        <label for="roomSearch">Cari ruang perawatan</label>
                        <div class="rs-input-wrap"><i class="bi bi-search"></i><input id="roomSearch" type="search"
                                wire:model.live.debounce.300ms="search" placeholder="Contoh: Mawar..."
                                autocomplete="off"></div>
                    </div>
                    <div class="rs-field">
                        <label for="buildingFilter">Gedung</label>
                        <select id="buildingFilter" wire:model.live="gedung">
                            <option value="">Semua gedung</option>
                            @foreach ($this->ruangList as $namaGedung)
                                <option value="{{ $namaGedung }}">{{ $namaGedung }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="rs-field">
                        <label for="statusFilter">Status ketersediaan</label>
                        <select id="statusFilter" wire:model.live="status">
                            <option value="">Semua status</option>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Terbatas">Terbatas</option>
                            <option value="Penuh">Penuh</option>
                        </select>
                    </div>
                </div>
                <div class="rs-filter-result" aria-live="polite">{{ $this->dataTampil->count() }} ruang ditemukan</div>
            </div>

            <div class="rs-bed-table-card">
                <div class="table-responsive">
                    <table class="table rs-bed-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Ruang Perawatan</th>
                                <th>Gedung / Kelas</th>
                                <th class="text-center">Kapasitas</th>
                                <th class="text-center">Terisi</th>
                                <th class="text-center">Tersedia</th>
                                <th>Status</th>
                                <th>Pembaruan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($this->dataTampil as $index => $item)
                                <tr wire:key="bed-room-{{ $index }}">
                                    <td><strong class="rs-room-name">{{ $item['ruang'] }}</strong></td>
                                    <td><span class="rs-room-building">{{ $item['gedung'] }}</span><small
                                            class="rs-room-class">{{ $item['kelas'] }}</small></td>
                                    <td class="text-center">{{ $item['total'] }}</td>
                                    <td class="text-center">{{ $item['terisi'] }}</td>
                                    <td class="text-center"><strong
                                            class="{{ $item['tersedia'] > 0 ? 'rs-available-number' : 'rs-full-number' }}">{{ $item['tersedia'] }}</strong>
                                    </td>
                                    <td><span
                                            class="rs-status status-{{ \Illuminate\Support\Str::slug($item['status']) }}"><i></i>{{ $item['status'] }}</span>
                                    </td>
                                    <td><small class="rs-updated"><i class="bi bi-clock"></i>
                                            {{ $item['update'] }}</small></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="rs-bed-empty"><i class="bi bi-search"></i><strong>Data tidak
                                                ditemukan</strong><span>Coba ubah kata kunci atau filter Anda.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="rs-disclaimer">
                <i class="bi bi-exclamation-triangle"></i>
                <p><strong>Perhatian:</strong> Seluruh nama ruang, kapasitas, status, dan waktu pembaruan di halaman ini
                    adalah data dummy untuk pengembangan antarmuka. Angka bukan kondisi aktual RS PKU Muhammadiyah
                    Sukoharjo dan tidak boleh digunakan untuk keputusan perawatan atau rujukan.</p>
            </div>
        </div>
    </section>
</div>

<style>
    .rs-page-hero {
        padding: 54px 0 44px;
        background: linear-gradient(120deg, #e9f7f0, #f8fbf9 60%, #eaf5f1);
        border-bottom: 1px solid #e2eee7
    }

    .rs-page-hero-content {
        max-width: 820px
    }

    .rs-page-hero h1 {
        margin: 14px 0 12px;
        color: #123d30;
        font-size: clamp(2rem, 4vw, 3.1rem);
        font-weight: 700;
        letter-spacing: -1.2px
    }

    .rs-page-hero-content>p {
        color: #60736b;
        line-height: 1.8
    }

    .rs-breadcrumb {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 22px;
        font-size: .9rem;
        color: #6b7e75
    }

    .rs-breadcrumb a {
        color: #087f5b;
        text-decoration: none;
        font-weight: 600
    }

    .rs-beds-heading {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 18px;
        margin-bottom: 24px
    }

    .rs-beds-heading h2 {
        margin: 8px 0;
        color: #173f32;
        font-size: clamp(1.5rem, 3vw, 2rem);
        font-weight: 700
    }

    .rs-beds-heading p {
        margin: 0;
        color: #687a72
    }

    .rs-demo-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 13px;
        border-radius: 999px;
        background: #fff4dc;
        color: #875b08;
        font-size: .82rem;
        font-weight: 600;
        white-space: nowrap
    }

    .rs-beds-summary {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 15px;
        margin-bottom: 22px
    }

    .rs-beds-summary-card {
        padding: 20px;
        border: 1px solid #e3ece6;
        border-radius: 18px;
        background: #fff
    }

    .rs-beds-summary-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 8px;
        color: #687a72;
        font-size: .82rem
    }

    .rs-beds-summary-top i {
        color: #579477;
        font-size: 1.2rem
    }

    .rs-beds-summary-card>strong {
        display: block;
        margin: 13px 0 5px;
        color: #193e31;
        font-size: 2rem;
        font-weight: 700
    }

    .rs-beds-summary-card>small {
        color: #89968f;
        font-size: .76rem
    }

    .rs-beds-summary-card.available {
        border-color: #b9dfc8;
        background: #f7fcf8
    }

    .rs-occupancy-panel {
        padding: 23px;
        margin-bottom: 25px;
        border: 1px solid #e3ece6;
        border-radius: 19px;
        background: #fff
    }

    .rs-occupancy-heading {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 15px
    }

    .rs-occupancy-heading h3,
    .rs-bed-filter-title h3 {
        margin: 0 0 6px;
        color: #214737;
        font-size: 1.05rem;
        font-weight: 700
    }

    .rs-occupancy-heading p,
    .rs-bed-filter-title p {
        margin: 0;
        color: #718078;
        font-size: .85rem;
        line-height: 1.6
    }

    .rs-occupancy-heading>strong {
        color: #087f5b;
        white-space: nowrap
    }

    .rs-occupancy-track {
        display: flex;
        overflow: hidden;
        height: 13px;
        margin: 20px 0 13px;
        border-radius: 99px;
        background: #edf2ee
    }

    .rs-occupancy-track .occupied {
        background: #e6a23c
    }

    .rs-occupancy-track .available {
        background: #39a875
    }

    .rs-occupancy-legend {
        display: flex;
        gap: 22px;
        flex-wrap: wrap;
        color: #687a72;
        font-size: .82rem
    }

    .rs-occupancy-legend span {
        display: flex;
        align-items: center;
        gap: 8px
    }

    .occupied-dot,
    .available-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: #e6a23c
    }

    .available-dot {
        background: #39a875
    }

    .rs-bed-filter {
        padding: 22px;
        margin-bottom: 20px;
        border: 1px solid #e3ece6;
        border-radius: 19px;
        background: #fff
    }

    .rs-bed-filter-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 18px
    }

    .rs-bed-filter-grid {
        display: grid;
        grid-template-columns: 1.3fr 1fr 1fr;
        gap: 14px
    }

    .rs-field label {
        display: block;
        margin-bottom: 8px;
        color: #42594e;
        font-size: .85rem;
        font-weight: 600
    }

    .rs-field input,
    .rs-field select {
        width: 100%;
        min-height: 46px;
        padding: 10px 13px;
        border: 1px solid #dbe6df;
        border-radius: 11px;
        background: #fff;
        color: #29483a;
        font: inherit;
        outline: none
    }

    .rs-field input:focus,
    .rs-field select:focus {
        border-color: #49a782;
        box-shadow: 0 0 0 3px rgba(8, 127, 91, .1)
    }

    .rs-input-wrap {
        position: relative
    }

    .rs-input-wrap>i {
        position: absolute;
        top: 50%;
        left: 14px;
        transform: translateY(-50%);
        color: #819087
    }

    .rs-input-wrap input {
        padding-left: 40px
    }

    .rs-reset-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 42px;
        padding: 9px 13px;
        border: 1px solid #dbe6df;
        border-radius: 10px;
        background: #f8faf9;
        color: #436052;
        font: inherit;
        font-size: .85rem;
        font-weight: 600;
        cursor: pointer
    }

    .rs-reset-button:hover {
        background: #edf6f1
    }

    .rs-filter-result {
        margin-top: 14px;
        color: #087f5b;
        font-size: .82rem;
        font-weight: 600
    }

    .rs-bed-table-card {
        overflow: hidden;
        border: 1px solid #e3ece6;
        border-radius: 19px;
        background: #fff
    }

    .rs-bed-table {
        min-width: 760px
    }

    .rs-bed-table thead th {
        padding: 15px 18px;
        background: #f7faf8;
        color: #62746a;
        font-size: .78rem;
        font-weight: 700;
        white-space: nowrap;
        border-bottom: 1px solid #e8efea
    }

    .rs-bed-table tbody td {
        padding: 16px 18px;
        color: #42594e;
        font-size: .86rem;
        border-color: #edf2ee
    }

    .rs-room-name {
        color: #244b39
    }

    .rs-room-building,
    .rs-room-class {
        display: block
    }

    .rs-room-building {
        color: #42594e
    }

    .rs-room-class {
        margin-top: 3px;
        color: #8a968f
    }

    .rs-available-number {
        color: #168653
    }

    .rs-full-number {
        color: #c34f4f
    }

    .rs-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 6px 9px;
        border-radius: 8px;
        font-size: .75rem;
        font-weight: 600;
        white-space: nowrap
    }

    .rs-status i {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor
    }

    .status-tersedia {
        background: #e6f6ec;
        color: #168653
    }

    .status-terbatas {
        background: #fff3dc;
        color: #a56a0a
    }

    .status-penuh {
        background: #ffebeb;
        color: #bd4141
    }

    .rs-updated {
        color: #78877e;
        white-space: nowrap
    }

    .rs-updated i {
        margin-right: 3px
    }

    .rs-bed-empty {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        padding: 40px 16px;
        color: #7b8982;
        text-align: center
    }

    .rs-bed-empty i {
        font-size: 1.8rem;
        color: #82a795
    }

    .rs-bed-empty strong {
        color: #365345
    }

    .rs-bed-empty span {
        font-size: .85rem
    }

    .rs-disclaimer {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-top: 22px;
        padding: 17px;
        border-radius: 14px;
        background: #fff8e8;
        color: #94651a
    }

    .rs-disclaimer>i {
        margin-top: 3px
    }

    .rs-disclaimer p {
        margin: 0;
        color: #715c36;
        font-size: .84rem;
        line-height: 1.75
    }

    @media(max-width:991px) {
        .rs-beds-summary {
            grid-template-columns: repeat(2, minmax(0, 1fr))
        }

        .rs-bed-filter-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr))
        }

        .rs-bed-filter-grid .rs-field:first-child {
            grid-column: 1/-1
        }
    }

    @media(max-width:575px) {
        .rs-page-hero {
            padding: 38px 0 32px
        }

        .rs-beds-heading {
            align-items: flex-start;
            flex-direction: column
        }

        .rs-beds-summary {
            gap: 10px
        }

        .rs-beds-summary-card {
            padding: 15px
        }

        .rs-beds-summary-card>strong {
            font-size: 1.7rem
        }

        .rs-beds-summary-top {
            font-size: .75rem
        }

        .rs-bed-filter {
            padding: 15px
        }

        .rs-bed-filter-title {
            align-items: flex-start;
            flex-direction: column
        }

        .rs-bed-filter-grid {
            grid-template-columns: 1fr
        }

        .rs-bed-filter-grid .rs-field:first-child {
            grid-column: auto
        }

        .rs-occupancy-panel {
            padding: 17px
        }

        .rs-occupancy-heading {
            flex-direction: column
        }
    }
</style>
