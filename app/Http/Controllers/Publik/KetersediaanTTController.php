<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class KetersediaanTTController extends Controller
{
    /**
     * Halaman legacy. Portal baru menampilkan SFC Livewire yang mengambil data
     * melalui AJAX ke endpoint getTT().
     */
    public function index()
    {
        return view('pages.publik.tt.index');
    }

    /**
     * Proxy endpoint internal rumah sakit.
     *
     * URL publik di routes/api.php:
     * GET /api/informasi/tt
     *
     * Respons sukses sengaja dikembalikan sebagai JSON array langsung,
     * karena format ini yang dipakai halaman lama (res.forEach(...)).
     */
    public function getTT(): JsonResponse
    {
        $baseUrl = rtrim((string) config('services.rs.base_url'), '/') . '/';
        $username = (string) config('services.rs.username');
        $password = (string) config('services.rs.password');

        if ($baseUrl === '/' || trim($baseUrl) === '') {
            Log::error('URL_PUBLIC_RS belum dikonfigurasi.');
            return response()->json([
                'message' => 'URL layanan informasi rumah sakit belum dikonfigurasi.',
            ], 500);
        }

        if ($username === '' || $password === '') {
            Log::error('Kredensial layanan informasi RS belum dikonfigurasi.');
            return response()->json([
                'message' => 'Kredensial layanan informasi rumah sakit belum dikonfigurasi.',
            ], 500);
        }

        $url = $baseUrl . 'informasi/ruangan';

        try {
            $response = Http::acceptJson()
                ->withBasicAuth($username, $password)
                ->connectTimeout(5)
                ->timeout(20)
                ->get($url);

            if (!$response->successful()) {
                Log::error('API informasi ruangan mengembalikan status gagal.', [
                    'url' => $url,
                    'status' => $response->status(),
                    'body' => mb_substr($response->body(), 0, 1500),
                ]);

                return response()->json([
                    'message' => 'Layanan informasi tempat tidur mengembalikan HTTP ' . $response->status() . '.',
                ], 502);
            }

            $payload = $response->json();

            // Endpoint internal yang lama mengembalikan array langsung.
            // Beberapa wrapper API mungkin mengemasnya dalam data/response, jadi unwrap.
            if (is_array($payload) && array_is_list($payload)) {
                $rows = $payload;
            } elseif (is_array($payload) && isset($payload['data']) && is_array($payload['data'])) {
                $rows = $payload['data'];
            } elseif (is_array($payload) && isset($payload['response']) && is_array($payload['response'])) {
                $rows = $payload['response'];
            } else {
                Log::error('Format JSON API informasi ruangan tidak sesuai.', [
                    'url' => $url,
                    'content_type' => $response->header('Content-Type'),
                    'body' => mb_substr($response->body(), 0, 1500),
                ]);

                return response()->json([
                    'message' => 'Format respons layanan tempat tidur tidak sesuai. Diharapkan array data ruangan.',
                ], 502);
            }

            // Pastikan halaman AJAX menerima field yang dipakai dari view lama.
            // Data tidak dipalsukan atau diganti dummy; setiap baris berasal dari API RS.
            foreach ($rows as $index => $row) {
                if (!is_array($row)) {
                    Log::warning('Baris data tempat tidur bukan object/array.', [
                        'index' => $index,
                        'row_type' => gettype($row),
                    ]);
                    unset($rows[$index]);
                }
            }

            return response()->json(array_values($rows));
        } catch (Throwable $e) {
            Log::error('Tidak dapat mengakses API informasi tempat tidur.', [
                'url' => $url,
                'exception' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Server portal tidak dapat menghubungi layanan informasi tempat tidur. Periksa koneksi jaringan dan log aplikasi.',
            ], 502);
        }
    }
}
