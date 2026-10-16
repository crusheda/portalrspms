<?php

namespace App\Services;

use GuzzleHttp\Client;
use RuntimeException;

class BpjsService
{
    protected string $consid;
    protected string $secretkey;
    protected string $userkey;
    protected Client $client;
    protected ?string $lastTimestamp = null;

    public function __construct()
    {
        $this->consid = (string) config('services.bpjs.consid');
        $this->secretkey = (string) config('services.bpjs.secretkey');
        $this->userkey = (string) config('services.bpjs.userkey');

        $baseUrl = (string) config('services.bpjs.base_url');

        if ($baseUrl === '') {
            throw new RuntimeException('BPJS_BASE_URL belum dikonfigurasi.');
        }

        $this->client = new Client([
            'base_uri' => rtrim($baseUrl, '/') . '/',
            'timeout' => (int) config('services.bpjs.timeout', 20),
            'connect_timeout' => (int) config('services.bpjs.connect_timeout', 5),
            // Konfigurasikan BPJS_SSL_VERIFY=true jika sertifikat endpoint valid.
            'verify' => (bool) config('services.bpjs.ssl_verify', false),
        ]);
    }

    /**
     * GET ke service antrean BPJS.
     * Timestamp header dan signature dibuat dari nilai yang sama.
     */
    public function serviceGet(string $url): object
    {
        $this->assertCredentials();

        $timestamp = $this->bpjsTimestamp();
        $this->lastTimestamp = $timestamp;

        $serviceName = trim((string) config('services.bpjs.services_name_antrean'), '/');
        $path = $serviceName . '/' . ltrim($url, '/');

        $response = $this->client->get($path, [
            'headers' => [
                'X-cons-id' => $this->consid,
                'X-Timestamp' => $timestamp,
                'X-Signature' => $this->generateSignature($timestamp),
                'user_key' => $this->userkey,
                'Accept' => 'application/json',
            ],
        ]);

        $decoded = json_decode((string) $response->getBody());

        if (!is_object($decoded)) {
            throw new RuntimeException('Respons API BPJS bukan JSON object yang valid.');
        }

        return $decoded;
    }

    /**
     * i-Care tetap dipertahankan agar pemanggil service yang lama tidak putus.
     */
    public function serviceGetIcare(string $url, string $no_kartu, $kd_dokter): array
    {
        $this->assertCredentials();

        $timestamp = $this->bpjsTimestamp();
        $this->lastTimestamp = $timestamp;

        // Pertahankan endpoint validasi i-Care yang digunakan implementasi lama.
        $endpoint = '/wsihs/api/rs/validate';

        $response = $this->client->post($endpoint, [
            'headers' => [
                'Content-Type' => 'application/json',
                'X-cons-id' => $this->consid,
                'X-Timestamp' => $timestamp,
                'X-Signature' => $this->generateSignature($timestamp),
                'user_key' => $this->userkey,
            ],
            'json' => [
                'param' => $no_kartu,
                'kodedokter' => (int) $kd_dokter,
            ],
        ]);

        $decoded = json_decode((string) $response->getBody(), true);

        if (!is_array($decoded)) {
            throw new RuntimeException('Respons i-Care bukan JSON array/object yang valid.');
        }

        return $decoded;
    }

    public function generateSignature(?string $timestamp = null): string
    {
        $this->assertCredentials();
        $timestamp ??= $this->bpjsTimestamp();

        return base64_encode(
            hash_hmac('sha256', $this->consid . '&' . $timestamp, $this->secretkey, true)
        );
    }

    public function bpjsTimestamp(): string
    {
        return (string) time();
    }

    /**
     * Dekripsi memakai timestamp request terakhir, bukan time() baru.
     * Timestamp BPJS harus konsisten dengan yang digunakan pada request.
     */
    public function stringDecrypt(
        string $string,
        ?string $timestamp = null
    ): string|false|null {
        $this->assertCredentials();

        $timestamp ??= $this->lastTimestamp ?? $this->bpjsTimestamp();

        $keyHash = hash(
            'sha256',
            $this->consid . $this->secretkey . $timestamp,
            true
        );

        $iv = substr($keyHash, 0, 16);

        $encrypted = base64_decode($string, true);

        if ($encrypted === false) {
            throw new RuntimeException(
                'Respons terenkripsi BPJS bukan Base64 yang valid.'
            );
        }

        $decrypted = openssl_decrypt(
            $encrypted,
            'AES-256-CBC',
            $keyHash,
            OPENSSL_RAW_DATA,
            $iv
        );

        if ($decrypted === false) {
            throw new RuntimeException(
                'Dekripsi AES-256-CBC gagal. Periksa timestamp request dan konfigurasi kunci BPJS.'
            );
        }

        if (!class_exists(\LZCompressor\LZString::class)) {
            throw new RuntimeException(
                'Class LZString tidak tersedia. Periksa dependency dekripsi BPJS.'
            );
        }

        $result = \LZCompressor\LZString::decompressFromEncodedURIComponent(
            $decrypted
        );

        if (!is_string($result) || $result === '') {
            throw new RuntimeException(
                'Dekripsi AES berhasil, tetapi dekompresi LZString gagal.'
            );
        }

        return $result;
    }

    private function assertCredentials(): void
    {
        if ($this->consid === '' || $this->secretkey === '' || $this->userkey === '') {
            throw new RuntimeException('Konfigurasi BPJS_CONSID, BPJS_SECRETKEY, atau BPJS_USERKEY belum lengkap.');
        }
    }
}
