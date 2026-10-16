<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Services\BpjsService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use Throwable;

class JadwalSpesialisController extends Controller
{
    private const KODE_POLI = [
        'IGD', 'ANA', 'BED', 'GIG', 'INT', 'IRM', 'JAN', 'JIW', 'KLT',
        'MAT', 'THT', 'OBG', 'ORT', 'PAR', 'SAR', 'URO', 'ANT', 'KON',
    ];

    public function __construct(
        protected BpjsService $bpjs
    ) {
    }

    /**
     * Halaman legacy. Untuk portal baru, halaman disajikan oleh Livewire SFC.
     */
    public function index()
    {
        return view('pages.publik.jadwal.index');
    }

    /**
     * Endpoint untuk mencari jadwal satu poli dan tanggal.
     * URL BPJS: jadwaldokter/kodepoli/{kode}/tanggal/{Y-m-d}
     */
    public function cariJadwal(string $poli, string $tgl): JsonResponse
    {
        try {
            $tanggal = Carbon::createFromFormat('!Y-m-d', $tgl, 'Asia/Jakarta');

            if (!$tanggal || $tanggal->format('Y-m-d') !== $tgl) {
                return response()->json([
                    'message' => 'Format tanggal harus YYYY-MM-DD.',
                    'response' => [],
                ], 422);
            }

            $result = $this->bpjs->serviceGet(
                'jadwaldokter/kodepoli/' . rawurlencode($poli) . '/tanggal/' . $tanggal->format('Y-m-d')
            );

            $encrypted = data_get($result, 'response');

            if (!is_string($encrypted) || $encrypted === '') {
                return response()->json([
                    'response' => [],
                    'message' => data_get($result, 'metaData.message', 'Jadwal tidak tersedia untuk poli dan tanggal tersebut.'),
                ]);
            }

            $decrypted = $this->bpjs->stringDecrypt($encrypted);
            $decoded = is_string($decrypted) ? json_decode($decrypted, true) : null;

            if (!is_array($decoded)) {
                throw new \RuntimeException('Respons jadwal BPJS gagal didekripsi atau bukan JSON array.');
            }

            foreach ($decoded as &$row) {
                if (is_array($row)) {
                    $row['tanggal'] = $tgl;
                }
            }
            unset($row);

            return response()->json(['response' => $decoded]);
        } catch (Throwable $e) {
            Log::error('Gagal mengambil jadwal satu poli dari BPJS.', [
                'poli' => $poli,
                'tanggal' => $tgl,
                'exception' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Layanan jadwal BPJS sedang tidak dapat diakses. Silakan coba kembali.',
                'response' => [],
            ], 502);
        }
    }

    /**
     * Jadwal mingguan satu poli untuk minggu kalender berjalan.
     * Hasil berupa data array (bukan JsonResponse yang disimpan di cache).
     */
    public function jadwalMingguan(string $poli): JsonResponse
    {
        $start = Carbon::now('Asia/Jakarta')->startOfWeek(Carbon::MONDAY)->startOfDay();
        $weekKey = $start->format('o_W');
        $cacheKey = 'jadwal_mingguan_' . strtoupper($poli) . '_' . $weekKey;

        try {
            $allData = Cache::remember($cacheKey, 300, function () use ($poli, $start) {
                $allData = [];
                $failed = 0;

                for ($offset = 0; $offset < 7; $offset++) {
                    $date = $start->copy()->addDays($offset);
                    $tgl = $date->format('Y-m-d');

                    try {
                        $result = $this->bpjs->serviceGet(
                            'jadwaldokter/kodepoli/' . rawurlencode($poli) . '/tanggal/' . $tgl
                        );

                        $encrypted = data_get($result, 'response');
                        if (!is_string($encrypted) || $encrypted === '') {
                            continue;
                        }

                        $decrypted = $this->bpjs->stringDecrypt($encrypted);
                        $decoded = is_string($decrypted) ? json_decode($decrypted, true) : null;

                        if (!is_array($decoded)) {
                            $failed++;
                            continue;
                        }

                        foreach ($decoded as $row) {
                            if (is_array($row)) {
                                $row['tanggal'] = $tgl;
                                $allData[] = $row;
                            }
                        }
                    } catch (Throwable $e) {
                        $failed++;
                        Log::warning('Request jadwal mingguan satu poli gagal.', [
                            'poli' => $poli,
                            'tanggal' => $tgl,
                            'exception' => $e->getMessage(),
                        ]);
                    }
                }

                return [
                    'data' => $allData,
                    'failed_requests' => $failed,
                ];
            });

            return response()->json([
                'response' => $allData['data'] ?? [],
                'warning' => !empty($allData['failed_requests'])
                    ? 'Sebagian data jadwal tidak berhasil diambil dari BPJS.'
                    : null,
            ]);
        } catch (Throwable $e) {
            Log::error('Gagal membangun jadwal mingguan satu poli.', [
                'poli' => $poli,
                'exception' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Gagal mengambil jadwal dari BPJS.',
                'response' => [],
            ], 502);
        }
    }

    /**
     * Endpoint AJAX untuk jadwal mingguan seluruh poli.
     * Query parameter: ?week=2026-W42
     */
    public function jadwalMingguanAllPoli(Request $request): JsonResponse
    {
        $week = (string) $request->query('week', Carbon::now('Asia/Jakarta')->format('o-\WW'));

        try {
            $period = $this->resolveIsoWeek($week);
            $result = $this->getAllPoliForWeek(
                $week,
                $period['year'],
                $period['week'],
                $period['start'],
                $period['end']
            );

            if (empty($result['data']) && ($result['failed_requests'] ?? 0) >= count(self::KODE_POLI) * 7) {
                return response()->json([
                    'message' => 'Seluruh permintaan jadwal ke BPJS gagal. Periksa koneksi, kredensial, signature, dan konfigurasi layanan BPJS.',
                    'response' => [],
                ], 502);
            }

            return response()->json([
                'response' => $result['data'] ?? [],
                'week' => $week,
                'warning' => !empty($result['failed_requests'])
                    ? 'Sebagian permintaan jadwal ke BPJS gagal. Data yang berhasil diambil tetap ditampilkan.'
                    : null,
            ]);
        } catch (InvalidArgumentException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'response' => [],
            ], 422);
        } catch (Throwable $e) {
            Log::error('Gagal mengambil jadwal mingguan seluruh poli.', [
                'week' => $week,
                'exception' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Gagal mengambil jadwal dari layanan BPJS. Periksa log aplikasi untuk detail teknis.',
                'response' => [],
            ], 502);
        }
    }

    /**
     * Export PDF menggunakan sumber data yang sama dengan endpoint AJAX.
     */
    public function exportJadwalPdf(Request $request)
    {
        $week = (string) $request->query(
            'week',
            Carbon::now('Asia/Jakarta')->format('o-\WW')
        );

        try {
            $period = $this->resolveIsoWeek($week);

            $result = $this->getAllPoliForWeek(
                $week,
                $period['year'],
                $period['week'],
                $period['start'],
                $period['end']
            );

            // Ambil data jadwal.
            $jadwal = $result['data'] ?? [];

            // Jika data jadwal berupa array asosiatif,
            // ubah setiap baris menjadi objek agar kompatibel dengan Blade.
            $jadwal = array_map(
                fn ($row) => is_array($row) ? (object) $row : $row,
                $jadwal
            );

            if (
                empty($jadwal) &&
                ($result['failed_requests'] ?? 0) >= count(self::KODE_POLI) * 7
            ) {
                return response()->json([
                    'message' => 'Jadwal tidak berhasil diambil dari BPJS sehingga PDF belum dapat dibuat.',
                ], 502);
            }

            $pdf = Pdf::loadView('pages.publik.jadwal.pdf', [
                'jadwal' => $jadwal,
                'week' => $week,
            ])->setPaper('F4', 'portrait');

            return $pdf->download(
                'jadwal_poli_pkuskh_' .
                now('Asia/Jakarta')->format('Ymd_His') .
                '.pdf'
            );
        } catch (InvalidArgumentException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        } catch (Throwable $e) {
            Log::error('Gagal membuat PDF jadwal dokter.', [
                'week' => $week,
                'message' => $e->getMessage(),
                'exception' => $e,
            ]);

            return response()->json([
                'message' => 'Gagal membuat PDF jadwal dokter.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 502);
        }
    }

    private function resolveIsoWeek(string $week): array
    {
        if (!preg_match('/^(\d{4})-W(\d{2})$/', $week, $matches)) {
            throw new InvalidArgumentException('Format minggu harus YYYY-Www, misalnya 2026-W42.');
        }

        $year = (int) $matches[1];
        $weekNumber = (int) $matches[2];

        if ($weekNumber < 1 || $weekNumber > 53) {
            throw new InvalidArgumentException('Nomor minggu harus antara 01 dan 53.');
        }

        $start = Carbon::now('Asia/Jakarta')
            ->setISODate($year, $weekNumber, Carbon::MONDAY)
            ->startOfDay();

        if ((int) $start->format('o') !== $year || (int) $start->format('W') !== $weekNumber) {
            throw new InvalidArgumentException('Minggu ISO tersebut tidak tersedia pada tahun yang dipilih.');
        }

        return [
            'year' => $year,
            'week' => $weekNumber,
            'start' => $start,
            'end' => $start->copy()->addDays(6)->endOfDay(),
        ];
    }

    private function getAllPoliForWeek(
        string $weekKey,
        int $year,
        int $weekNumber,
        Carbon $start,
        Carbon $end
    ): array {
        $cacheKey = sprintf(
            'jadwal_mingguan_all_%04d_W%02d',
            $year,
            $weekNumber
        );

        $cached = Cache::get($cacheKey);

        if (
            is_array($cached)
            && array_key_exists('data', $cached)
            && array_key_exists('failed_requests', $cached)
        ) {
            return $cached;
        }

        $allData = [];
        $failedRequests = 0;
        $emptyResponses = 0;
        $totalRequests = 0;

        foreach (self::KODE_POLI as $poli) {
            for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
                $totalRequests++;
                $tgl = $date->format('Y-m-d');

                try {
                    $endpoint = sprintf(
                        'jadwaldokter/kodepoli/%s/tanggal/%s',
                        rawurlencode($poli),
                        $tgl
                    );

                    $result = $this->bpjs->serviceGet($endpoint);

                    $encrypted = data_get($result, 'response');
                    $metaCode = (string) data_get($result, 'metaData.code', '');
                    $metaMessage = (string) data_get(
                        $result,
                        'metaData.message',
                        ''
                    );

                    /*
                    * Periksa metadata BPJS terlebih dahulu.
                    */
                    if ($metaCode !== '' && $metaCode !== '200') {
                        $failedRequests++;

                        Log::warning('BPJS mengembalikan kode non-sukses.', [
                            'poli' => $poli,
                            'tanggal' => $tgl,
                            'meta_code' => $metaCode,
                            'meta_message' => $metaMessage,
                        ]);

                        continue;
                    }

                    /*
                    * Respons kosong belum tentu merupakan kegagalan.
                    * Poli mungkin memang tidak memiliki jadwal.
                    *
                    * Namun, catat kondisi ini agar bisa dibedakan
                    * dari kegagalan request atau dekripsi.
                    */
                    if (!is_string($encrypted) || trim($encrypted) === '') {
                        $emptyResponses++;

                        Log::debug('Respons jadwal BPJS kosong.', [
                            'poli' => $poli,
                            'tanggal' => $tgl,
                            'meta_code' => $metaCode,
                            'meta_message' => $metaMessage,
                            'result_type' => get_debug_type($result),
                        ]);

                        continue;
                    }

                    /*
                    * Dekripsi respons BPJS.
                    */
                    $decrypted = $this->bpjs->stringDecrypt($encrypted);

                    if (!is_string($decrypted) || trim($decrypted) === '') {
                        $failedRequests++;

                        Log::error('Hasil dekripsi jadwal BPJS kosong.', [
                            'poli' => $poli,
                            'tanggal' => $tgl,
                            'meta_code' => $metaCode,
                        ]);

                        continue;
                    }

                    $decoded = json_decode($decrypted, true);

                    if (!is_array($decoded) || json_last_error() !== JSON_ERROR_NONE) {
                        $failedRequests++;

                        Log::error('JSON hasil dekripsi jadwal BPJS tidak valid.', [
                            'poli' => $poli,
                            'tanggal' => $tgl,
                            'json_error' => json_last_error_msg(),
                            'hasil_awal' => mb_substr($decrypted, 0, 300),
                        ]);

                        continue;
                    }

                    foreach ($decoded as $row) {
                        if (!is_array($row)) {
                            continue;
                        }

                        $row['tanggal'] = $tgl;
                        $allData[] = $row;
                    }
                } catch (Throwable $e) {
                    $failedRequests++;

                    Log::error('Request jadwal BPJS gagal diproses.', [
                        'poli' => $poli,
                        'tanggal' => $tgl,
                        'exception_class' => get_class($e),
                        'exception' => $e->getMessage(),
                    ]);
                }
            }
        }

        usort($allData, static function (array $a, array $b): int {
            $subspesialis = strcmp(
                (string) ($a['namasubspesialis'] ?? ''),
                (string) ($b['namasubspesialis'] ?? '')
            );

            if ($subspesialis !== 0) {
                return $subspesialis;
            }

            $dokter = strcmp(
                (string) ($a['namadokter'] ?? ''),
                (string) ($b['namadokter'] ?? '')
            );

            if ($dokter !== 0) {
                return $dokter;
            }

            return strcmp(
                (string) ($a['tanggal'] ?? ''),
                (string) ($b['tanggal'] ?? '')
            );
        });

        $result = [
            'data' => $allData,
            'failed_requests' => $failedRequests,
            'empty_responses' => $emptyResponses,
            'total_requests' => $totalRequests,
        ];

        /*
        * Cache normal 5 menit jika tidak ada kegagalan.
        * Cache hasil bermasalah hanya 30 detik.
        */
        Cache::put(
            $cacheKey,
            $result,
            $failedRequests > 0 ? 30 : 300
        );

        Log::info('Pengambilan jadwal mingguan BPJS selesai.', [
            'week' => $weekKey,
            'jumlah_jadwal' => count($allData),
            'permintaan_gagal' => $failedRequests,
            'respons_kosong' => $emptyResponses,
            'total_permintaan' => $totalRequests,
        ]);

        return $result;
    }
}
