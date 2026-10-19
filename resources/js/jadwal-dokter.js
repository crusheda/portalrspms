let jadwalDokterCleanup = null;

function initJadwalDokter() {
    const container = document.querySelector(
        '[data-public-page="jadwal-dokter"]'
    );

    if (!container || container.dataset.initialized === 'true') {
        return;
    }

    container.dataset.initialized = 'true';

    const apiUrl = container.dataset.apiUrl;
    const pdfUrl = container.dataset.pdfUrl;

    const el = {
        alert: container.querySelector('#jadwalAlert'),
        resultCount: container.querySelector('#jadwalResultCount'),
        lastUpdate: container.querySelector('#jadwalLastUpdate'),
        tableBody: container.querySelector('#jadwalTableBody'),
        week: container.querySelector('#jadwalWeek'),
        search: container.querySelector('#jadwalSearch'),
        poli: container.querySelector('#jadwalPoli'),
        hari: container.querySelector('#jadwalHari'),
        reset: container.querySelector('#jadwalReset'),
        exportCsv: container.querySelector('#jadwalExportCsv'),
        exportPdf: container.querySelector('#jadwalExportPdf'),
        pageInfo: container.querySelector('#jadwalPageInfo'),
        prev: container.querySelector('#jadwalPrev'),
        next: container.querySelector('#jadwalNext'),
        countDokter: container.querySelector('#jadwal-count-dokter'),
        countPoli: container.querySelector('#jadwal-count-poli'),
        countTotal: container.querySelector('#jadwal-count-total'),
    };

    const pageSize = 15;

    let allJadwal = [];
    let filteredJadwal = [];
    let currentPage = 1;
    let requestController = null;
    let requestNumber = 0;
    let destroyed = false;

    const hariIndonesia = [
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu',
    ];

    /**
     * Membuat format YYYY-Www berdasarkan tanggal lokal.
     */
    function getCurrentIsoWeek() {
        const date = new Date();

        date.setHours(0, 0, 0, 0);

        // Konversi ke tanggal ISO berdasarkan UTC untuk perhitungan minggu.
        const utcDate = new Date(Date.UTC(
            date.getFullYear(),
            date.getMonth(),
            date.getDate()
        ));

        const day = utcDate.getUTCDay() || 7;

        utcDate.setUTCDate(utcDate.getUTCDate() + 4 - day);

        const isoYear = utcDate.getUTCFullYear();

        const yearStart = new Date(Date.UTC(isoYear, 0, 1));

        const week = Math.ceil(
            (((utcDate - yearStart) / 86400000) + 1) / 7
        );

        return `${isoYear}-W${String(week).padStart(2, '0')}`;
    }

    /**
     * Escape teks sebelum dimasukkan ke HTML.
     */
    function escapeHtml(value) {
        return String(value ?? '').replace(/[&<>"']/g, character => {
            const entities = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;',
            };

            return entities[character];
        });
    }

    /**
     * Normalisasi teks untuk pencarian dan filter.
     */
    function normalize(value) {
        return String(value ?? '')
            .trim()
            .toLocaleLowerCase('id-ID');
    }

    /**
     * Format tanggal YYYY-MM-DD tanpa masalah pergeseran timezone.
     */
    function formatTanggal(value) {
        if (!value) {
            return '-';
        }

        const match = String(value).match(
            /^(\d{4})-(\d{2})-(\d{2})$/
        );

        if (!match) {
            return escapeHtml(value);
        }

        const [, year, month, day] = match;

        const date = new Date(
            Number(year),
            Number(month) - 1,
            Number(day)
        );

        return new Intl.DateTimeFormat('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric',
        }).format(date);
    }

    /**
     * Normalisasi nama hari.
     */
    function getHari(row) {
        if (row.namahari) {
            return String(row.namahari).trim();
        }

        const hari = Number(row.hari);

        return hari >= 1 && hari <= 7
            ? hariIndonesia[hari - 1]
            : '-';
    }

    /**
     * Mengurutkan data berdasarkan tanggal, poli, dan dokter.
     */
    function sortJadwal(data) {
        return [...data].sort((a, b) => {
            const tanggal = String(a.tanggal ?? '').localeCompare(
                String(b.tanggal ?? '')
            );

            if (tanggal !== 0) {
                return tanggal;
            }

            const poli = String(a.namapoli ?? '').localeCompare(
                String(b.namapoli ?? ''),
                'id'
            );

            if (poli !== 0) {
                return poli;
            }

            return String(a.namadokter ?? '').localeCompare(
                String(b.namadokter ?? ''),
                'id'
            );
        });
    }

    /**
     * Menampilkan pesan informasi atau error.
     */
    function showAlert(message, type = 'error') {
        if (!el.alert) {
            return;
        }

        el.alert.textContent = message;
        el.alert.hidden = !message;
        el.alert.classList.toggle('is-info', type === 'info');
    }

    /**
     * Menampilkan kondisi kosong pada tabel.
     */
    function renderEmpty(message, detail = '') {
        if (!el.tableBody) {
            return;
        }

        el.tableBody.innerHTML = `
            <tr>
                <td colspan="7">
                    <div class="rs-table-state">
                        <i class="bi bi-calendar-x fs-3"></i>
                        <strong>${escapeHtml(message)}</strong>
                        ${
                            detail
                                ? `<small>${escapeHtml(detail)}</small>`
                                : ''
                        }
                    </div>
                </td>
            </tr>
        `;

        if (el.pageInfo) {
            el.pageInfo.textContent = 'Tidak ada data';
        }

        if (el.prev) {
            el.prev.disabled = true;
        }

        if (el.next) {
            el.next.disabled = true;
        }
    }

    /**
     * Memperbarui statistik berdasarkan seluruh data minggu terpilih.
     */
    function renderStats() {
        const dokter = new Set(
            allJadwal.map(row =>
                String(
                    row.kodedokter ??
                    normalize(row.namadokter)
                )
            ).filter(Boolean)
        );

        const poli = new Set(
            allJadwal.map(row =>
                String(
                    row.kodepoli ??
                    normalize(row.namapoli)
                )
            ).filter(Boolean)
        );

        if (el.countDokter) {
            el.countDokter.textContent =
                dokter.size.toLocaleString('id-ID');
        }

        if (el.countPoli) {
            el.countPoli.textContent =
                poli.size.toLocaleString('id-ID');
        }

        if (el.countTotal) {
            el.countTotal.textContent =
                allJadwal.length.toLocaleString('id-ID');
        }
    }

    /**
     * Mengisi pilihan poliklinik berdasarkan data API.
     */
    function renderPoliOptions() {
        if (!el.poli) {
            return;
        }

        const selectedValue = el.poli.value;

        const polis = new Map();

        allJadwal.forEach(row => {
            const kode = String(row.kodepoli ?? '').trim();

            const nama = String(
                row.namapoli ??
                row.namasubspesialis ??
                kode
            ).trim();

            if (kode) {
                polis.set(kode, nama || kode);
            }
        });

        const options = [...polis.entries()].sort((a, b) =>
            a[1].localeCompare(b[1], 'id')
        );

        el.poli.innerHTML = `
            <option value="">Semua poliklinik</option>
            ${options.map(([kode, nama]) => `
                <option value="${escapeHtml(kode)}">
                    ${escapeHtml(nama)}
                </option>
            `).join('')}
        `;

        if (polis.has(selectedValue)) {
            el.poli.value = selectedValue;
        }
    }

    /**
     * Menghitung filter aktif dan memperbarui tabel.
     */
    function applyFilters() {
        const keyword = normalize(el.search?.value);
        const selectedPoli = String(el.poli?.value ?? '');
        const selectedHari = normalize(el.hari?.value);

        filteredJadwal = allJadwal.filter(row => {
            const dokter = normalize(row.namadokter);
            const namaPoli = normalize(row.namapoli);
            const subspesialis = normalize(row.namasubspesialis);
            const kodePoli = String(row.kodepoli ?? '');

            const matchesKeyword =
                !keyword ||
                dokter.includes(keyword) ||
                namaPoli.includes(keyword) ||
                subspesialis.includes(keyword) ||
                kodePoli.toLowerCase().includes(keyword);

            const matchesPoli =
                !selectedPoli ||
                kodePoli === selectedPoli;

            const matchesHari =
                !selectedHari ||
                normalize(getHari(row)) === selectedHari;

            return (
                matchesKeyword &&
                matchesPoli &&
                matchesHari
            );
        });

        currentPage = 1;

        renderTable();
    }

    /**
     * Merender jadwal ke tabel.
     */
    function renderTable() {
        if (!el.tableBody) {
            return;
        }

        const total = filteredJadwal.length;
        const totalPages = Math.max(
            1,
            Math.ceil(total / pageSize)
        );

        currentPage = Math.min(currentPage, totalPages);

        if (total === 0) {
            renderEmpty(
                allJadwal.length === 0
                    ? 'Jadwal dokter belum tersedia'
                    : 'Jadwal tidak ditemukan',
                allJadwal.length === 0
                    ? 'Belum ada jadwal pada minggu yang dipilih.'
                    : 'Coba ubah kata kunci atau filter pencarian.'
            );

            if (el.resultCount) {
                el.resultCount.textContent = '0 jadwal ditemukan';
            }

            if (el.exportCsv) {
                el.exportCsv.disabled = true;
            }

            if (el.exportPdf) {
                el.exportPdf.disabled = allJadwal.length === 0;
            }

            return;
        }

        const start = (currentPage - 1) * pageSize;
        const end = Math.min(start + pageSize, total);

        const pageData = filteredJadwal.slice(start, end);

        el.tableBody.innerHTML = pageData.map((row, index) => {
            const nomor = start + index + 1;

            const dokter = String(
                row.namadokter ?? 'Nama dokter tidak tersedia'
            ).trim();

            const kodeDokter = row.kodedokter ?? '';

            const namaPoli = String(
                row.namapoli ??
                row.namasubspesialis ??
                row.kodepoli ??
                '-'
            ).trim();

            const tanggal = formatTanggal(row.tanggal);
            const hari = getHari(row);
            const jadwal = String(row.jadwal ?? '-').trim();

            const kapasitas =
                row.kapasitaspasien !== null &&
                row.kapasitaspasien !== undefined &&
                row.kapasitaspasien !== ''
                    ? row.kapasitaspasien
                    : '-';

            return `
                <tr>
                    <td class="text-center">${nomor}</td>

                    <td>
                        <span class="rs-doc-name">
                            ${escapeHtml(dokter)}
                        </span>
                    </td>

                    <td>
                        <span class="rs-poli-tag">
                            ${escapeHtml(namaPoli)}
                        </span>
                    </td>

                    <td>${escapeHtml(tanggal)}</td>

                    <td>${escapeHtml(hari)}</td>

                    <td>
                        <span class="fw-semibold">
                            ${escapeHtml(jadwal)}
                        </span>
                    </td>

                    <td class="text-center">
                        <span class="rs-capacity">
                            ${escapeHtml(kapasitas)}
                        </span>
                    </td>
                </tr>
            `;
        }).join('');

        if (el.resultCount) {
            el.resultCount.textContent =
                `${total.toLocaleString('id-ID')} jadwal ditemukan`;
        }

        if (el.pageInfo) {
            el.pageInfo.textContent =
                `Menampilkan ${start + 1}–${end} dari ${total.toLocaleString('id-ID')} jadwal`;
        }

        if (el.prev) {
            el.prev.disabled = currentPage <= 1;
        }

        if (el.next) {
            el.next.disabled = currentPage >= totalPages;
        }

        if (el.exportCsv) {
            el.exportCsv.disabled = false;
        }

        if (el.exportPdf) {
            el.exportPdf.disabled = allJadwal.length === 0;
        }
    }

    /**
     * Mengambil jadwal dari endpoint Laravel.
     */
    async function loadJadwal() {
        if (destroyed || !apiUrl) {
            return;
        }

        const thisRequest = ++requestNumber;

        // Batalkan request sebelumnya jika pengguna mengganti minggu.
        requestController?.abort();
        requestController = new AbortController();

        if (el.resultCount) {
            el.resultCount.textContent = 'Memuat jadwal dokter...';
        }

        if (el.lastUpdate) {
            el.lastUpdate.textContent = 'Mengambil data dari BPJS...';
        }

        showAlert('');

        if (el.tableBody) {
            el.tableBody.innerHTML = `
                <tr>
                    <td colspan="7">
                        <div class="rs-table-state">
                            <span class="rs-spinner"></span>
                            <strong>Memuat jadwal dari BPJS...</strong>
                            <small>Mohon tunggu, data sedang diproses.</small>
                        </div>
                    </td>
                </tr>
            `;
        }

        try {
            const url = new URL(apiUrl, window.location.origin);

            if (el.week?.value) {
                url.searchParams.set('week', el.week.value);
            }

            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                signal: requestController.signal,
                cache: 'no-store',
            });

            if (destroyed || requestController.signal.aborted) {
                return;
            }

            const result = await response.json();

            if (
                destroyed ||
                requestController.signal.aborted ||
                thisRequest !== requestNumber
            ) {
                return;
            }

            if (!response.ok) {
                throw new Error(
                    result.message ??
                    `Permintaan jadwal gagal dengan HTTP ${response.status}.`
                );
            }

            if (!Array.isArray(result.response)) {
                throw new Error(
                    'Format respons API tidak sesuai. Properti response harus berupa array.'
                );
            }

            allJadwal = sortJadwal(result.response);

            renderStats();
            renderPoliOptions();
            applyFilters();

            if (result.warning) {
                showAlert(result.warning, 'info');
            }

            if (el.lastUpdate) {
                el.lastUpdate.textContent =
                    `Diperbarui ${new Intl.DateTimeFormat('id-ID', {
                        dateStyle: 'medium',
                        timeStyle: 'short',
                    }).format(new Date())}`;
            }
        } catch (error) {
            if (error.name === 'AbortError') {
                return;
            }

            if (thisRequest !== requestNumber || destroyed) {
                return;
            }

            allJadwal = [];
            filteredJadwal = [];

            renderStats();

            showAlert(
                error.message ||
                'Jadwal dokter gagal dimuat. Silakan coba kembali.'
            );

            renderEmpty(
                'Jadwal dokter tidak dapat dimuat',
                'Periksa koneksi dan coba muat ulang data.'
            );

            if (el.resultCount) {
                el.resultCount.textContent = 'Gagal memuat jadwal';
            }

            if (el.lastUpdate) {
                el.lastUpdate.textContent = 'Pembaruan gagal';
            }

            if (el.exportCsv) {
                el.exportCsv.disabled = true;
            }

            if (el.exportPdf) {
                el.exportPdf.disabled = true;
            }
        }
    }

    /**
     * Export CSV berdasarkan hasil filter saat ini.
     */
    function exportCsv() {
        if (!filteredJadwal.length) {
            return;
        }

        const headers = [
            'No.',
            'Nama Dokter',
            'Kode Dokter',
            'Poliklinik',
            'Kode Poli',
            'Tanggal',
            'Hari',
            'Waktu Praktik',
            'Kapasitas Pasien',
        ];

        const rows = filteredJadwal.map((row, index) => [
            index + 1,
            row.namadokter ?? '',
            row.kodedokter ?? '',
            row.namapoli ?? row.namasubspesialis ?? '',
            row.kodepoli ?? '',
            row.tanggal ?? '',
            getHari(row),
            row.jadwal ?? '',
            row.kapasitaspasien ?? '',
        ]);

        const csvEscape = value => {
            let text = String(value ?? '');

            // Mencegah formula injection ketika CSV dibuka di spreadsheet.
            if (/^[\s]*[=+\-@]/.test(text)) {
                text = "'" + text;
            }

            return `"${text.replace(/"/g, '""')}"`;
        };

        const csv = '\uFEFF' + [
            headers,
            ...rows,
        ].map(row =>
            row.map(csvEscape).join(';')
        ).join('\r\n');

        const blob = new Blob([csv], {
            type: 'text/csv;charset=utf-8;',
        });

        const objectUrl = URL.createObjectURL(blob);
        const link = document.createElement('a');

        link.href = objectUrl;
        link.download = `jadwal_dokter_${el.week?.value || getCurrentIsoWeek()}.csv`;

        document.body.appendChild(link);
        link.click();
        link.remove();

        URL.revokeObjectURL(objectUrl);
    }

    /**
     * Export PDF melalui endpoint Laravel.
     */
    function exportPdf() {
        if (!pdfUrl || !allJadwal.length) {
            return;
        }

        const url = new URL(pdfUrl, window.location.origin);

        if (el.week?.value) {
            url.searchParams.set('week', el.week.value);
        }

        window.location.assign(url.toString());
    }

    /**
     * Reset semua filter.
     */
    function resetFilters() {
        if (el.search) {
            el.search.value = '';
        }

        if (el.poli) {
            el.poli.value = '';
        }

        if (el.hari) {
            el.hari.value = '';
        }

        applyFilters();
    }

    /**
     * Daftarkan event dengan cleanup agar tidak menumpuk
     * ketika navigasi Livewire wire:navigate dilakukan.
     */
    const listeners = [];

    function listen(element, event, callback) {
        if (!element) {
            return;
        }

        element.addEventListener(event, callback);

        listeners.push(() => {
            element.removeEventListener(event, callback);
        });
    }

    listen(el.week, 'change', loadJadwal);

    listen(el.search, 'input', applyFilters);

    listen(el.poli, 'change', applyFilters);

    listen(el.hari, 'change', applyFilters);

    listen(el.reset, 'click', resetFilters);

    listen(el.exportCsv, 'click', exportCsv);

    listen(el.exportPdf, 'click', exportPdf);

    listen(el.prev, 'click', () => {
        if (currentPage > 1) {
            currentPage--;
            renderTable();
        }
    });

    listen(el.next, 'click', () => {
        const totalPages = Math.ceil(
            filteredJadwal.length / pageSize
        );

        if (currentPage < totalPages) {
            currentPage++;
            renderTable();
        }
    });

    // Atur minggu berjalan jika input belum memiliki nilai.
    if (el.week && !el.week.value) {
        el.week.value = getCurrentIsoWeek();
    }

    jadwalDokterCleanup = () => {
        if (destroyed) return;

        destroyed = true;

        requestNumber++;

        requestController?.abort();
        requestController = null;

        listeners.forEach(removeListener => removeListener());

        delete container.dataset.initialized;

        jadwalDokterCleanup = null;
    };

    loadJadwal();
}

/**
 * Bersihkan event dan request saat berpindah halaman Livewire.
 */
document.addEventListener('livewire:navigating', () => {
    jadwalDokterCleanup?.();
});

/**
 * Inisialisasi pada pemuatan pertama.
 */
if (document.readyState === 'loading') {
    document.addEventListener(
        'DOMContentLoaded',
        initJadwalDokter,
        { once: true }
    );
} else {
    initJadwalDokter();
}

/**
 * Inisialisasi ulang setelah wire:navigate.
 */
document.addEventListener(
    'livewire:navigated',
    initJadwalDokter
);
