let ttCleanup = null;

function initKetersediaanTempatTidur() {
    const container = document.querySelector(
        '[data-public-page="ketersediaan-tempat-tidur"]'
    );

    if (!container || container.dataset.initialized === 'true') {
        return;
    }

    container.dataset.initialized = 'true';

    const apiUrl = container.dataset.apiUrl;

    // Elemen halaman
    const alertBox = container.querySelector('#ttAlert');
    const refreshButton = container.querySelector('#ttRefresh');

    const totalElement = container.querySelector('#ttTotal');
    const availableElement = container.querySelector('#ttAvailable');
    const reservedElement = container.querySelector('#ttReserved');
    const occupiedElement = container.querySelector('#ttOccupied');

    const percentElement = container.querySelector('#ttPercent');

    const barAvailable = container.querySelector('#ttBarAvailable');
    const barReserved = container.querySelector('#ttBarReserved');
    const barOccupied = container.querySelector('#ttBarOccupied');
    const barUnknown = container.querySelector('#ttBarUnknown');

    const legendAvailable = container.querySelector('#ttLegendAvailable');
    const legendReserved = container.querySelector('#ttLegendReserved');
    const legendOccupied = container.querySelector('#ttLegendOccupied');
    const legendUnknown = container.querySelector('#ttLegendUnknown');

    const searchInput = container.querySelector('#ttSearch');
    const statusFilter = container.querySelector('#ttStatusFilter');
    const roomFilter = container.querySelector('#ttRoomFilter');

    const resultCount = container.querySelector('#ttResultCount');
    const updatedAt = container.querySelector('#ttUpdatedAt');
    const countdownElement = container.querySelector('#ttCountdown');

    const tableBody = container.querySelector('#ttTableBody');
    const pageInfo = container.querySelector('#ttPageInfo');
    const prevButton = container.querySelector('#ttPrev');
    const nextButton = container.querySelector('#ttNext');

    // State
    let allBeds = [];
    let filteredBeds = [];
    let currentPage = 1;

    const perPage = 10;
    const refreshInterval = 60;

    let countdown = refreshInterval;
    let countdownTimer = null;
    let refreshTimer = null;
    let requestController = null;
    let destroyed = false;

    const numberFormat = new Intl.NumberFormat('id-ID');

    // --------------------------------------------------
    // HELPER
    // --------------------------------------------------

    function showAlert(message, type = 'error') {
        if (!alertBox) return;

        alertBox.textContent = message;
        alertBox.hidden = false;

        alertBox.classList.toggle('is-info', type === 'info');
    }

    function hideAlert() {
        if (!alertBox) return;

        alertBox.hidden = true;
        alertBox.textContent = '';
    }

    function normalizeStatus(status) {
        const value = String(status ?? '').trim();

        if (value === '1') return '1';
        if (value === '2') return '2';
        if (value === '3') return '3';

        return 'other';
    }

    function getStatusLabel(status) {
        switch (normalizeStatus(status)) {
            case '1':
                return 'Tersedia';

            case '2':
                return 'Terpesan';

            case '3':
                return 'Terisi';

            default:
                return 'Status lainnya';
        }
    }

    function getStatusClass(status) {
        switch (normalizeStatus(status)) {
            case '1':
                return 'status-available';

            case '2':
                return 'status-reserved';

            case '3':
                return 'status-occupied';

            default:
                return 'status-unknown';
        }
    }

    function normalizeData(result) {
        // Mendukung respons berupa array langsung atau dibungkus objek.
        if (Array.isArray(result)) {
            return result;
        }

        if (Array.isArray(result?.data)) {
            return result.data;
        }

        if (Array.isArray(result?.response)) {
            return result.response;
        }

        if (Array.isArray(result?.data?.data)) {
            return result.data.data;
        }

        return null;
    }

    function getBedName(item) {
        return String(item.TEMPAT_TIDUR ?? '-');
    }

    function getRoomName(item) {
        return String(item.DESKRIPSI ?? '-');
    }

    function getRoomNumber(item) {
        return String(item.KAMAR ?? '-');
    }

    function createCell(value) {
        const td = document.createElement('td');

        // textContent mencegah data API diperlakukan sebagai HTML.
        td.textContent = value ?? '-';

        return td;
    }

    // --------------------------------------------------
    // RINGKASAN
    // --------------------------------------------------

    function renderSummary() {
        const total = allBeds.length;

        const available = allBeds.filter(
            item => normalizeStatus(item.STATUS) === '1'
        ).length;

        const reserved = allBeds.filter(
            item => normalizeStatus(item.STATUS) === '2'
        ).length;

        const occupied = allBeds.filter(
            item => normalizeStatus(item.STATUS) === '3'
        ).length;

        const unknown = total - available - reserved - occupied;

        if (totalElement) {
            totalElement.textContent = numberFormat.format(total);
        }

        if (availableElement) {
            availableElement.textContent = numberFormat.format(available);
        }

        if (reservedElement) {
            reservedElement.textContent = numberFormat.format(reserved);
        }

        if (occupiedElement) {
            occupiedElement.textContent = numberFormat.format(occupied);
        }

        if (legendAvailable) {
            legendAvailable.textContent = numberFormat.format(available);
        }

        if (legendReserved) {
            legendReserved.textContent = numberFormat.format(reserved);
        }

        if (legendOccupied) {
            legendOccupied.textContent = numberFormat.format(occupied);
        }

        if (legendUnknown) {
            legendUnknown.textContent = numberFormat.format(unknown);
        }

        const percentage = value => {
            return total > 0 ? (value / total) * 100 : 0;
        };

        if (barAvailable) {
            barAvailable.style.width = `${percentage(available)}%`;
        }

        if (barReserved) {
            barReserved.style.width = `${percentage(reserved)}%`;
        }

        if (barOccupied) {
            barOccupied.style.width = `${percentage(occupied)}%`;
        }

        if (barUnknown) {
            barUnknown.style.width = `${percentage(unknown)}%`;
        }

        if (percentElement) {
            const occupancy = total > 0
                ? (occupied / total) * 100
                : 0;

            percentElement.textContent =
                `${occupancy.toLocaleString('id-ID', {
                    maximumFractionDigits: 1,
                })}% terisi`;
        }
    }

    // --------------------------------------------------
    // FILTER RUANGAN
    // --------------------------------------------------

    function renderRoomOptions() {
        if (!roomFilter) return;

        const selectedRoom = roomFilter.value;

        const rooms = [
            ...new Set(
                allBeds
                    .map(item => getRoomName(item))
                    .filter(room => room !== '-')
            ),
        ].sort((a, b) => a.localeCompare(b, 'id'));

        roomFilter.replaceChildren();

        const defaultOption = document.createElement('option');

        defaultOption.value = '';
        defaultOption.textContent = 'Semua ruangan';

        roomFilter.appendChild(defaultOption);

        rooms.forEach(room => {
            const option = document.createElement('option');

            option.value = room;
            option.textContent = room;

            roomFilter.appendChild(option);
        });

        if (rooms.includes(selectedRoom)) {
            roomFilter.value = selectedRoom;
        }
    }

    // --------------------------------------------------
    // FILTER DATA
    // --------------------------------------------------

    function applyFilters() {
        const keyword = (searchInput?.value ?? '')
            .trim()
            .toLocaleLowerCase('id-ID');

        const selectedStatus = statusFilter?.value ?? '';
        const selectedRoom = roomFilter?.value ?? '';

        filteredBeds = allBeds.filter(item => {
            const room = getRoomName(item);
            const roomNumber = getRoomNumber(item);
            const bedName = getBedName(item);

            const searchable = [
                room,
                roomNumber,
                bedName,
            ].join(' ').toLocaleLowerCase('id-ID');

            const matchesKeyword =
                !keyword || searchable.includes(keyword);

            const status = normalizeStatus(item.STATUS);

            const matchesStatus =
                !selectedStatus || status === selectedStatus;

            const matchesRoom =
                !selectedRoom || room === selectedRoom;

            return matchesKeyword && matchesStatus && matchesRoom;
        });

        currentPage = 1;

        renderTable();
    }

    // --------------------------------------------------
    // TABEL
    // --------------------------------------------------

    function renderTable() {
        if (!tableBody) return;

        tableBody.replaceChildren();

        const total = filteredBeds.length;
        const totalPages = Math.ceil(total / perPage);

        if (total === 0) {
            const tr = document.createElement('tr');
            const td = document.createElement('td');

            td.colSpan = 5;
            td.className = 'text-center py-4';
            td.textContent = 'Tidak ada data tempat tidur yang sesuai.';

            tr.appendChild(td);
            tableBody.appendChild(tr);

            if (pageInfo) {
                pageInfo.textContent = '0 data';
            }

            if (resultCount) {
                resultCount.textContent = '0 tempat tidur ditemukan';
            }

            if (prevButton) prevButton.disabled = true;
            if (nextButton) nextButton.disabled = true;

            return;
        }

        if (currentPage > totalPages) {
            currentPage = totalPages;
        }

        const startIndex = (currentPage - 1) * perPage;

        const pageData = filteredBeds.slice(
            startIndex,
            startIndex + perPage
        );

        pageData.forEach((item, index) => {
            const tr = document.createElement('tr');

            const numberCell = createCell(
                numberFormat.format(startIndex + index + 1)
            );

            numberCell.classList.add('text-center');

            tr.appendChild(numberCell);

            const roomCell = createCell(getRoomName(item));
            roomCell.classList.add('rs-room-name');

            tr.appendChild(roomCell);
            tr.appendChild(createCell(getRoomNumber(item)));
            tr.appendChild(createCell(getBedName(item)));

            const statusCell = document.createElement('td');
            const badge = document.createElement('span');

            badge.className =
                `rs-status ${getStatusClass(item.STATUS)}`;

            const dot = document.createElement('i');

            dot.setAttribute('aria-hidden', 'true');

            const label = document.createElement('span');

            label.textContent = getStatusLabel(item.STATUS);

            badge.appendChild(dot);
            badge.appendChild(label);

            statusCell.appendChild(badge);
            tr.appendChild(statusCell);

            tableBody.appendChild(tr);
        });

        if (pageInfo) {
            const from = startIndex + 1;
            const to = Math.min(startIndex + perPage, total);

            pageInfo.textContent =
                `Menampilkan ${from}–${to} dari ${numberFormat.format(total)} data`;
        }

        if (resultCount) {
            resultCount.textContent =
                `${numberFormat.format(total)} tempat tidur ditemukan`;
        }

        if (prevButton) {
            prevButton.disabled = currentPage <= 1;
        }

        if (nextButton) {
            nextButton.disabled = currentPage >= totalPages;
        }
    }

    // --------------------------------------------------
    // REQUEST API
    // --------------------------------------------------

    async function loadTempatTidur() {
        if (destroyed) return;

        if (!apiUrl) {
            showAlert('URL API ketersediaan tempat tidur tidak ditemukan.');
            return;
        }

        if (refreshButton) {
            refreshButton.disabled = true;
        }

        if (requestController) {
            requestController.abort();
        }

        requestController = new AbortController();

        try {
            hideAlert();

            console.log(
                '[Ketersediaan TT] Memanggil API:',
                apiUrl
            );

            const response = await fetch(apiUrl, {
                method: 'GET',
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                signal: requestController.signal,
            });

            if (!response.ok) {
                throw new Error(
                    `Request API gagal: HTTP ${response.status}`
                );
            }

            const result = await response.json();

            if (destroyed || requestController.signal.aborted) return;

            const data = normalizeData(result);

            if (!data) {
                throw new Error(
                    'Struktur respons API tidak dikenali. Periksa respons JSON di Console.'
                );
            }

            allBeds = data;

            renderSummary();
            renderRoomOptions();
            applyFilters();

            if (updatedAt) {
                updatedAt.textContent =
                    `Diperbarui ${new Date().toLocaleTimeString('id-ID')}`;
            }

            console.log(
                `[Ketersediaan TT] Berhasil memuat ${allBeds.length} data.`
            );
        } catch (error) {
            if (error.name === 'AbortError') {
                return;
            }

            console.error(
                '[Ketersediaan TT] Gagal memuat data:',
                error
            );

            showAlert(
                'Data tempat tidur gagal dimuat. Periksa koneksi API dan coba refresh kembali.'
            );

            if (allBeds.length === 0 && tableBody) {
                tableBody.replaceChildren();

                const tr = document.createElement('tr');
                const td = document.createElement('td');

                td.colSpan = 5;
                td.className = 'text-center py-4';
                td.textContent =
                    'Gagal mengambil data tempat tidur dari server.';

                tr.appendChild(td);
                tableBody.appendChild(tr);
            }
        } finally {
            if (
                !destroyed &&
                refreshButton
            ) {
                refreshButton.disabled = false;
            }

            requestController = null;
        }
    }

    // --------------------------------------------------
    // EVENT
    // --------------------------------------------------

    searchInput?.addEventListener('input', applyFilters);

    statusFilter?.addEventListener('change', applyFilters);

    roomFilter?.addEventListener('change', applyFilters);

    refreshButton?.addEventListener('click', () => {
        countdown = refreshInterval;
        loadTempatTidur();
    });

    prevButton?.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            renderTable();
        }
    });

    nextButton?.addEventListener('click', () => {
        const totalPages = Math.ceil(
            filteredBeds.length / perPage
        );

        if (currentPage < totalPages) {
            currentPage++;
            renderTable();
        }
    });

    // --------------------------------------------------
    // AUTO REFRESH 60 DETIK
    // --------------------------------------------------

    // Request pertama hanya sekali ketika halaman diinisialisasi.
    loadTempatTidur();

    // Countdown hanya untuk tampilan.
    countdownTimer = setInterval(() => {
        countdown--;

        if (countdown <= 0) {
            countdown = refreshInterval;
        }

        if (countdownElement) {
            countdownElement.textContent = countdown;
        }
    }, 1000);

    // Satu-satunya interval yang melakukan request otomatis.
    refreshTimer = setInterval(() => {
        countdown = refreshInterval;
        loadTempatTidur();
    }, refreshInterval * 1000);

    // Cleanup ketika halaman ditinggalkan.
    ttCleanup = function () {
        destroyed = true;

        clearInterval(countdownTimer);
        clearInterval(refreshTimer);

        if (requestController) {
            requestController.abort();
            requestController = null;
        }

        container.dataset.initialized = 'false';
    };
}

// Navigasi awal
document.addEventListener(
    'DOMContentLoaded',
    initKetersediaanTempatTidur
);

// Sebelum berpindah halaman, hentikan interval halaman sebelumnya.
document.addEventListener('livewire:navigating', () => {
    if (ttCleanup) {
        ttCleanup();
        ttCleanup = null;
    }
});

// Inisialisasi halaman yang baru dikunjungi.
document.addEventListener(
    'livewire:navigated',
    initKetersediaanTempatTidur
);
