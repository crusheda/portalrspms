<?php

use Livewire\Component;

new class extends Component {
    public string $search = '';
    public string $poli = '';
    public string $hari = '';
    public int $perPage = 8;

    public function updatedSearch(): void
    {
        // Filter berjalan otomatis saat nilai pencarian berubah.
    }

    public function resetFilter(): void
    {
        $this->reset('search', 'poli', 'hari');
        $this->perPage = 8;
    }

    public function getPoliListProperty(): array
    {
        return collect($this->jadwalDummy())->pluck('poli')->unique()->sort()->values()->all();
    }

    public function getJadwalTampilProperty()
    {
        return collect($this->jadwalDummy())
            ->filter(function (array $item): bool {
                $keyword = mb_strtolower(trim($this->search));

                $cocokSearch = $keyword === '' || str_contains(mb_strtolower($item['dokter']), $keyword) || str_contains(mb_strtolower($item['poli']), $keyword) || str_contains(mb_strtolower($item['spesialis']), $keyword);

                $cocokPoli = $this->poli === '' || $item['poli'] === $this->poli;
                $cocokHari = $this->hari === '' || in_array($this->hari, $item['hari'], true);

                return $cocokSearch && $cocokPoli && $cocokHari;
            })
            ->values();
    }

    public function getTotalJadwalProperty(): int
    {
        return count($this->jadwalDummy());
    }

    private function jadwalDummy(): array
    {
        return [
            ['dokter' => 'dr. Andi Pratama, Sp.PD', 'spesialis' => 'Spesialis Penyakit Dalam', 'poli' => 'Poli Penyakit Dalam', 'hari' => ['Senin', 'Rabu', 'Jumat'], 'jam' => '08.00–11.00', 'warna' => 'green'],
            ['dokter' => 'dr. Siti Rahmawati, Sp.A', 'spesialis' => 'Spesialis Anak', 'poli' => 'Poli Anak', 'hari' => ['Senin', 'Selasa', 'Kamis'], 'jam' => '08.00–10.30', 'warna' => 'blue'],
            ['dokter' => 'dr. Budi Santoso, Sp.OG', 'spesialis' => 'Spesialis Obstetri dan Ginekologi', 'poli' => 'Poli Kebidanan dan Kandungan', 'hari' => ['Selasa', 'Kamis', 'Sabtu'], 'jam' => '09.00–12.00', 'warna' => 'pink'],
            ['dokter' => 'dr. Rina Puspitasari, Sp.JP', 'spesialis' => 'Spesialis Jantung dan Pembuluh Darah', 'poli' => 'Poli Jantung', 'hari' => ['Senin', 'Rabu'], 'jam' => '13.00–15.00', 'warna' => 'red'],
            ['dokter' => 'dr. Dimas Nugroho, Sp.S', 'spesialis' => 'Spesialis Saraf', 'poli' => 'Poli Saraf', 'hari' => ['Selasa', 'Jumat'], 'jam' => '10.00–12.00', 'warna' => 'purple'],
            ['dokter' => 'dr. Maya Lestari, Sp.M', 'spesialis' => 'Spesialis Mata', 'poli' => 'Poli Mata', 'hari' => ['Senin', 'Kamis'], 'jam' => '08.30–11.30', 'warna' => 'teal'],
            ['dokter' => 'dr. Fajar Wibowo, Sp.THT-KL', 'spesialis' => 'Spesialis THT-KL', 'poli' => 'Poli THT', 'hari' => ['Rabu', 'Sabtu'], 'jam' => '09.00–11.00', 'warna' => 'orange'],
            ['dokter' => 'dr. Nabila Putri, Sp.KK', 'spesialis' => 'Spesialis Kulit dan Kelamin', 'poli' => 'Poli Kulit dan Kelamin', 'hari' => ['Selasa', 'Kamis'], 'jam' => '13.00–15.00', 'warna' => 'pink'],
            ['dokter' => 'dr. Arif Setiawan, Sp.B', 'spesialis' => 'Spesialis Bedah', 'poli' => 'Poli Bedah', 'hari' => ['Senin', 'Jumat'], 'jam' => '09.00–12.00', 'warna' => 'green'],
            ['dokter' => 'dr. Citra Maharani, Sp.P', 'spesialis' => 'Spesialis Paru', 'poli' => 'Poli Paru', 'hari' => ['Rabu', 'Jumat'], 'jam' => '08.00–10.00', 'warna' => 'blue'],
            ['dokter' => 'dr. Yoga Permana, Sp.U', 'spesialis' => 'Spesialis Urologi', 'poli' => 'Poli Urologi', 'hari' => ['Selasa', 'Sabtu'], 'jam' => '10.00–12.00', 'warna' => 'purple'],
            ['dokter' => 'dr. Intan Permata, Sp.GK', 'spesialis' => 'Spesialis Gizi Klinik', 'poli' => 'Poli Gizi Klinik', 'hari' => ['Kamis', 'Sabtu'], 'jam' => '08.30–11.00', 'warna' => 'teal'],
        ];
    }
};
?>

<div>
    <section class="rs-page-hero">
        <div class="rs-container">
            <div class="rs-page-hero-content">
                <div class="rs-eyebrow"><i class="bi bi-calendar2-week"></i> INFORMASI PELAYANAN</div>
                <h1>Jadwal Dokter</h1>
                <p>Temukan jadwal praktik dokter berdasarkan nama, poliklinik, dan hari praktik untuk membantu
                    merencanakan kunjungan Anda.</p>
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
                    <div class="rs-section-label">Cari Layanan</div>
                    <h2>Temukan Dokter Anda</h2>
                    <p>Gunakan pencarian dan filter untuk menemukan jadwal yang sesuai.</p>
                </div>
                <div class="rs-demo-badge"><i class="bi bi-info-circle"></i> Data simulasi / dummy</div>
            </div>

            <div class="rs-schedule-stats">
                <div class="rs-schedule-stat">
                    <span class="rs-stat-icon"><i class="bi bi-person-badge"></i></span>
                    <div><small>Dokter pada contoh</small><strong>{{ $this->totalJadwal }}</strong></div>
                </div>
                <div class="rs-schedule-stat">
                    <span class="rs-stat-icon"><i class="bi bi-hospital"></i></span>
                    <div><small>Poliklinik</small><strong>{{ count($this->poliList) }}</strong></div>
                </div>
                <div class="rs-schedule-stat">
                    <span class="rs-stat-icon"><i class="bi bi-calendar-check"></i></span>
                    <div><small>Hari praktik</small><strong>6 hari</strong></div>
                </div>
            </div>

            <div class="rs-filter-panel">
                <div class="rs-filter-grid">
                    <div class="rs-field rs-search-field">
                        <label for="doctorSearch">Cari dokter atau spesialis</label>
                        <div class="rs-input-wrap">
                            <i class="bi bi-search"></i>
                            <input id="doctorSearch" type="search" wire:model.live.debounce.300ms="search"
                                placeholder="Contoh: penyakit dalam..." autocomplete="off">
                        </div>
                    </div>
                    <div class="rs-field">
                        <label for="poliFilter">Poliklinik</label>
                        <select id="poliFilter" wire:model.live="poli">
                            <option value="">Semua poliklinik</option>
                            @foreach ($this->poliList as $namaPoli)
                                <option value="{{ $namaPoli }}">{{ $namaPoli }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="rs-field">
                        <label for="dayFilter">Hari praktik</label>
                        <select id="dayFilter" wire:model.live="hari">
                            <option value="">Semua hari</option>
                            @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $namaHari)
                                <option value="{{ $namaHari }}">{{ $namaHari }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="rs-filter-action">
                        <button type="button" class="rs-reset-button" wire:click="resetFilter">
                            <i class="bi bi-arrow-counterclockwise"></i> Reset
                        </button>
                    </div>
                </div>
                <div class="rs-filter-result" aria-live="polite">
                    <span><i class="bi bi-funnel"></i> {{ $this->jadwalTampil->count() }} jadwal ditemukan</span>
                    <span>Perubahan filter ditampilkan otomatis</span>
                </div>
            </div>

            @if ($this->jadwalTampil->isEmpty())
                <div class="rs-no-results">
                    <i class="bi bi-search"></i>
                    <h3>Jadwal tidak ditemukan</h3>
                    <p>Coba ubah kata kunci atau pilih filter yang berbeda.</p>
                    <button type="button" class="rs-button-primary" wire:click="resetFilter">Tampilkan semua
                        jadwal</button>
                </div>
            @else
                <div class="rs-doctor-grid">
                    @foreach ($this->jadwalTampil as $index => $item)
                        <article class="rs-doctor-card" wire:key="doctor-{{ $index }}">
                            <div class="rs-doctor-card-top">
                                <div class="rs-doctor-avatar tone-{{ $item['warna'] }}">
                                    {{ collect(explode(' ', str_replace(['dr.', ','], '', $item['dokter'])))->filter()->take(2)->map(fn($word) => mb_substr($word, 0, 1))->implode('') }}
                                </div>
                                <span class="rs-demo-tag">Contoh</span>
                            </div>
                            <div class="rs-doctor-info">
                                <h3>{{ $item['dokter'] }}</h3>
                                <p>{{ $item['spesialis'] }}</p>
                                <div class="rs-doctor-poli"><i class="bi bi-hospital"></i> {{ $item['poli'] }}</div>
                            </div>
                            <div class="rs-doctor-schedule">
                                <div class="rs-schedule-line"><i class="bi bi-calendar3"></i>
                                    <div><small>Hari praktik</small><strong>{{ implode(', ', $item['hari']) }}</strong>
                                    </div>
                                </div>
                                <div class="rs-schedule-line"><i class="bi bi-clock"></i>
                                    <div><small>Jam praktik</small><strong>{{ $item['jam'] }} WIB</strong></div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif

            <div class="rs-disclaimer">
                <i class="bi bi-exclamation-triangle"></i>
                <p><strong>Perhatian:</strong> Seluruh nama dokter, poliklinik, dan jadwal pada halaman ini adalah data
                    dummy untuk pengembangan antarmuka, bukan jadwal resmi rumah sakit. Jangan gunakan untuk menentukan
                    kunjungan pasien sebelum data resmi diintegrasikan.</p>
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
        max-width: 780px
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

    .rs-schedule-intro {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 18px;
        margin-bottom: 24px
    }

    .rs-schedule-intro h2 {
        margin: 8px 0;
        color: #173f32;
        font-size: clamp(1.5rem, 3vw, 2rem);
        font-weight: 700
    }

    .rs-schedule-intro p {
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

    .rs-schedule-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 24px
    }

    .rs-schedule-stat {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 19px;
        border: 1px solid #e4eee8;
        border-radius: 17px;
        background: #fff
    }

    .rs-stat-icon {
        display: grid;
        place-items: center;
        flex: 0 0 44px;
        width: 44px;
        height: 44px;
        border-radius: 14px;
        background: #e8f6ef;
        color: #087f5b;
        font-size: 1.25rem
    }

    .rs-schedule-stat small {
        display: block;
        color: #718078;
        font-size: .82rem
    }

    .rs-schedule-stat strong {
        display: block;
        margin-top: 3px;
        color: #193e31;
        font-size: 1.35rem
    }

    .rs-filter-panel {
        padding: 22px;
        margin-bottom: 26px;
        border: 1px solid #e2ece6;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 8px 28px rgba(18, 61, 48, .035)
    }

    .rs-filter-grid {
        display: grid;
        grid-template-columns: minmax(220px, 1.4fr) minmax(190px, 1fr) minmax(150px, .75fr) auto;
        align-items: end;
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
        min-height: 46px;
        padding: 10px 15px;
        border: 1px solid #dbe6df;
        border-radius: 11px;
        background: #f8faf9;
        color: #436052;
        font: inherit;
        font-weight: 600;
        cursor: pointer
    }

    .rs-reset-button:hover {
        background: #edf6f1
    }

    .rs-filter-result {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        margin-top: 18px;
        padding-top: 15px;
        border-top: 1px solid #edf2ee;
        color: #718078;
        font-size: .82rem
    }

    .rs-filter-result span:first-child {
        color: #087f5b;
        font-weight: 600
    }

    .rs-doctor-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px
    }

    .rs-doctor-card {
        overflow: hidden;
        border: 1px solid #e3ece6;
        border-radius: 19px;
        background: #fff;
        transition: transform .18s ease, border-color .18s ease
    }

    .rs-doctor-card:hover {
        transform: translateY(-3px);
        border-color: #b9d8c7
    }

    .rs-doctor-card-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 19px 19px 0
    }

    .rs-doctor-avatar {
        display: grid;
        place-items: center;
        width: 54px;
        height: 54px;
        border-radius: 17px;
        font-size: 1.05rem;
        font-weight: 700
    }

    .tone-green {
        background: #e1f4e9;
        color: #087f5b
    }

    .tone-blue {
        background: #e6f1ff;
        color: #2863a6
    }

    .tone-pink {
        background: #ffebf1;
        color: #a83c69
    }

    .tone-red {
        background: #ffebeb;
        color: #b73e3e
    }

    .tone-purple {
        background: #f0eaff;
        color: #7045a3
    }

    .tone-teal {
        background: #e1f7f4;
        color: #187c72
    }

    .tone-orange {
        background: #fff0df;
        color: #a85d13
    }

    .rs-demo-tag {
        padding: 5px 8px;
        border-radius: 7px;
        background: #f4f6f5;
        color: #7a8981;
        font-size: .7rem;
        font-weight: 600
    }

    .rs-doctor-info {
        padding: 15px 19px 17px
    }

    .rs-doctor-info h3 {
        margin: 0 0 5px;
        color: #214737;
        font-size: 1.04rem;
        font-weight: 700
    }

    .rs-doctor-info>p {
        min-height: 38px;
        margin: 0 0 13px;
        color: #718078;
        font-size: .85rem;
        line-height: 1.5
    }

    .rs-doctor-poli {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        color: #087f5b;
        font-size: .82rem;
        font-weight: 600
    }

    .rs-doctor-poli i {
        margin-top: 2px
    }

    .rs-doctor-schedule {
        display: grid;
        gap: 13px;
        padding: 16px 19px;
        border-top: 1px solid #edf2ee;
        background: #fbfdfb
    }

    .rs-schedule-line {
        display: flex;
        align-items: flex-start;
        gap: 11px
    }

    .rs-schedule-line>i {
        margin-top: 3px;
        color: #5a9477
    }

    .rs-schedule-line small {
        display: block;
        color: #849189;
        font-size: .75rem
    }

    .rs-schedule-line strong {
        display: block;
        margin-top: 2px;
        color: #405a4c;
        font-size: .82rem;
        line-height: 1.5
    }

    .rs-no-results {
        padding: 48px 20px;
        text-align: center;
        border: 1px dashed #cbded3;
        border-radius: 20px
    }

    .rs-no-results>i {
        color: #82a795;
        font-size: 2rem
    }

    .rs-no-results h3 {
        margin: 13px 0 8px;
        color: #29483a
    }

    .rs-no-results p {
        color: #718078
    }

    .rs-disclaimer {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-top: 24px;
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
        .rs-filter-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr))
        }

        .rs-doctor-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr))
        }
    }

    @media(max-width:575px) {
        .rs-page-hero {
            padding: 38px 0 32px
        }

        .rs-schedule-intro {
            align-items: flex-start;
            flex-direction: column
        }

        .rs-schedule-stats {
            gap: 9px
        }

        .rs-schedule-stat {
            align-items: flex-start;
            flex-direction: column;
            padding: 13px;
            gap: 8px
        }

        .rs-schedule-stat small {
            font-size: .72rem
        }

        .rs-schedule-stat strong {
            font-size: 1.2rem
        }

        .rs-filter-panel {
            padding: 15px
        }

        .rs-filter-grid {
            grid-template-columns: 1fr
        }

        .rs-filter-result {
            flex-direction: column
        }

        .rs-doctor-grid {
            grid-template-columns: 1fr
        }
    }

    @media(prefers-reduced-motion:reduce) {
        .rs-doctor-card {
            transition: none
        }

        .rs-doctor-card:hover {
            transform: none
        }
    }
</style>
