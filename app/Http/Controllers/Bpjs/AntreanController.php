<?php

namespace App\Http\Controllers\Bpjs;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class AntreanController extends Controller
{
    // INITIALIZE VARIABLE
        // PRODUCTION
            protected $consid;
            protected $secretkey;
            protected $userkey;
            protected $client;
            protected $baseurlvclaim;
            protected $baseurlantrean;
        // DEV
            protected $consid_dev;
            protected $secretkey_dev;
            protected $userkey_dev;
            protected $client_dev;
            protected $baseurlvclaim_dev;
            protected $baseurlantrean_dev;

    public function __construct()
    {
        // PRODUCTION
        $this->consid             = env('BPJS_CONSID');
        $this->secretkey          = env('BPJS_SECRETKEY');
        $this->userkey            = env('BPJS_USERKEY');
        $this->baseurlvclaim      = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/';
        $this->baseurlantrean     = 'https://apijkn.bpjs-kesehatan.go.id/antreanrs/';
        $this->client             = new Client([
                                        'base_uri' => $this->baseurlvclaim,
                                        'timeout'  => 30,
                                        'verify'   => false,
                                    ]);

        // DEV
        $this->consid_dev         = env('BPJS_CONSID_DEV');
        $this->secretkey_dev      = env('BPJS_SECRETKEY_DEV');
        $this->userkey_dev        = env('BPJS_USERKEY_DEV');
        $this->baseurlvclaim_dev  = 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/';
        $this->baseurlantrean_dev = 'https://apijkn-dev.bpjs-kesehatan.go.id/antreanrs_dev/';
        $this->client_dev         = new Client([
                                        'base_uri' => $this->baseurlvclaim_dev,
                                        'timeout'  => 30,
                                        'verify'   => false,
                                    ]);
    }

    // API
    // function testerBpjs() {
    //     $url = 'jadwaldokter/kodepoli/INT/tanggal/2023-09-11';

    //     $client = new Client();
    //     $res = $client->get('https://apijkn-dev.bpjs-kesehatan.go.id/antreanrs_dev/'.$url, [
    //         'headers' => [
    //             'X-cons-id' => $consid,
    //             'X-Timestamp' => $this->bpjsTimestamp(),
    //             'X-Signature' => $this->generateSignatureTester(),
    //             'user_key' => $userkey,
    //         ]
    //     ]); // url_live : https://apijkn.bpjs-kesehatan.go.id/antreanrs/

    //     // RESULT API INTO DECODED JSON
    //     $result = json_decode($res->getBody());

    //     // DEFINE VAR INTO DECRYPTION PROGRESS
    //     $string = $result->response;
    //     $key = $consid.$secretkey.$this->bpjsTimestamp();

    //     // RESULT DECRYPT WITH AES 256 (mode CBC) - SHA256 AND DECOMPRESSION WITH LZ-STRING
    //     $getDecryption = $this->stringDecrypt($key, $string);

    //     $data = [
    //         'response' => json_decode($getDecryption)
    //     ];

    //     return response()->json($data, 200);
    // }

    // function jadwalBpjs() {
    //     $consid = env('BPJS_CONSID');
    //     $secretkey = env('BPJS_SECRETKEY');
    //     $userkey = env('BPJS_USERKEY');

    //     $client = new Client();
    //     $res = $client->get('https://apijkn-dev.bpjs-kesehatan.go.id/antreanrs_dev/jadwaldokter/kodepoli/INT/tanggal/2023-10-04', [
    //         'headers' => [
    //             'X-cons-id' => $consid,
    //             'X-Timestamp' => $this->bpjsTimestamp(),
    //             'X-Signature' => $this->generateSignatureTester(),
    //             'user_key' => $userkey,
    //         ]
    //     ]); // url_live : https://apijkn.bpjs-kesehatan.go.id/antreanrs/

    //     // RESULT API INTO DECODED JSON
    //     $result = json_decode($res->getBody());

    //     // DEFINE VAR INTO DECRYPTION PROGRESS
    //     $string = $result->response;
    //     $key = $consid.$secretkey.$this->bpjsTimestamp();

    //     // RESULT DECRYPT WITH AES 256 (mode CBC) - SHA256 AND DECOMPRESSION WITH LZ-STRING
    //     $getDecryption = $this->stringDecrypt($key, $string);

    //     $data = [
    //         'response' => json_decode($getDecryption)
    //     ];

    //     return response()->json($data, 200);
    // }

    // function kdbook($kd) {
    //     $consid = env('BPJS_CONSID');
    //     $secretkey = env('BPJS_SECRETKEY');
    //     $userkey = env('BPJS_USERKEY');

    //     $client = new Client();
    //     $res = $client->get('https://apijkn-dev.bpjs-kesehatan.go.id/antreanrs_dev/antrean/pendaftaran/kodebooking/'.$kd, [
    //         'headers' => [
    //             'X-cons-id' => $consid,
    //             'X-Timestamp' => $this->bpjsTimestamp(),
    //             'X-Signature' => $this->generateSignatureTester(),
    //             'user_key' => $userkey,
    //         ]
    //     ]); // url_live : https://apijkn.bpjs-kesehatan.go.id/antreanrs/

    //     // RESULT API INTO DECODED JSON
    //     $result = json_decode($res->getBody());
    //     // dd($result);

    //     // DEFINE VAR INTO DECRYPTION PROGRESS
    //     $string = $result->response;
    //     $key = $consid.$secretkey.$this->bpjsTimestamp();

    //     // RESULT DECRYPT WITH AES 256 (mode CBC) - SHA256 AND DECOMPRESSION WITH LZ-STRING
    //     $getDecryption = $this->stringDecrypt($key, $string);

    //     $data = [
    //         'response' => json_decode($getDecryption)
    //     ];

    //     dd(json_decode($getDecryption)[0]);

    //     return response()->json($data, 200);
    // }

    // PRODUCTION
    function showKey()
    {
        $data = [
            'consid' => $this->consid,
            'secretkey' => $this->secretkey,
            'userkey' => $this->userkey,
            'signature' => $this->generateSignature(),
            'timestamp' => $this->bpjsTimestamp(),
        ];

        return response()->json($data, 200);
    }

    public function cariSEP($SEP)
    {
        $action = "SEP/{$SEP}";

        $headers = [
            // 'Accept'       => 'application/json',
            // 'Content-Type' => 'application/json; charset=utf-8',
            'Content-Type' => 'Application/x-www-form-urlencoded',
            'X-cons-id'    => $this->consid,
            'X-Timestamp'  => $this->bpjsTimestamp(),
            'X-Signature'  => $this->generateSignature(),
            'user_key'     => $this->userkey,
        ];

        try {
            $res = $this->client->request("GET", $action, [
                'headers' => $headers
            ]);
            $result = json_decode($res->getBody());
        } catch (\Exception $e) {
            return response()->json([
                "metadata" => [
                    "code" => 500,
                    "message" => "Request failed: ".$e->getMessage()
                ],
                "response" => null
            ], 500);
        }

        // decrypt jika ada response terenkripsi
        $string = $result->response ?? null;
        if ($string) {
            $getDecryption = $this->stringDecrypt($string);
            $result->response = json_decode($getDecryption);
        }

        return response()->json($result, 200);
    }

    public function cariSEPInternal($SEP)
    {
        $action = "SEP/Internal/{$SEP}";

        $headers = [
            // 'Accept'       => 'application/json',
            // 'Content-Type' => 'application/json; charset=utf-8',
            'Content-Type' => 'Application/x-www-form-urlencoded',
            'X-cons-id'    => $this->consid,
            'X-Timestamp'  => $this->bpjsTimestamp(),
            'X-Signature'  => $this->generateSignature(),
            'user_key'     => $this->userkey,
        ];

        try {
            $res = $this->client->request("GET", $action, [
                'headers' => $headers
            ]);
            $result = json_decode($res->getBody());
        } catch (\Exception $e) {
            return response()->json([
                "metadata" => [
                    "code" => 500,
                    "message" => "Request failed: ".$e->getMessage()
                ],
                "response" => null
            ], 500);
        }

        // decrypt jika ada response terenkripsi
        $string = $result->response ?? null;
        if ($string) {
            $getDecryption = $this->stringDecrypt($string);
            $result->response = json_decode($getDecryption);
        }

        return response()->json($result, 200);
    }

    public function cariRujukan($NORUJUKAN)
    {
        $action = "Rujukan/{$NORUJUKAN}";

        $headers = [
            // 'Accept'       => 'application/json',
            'Content-Type' => 'application/json; charset=utf-8',
            // 'Content-Type' => 'Application/x-www-form-urlencoded',
            'X-cons-id'    => $this->consid,
            'X-Timestamp'  => $this->bpjsTimestamp(),
            'X-Signature'  => $this->generateSignature(),
            'user_key'     => $this->userkey,
        ];

        try {
            $res = $this->client->request("GET", $action, [
                'headers' => $headers
            ]);
            $result = json_decode($res->getBody());
        } catch (\Exception $e) {
            return response()->json([
                "metadata" => [
                    "code" => 500,
                    "message" => "Request failed: ".$e->getMessage()
                ],
                "response" => null
            ], 500);
        }

        // decrypt jika ada response terenkripsi
        $string = $result->response ?? null;
        if ($string) {
            $getDecryption = $this->stringDecrypt($string);
            $result->response = json_decode($getDecryption);
        }

        return response()->json($result, 200);
    }

    public function getPesertaByNIK($nik, $tglsep)
    {
        $action = "Peserta/nik/{$nik}/tglSEP/{$tglsep}";

        $headers = [
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
            'X-cons-id'    => $this->consid,
            'X-Timestamp'  => $this->bpjsTimestamp,
            'X-Signature'  => $this->generateSignature(),
            'user_key'     => $this->userkey,
        ];

        $client = new \GuzzleHttp\Client([
            'base_uri' => $url,
            'headers'  => $headers,
            'verify'   => false, // disable SSL verify kalau di dev
        ]);

        try {
            $res = $client->request("GET", $action);
            $result = json_decode($res->getBody());
        } catch (\Exception $e) {
            return response()->json([
                "metadata" => [
                    "code" => 500,
                    "message" => "Request failed: ".$e->getMessage()
                ],
                "response" => null
            ], 500);
        }

        // decrypt jika ada response terenkripsi
        $string = $result->response ?? null;
        if ($string) {
            $key = $consid.$secretkey.$timestamp;
            $getDecryption = $this->stringDecrypt($key, $string);
            $result->response = json_decode($getDecryption);
        }

        return response()->json($result, 200);
    }

    public function getRujukanByNoKartu($nokartu)
    {
        $action = "Rujukan/RS/Peserta/{$nokartu}";

        $headers = [
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json; charset=utf-8',
            'X-cons-id'    => $this->consid,
            'X-Timestamp'  => $this->bpjsTimestamp,
            'X-Signature'  => $this->generateSignature(),
            'user_key'     => $this->userkey,
        ];

        $client = new Client([
            'base_uri' => $this->url,
            'headers'  => $headers,
            'verify'   => false, // disable SSL verify kalau di dev
        ]);

        try {
            $res = $client->request("GET", $action);
            $result = json_decode($res->getBody());
        } catch (\Exception $e) {
            return response()->json([
                "metadata" => [
                    "code" => 500,
                    "message" => "Request failed: ".$e->getMessage()
                ],
                "response" => null
            ], 500);
        }

        // decrypt jika ada response terenkripsi
        $string = $result->response ?? null;
        if ($string) {
            $getDecryption = $this->stringDecrypt($string);
            $result->response = json_decode($getDecryption);
        }

        return response()->json($result, 200);
    }

    public function insertRujukan(Request $request)
    {
        $url = 'Rujukan/2.0/insert';

        // Payload harus dibungkus ke dalam "request"
        $payload = [
            'noSep'        => '0151R0130824V001316',
            'tglRujukan'   => '2025-08-24',
            'tglRencanaKunjungan' => '2025-08-24',
            'ppkDirujuk'   => '0151R013',
            'jnsPelayanan' => '2',
            'catatan'      => 'Perlu penanganan lebih lanjut',
            'diagRujukan'  => 'A09',
            'tipeRujukan'  => '0',
            'poliRujukan'  => 'SAR',
            'user'         => 'adminRS',
        ];

        try {
            $response = $this->client->post($url, [
                'headers' => [
                    'Content-Type'  => 'application/json', // HARUS JSON
                    'X-cons-id'     => $this->consid,
                    'X-Timestamp'   => $this->bpjsTimestamp,
                    'X-Signature'   => $this->generateSignature(),
                    'user_key'      => $this->userkey,
                ],
                'body' => json_encode($payload) // kirim JSON
                // 'json' => [  // langsung pakai json
                //     // 'request' => [
                //         'noSep'        => '0151R0130824V001316',
                //         'tglRujukan'   => '2025-08-24',
                //         'tglRencanaKunjungan' => '2025-08-24',
                //         'ppkDirujuk'   => '0151R013',
                //         'jnsPelayanan' => '2',
                //         'catatan'      => 'Perlu penanganan lebih lanjut',
                //         'diagRujukan'  => 'A09',
                //         'tipeRujukan'  => '0',
                //         'poliRujukan'  => 'SAR',
                //         'user'         => 'adminRS',
                //     // ]
                // ]
            ]);
            // print_r($response);
            // die();

            $body = json_decode($response->getBody()->getContents(), true);
            return $body;

        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
                'response' => $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : null,
            ];
        }
    }


    // public function getPesertaByNIK()
    // {
    //     // DEFINE SECRET VAR
    //     $consid = env('BPJS_CONSID');
    //     $secretkey = env('BPJS_SECRETKEY');
    //     $userkey = env('BPJS_USERKEY');
    //     $url = '';
    //     // $url = 'Peserta/peserta/nik/3311072207970001';

    //     // API to BPJS
    //     // $result = $this->vclaimGet($url);

    //     // print_r($this->generateSignature());
    //     // die();
    //     $client = new Client();
    //     $res = $client->get('https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest/Peserta/nik/3311072207970001/tglSEP/2025-08-01', [
    //         'headers' => [
    //             'Accept' => 'application/Json',
    //             'X-cons-id' => $consid,
    //             'X-Timestamp' => $this->bpjsTimestamp(),
    //             'X-Signature' => $this->generateSignature(),
    //             'user_key' => $userkey,
    //         ]
    //     ]);
    //     $result = json_decode($res->getBody());
    //     // print_r($res);
    //     // die();

    //     // DEFINE VAR INTO DECRYPTION PROGRESS
    //     $string = $result->response;
    //     $key = $consid.$secretkey.$this->bpjsTimestamp();

    //     // RESULT DECRYPT WITH AES 256 (mode CBC) - SHA256 AND DECOMPRESSION WITH LZ-STRING
    //     $getDecryption = $this->stringDecrypt($key, $string);

    //     $data = [
    //         // 'metacode' => $result->metaData->code,
    //         // 'metamessage' => $result->metaData->message,
    //         'response' => json_decode($getDecryption)
    //     ];
    //     // print_r(json_decode($getDecryption));
    //     // die();

    //     return response()->json($data, 200);
    // }

    public function refPoli()
    {
        $url = 'ref/poli';

        // API to BPJS
        $result = $this->antreanGet($url);

        // RESULT DECRYPT WITH AES 256 (mode CBC) - SHA256 AND DECOMPRESSION WITH LZ-STRING
        $getDecryption = $this->stringDecrypt($result->response);

        $data = [
            // 'metacode' => $result->metaData->code,
            // 'metamessage' => $result->metaData->message,
            'response' => json_decode($getDecryption)
        ];
        // print_r(json_decode($getDecryption));
        // die();

        return response()->json($data, 200);
    }

    // public function refPoliTest()
    // {
    //     $url = 'ref/poli';

    //     // API to BPJS
    //     $result = $this->antreanGetTester($url);

    //     // RESULT DECRYPT WITH AES 256 (mode CBC) - SHA256 AND DECOMPRESSION WITH LZ-STRING
    //     $getDecryption = $this->stringDecrypt($result->response);

    //     $data = [
    //         // 'metacode' => $result->metaData->code,
    //         // 'metamessage' => $result->metaData->message,
    //         'response' => json_decode($getDecryption)
    //     ];
    //     // print_r(json_decode($getDecryption));
    //     // die();

    //     return response()->json($data, 200);
    // }

    // function decrypt($string) {
    //     $consid = env('BPJS_CONSID');
    //     $secretkey = env('BPJS_SECRETKEY');
    //     // RESULT DECRYPT WITH AES 256 (mode CBC) - SHA256 AND DECOMPRESSION WITH LZ-STRING
    //     $key = $consid.$secretkey.$this->bpjsTimestamp();
    //     $getDecryption = $this->stringDecrypt($string);

    //     $data = [
    //         'response' => json_decode($getDecryption)
    //     ];

    //     return response()->json($data, 200);
    // }

    public function cariJadwalTest()
    {
        $url = 'jadwaldokter/kodepoli/INT/tanggal/2023-09-12';

        // API to BPJS
        $result = $this->antreanGetTester($url);

        // RESULT DECRYPT WITH AES 256 (mode CBC) - SHA256 AND DECOMPRESSION WITH LZ-STRING
        $getDecryption = $this->stringDecrypt($result->response);

        $data = [
            // 'consid' => $consid,
            // 'secretkey' => $secretkey,
            // 'userkey' => $userkey,
            // 'url' => $url,
            // 'metaData' => $result,
            'decryptResponse' => json_decode($getDecryption)
        ];

        // dd($data);

        return response()->json($data, 200);
    }

    public function cariJadwal($poli, $tgl)
    {
        $url = 'jadwaldokter/kodepoli/'.$poli.'/tanggal/'.$tgl;

        // API to BPJS
        $result = $this->antreanGet($url);

        // RESULT DECRYPT WITH AES 256 (mode CBC) - SHA256 AND DECOMPRESSION WITH LZ-STRING
        $getDecryption = $this->stringDecrypt($result->response);

        $data = [
            // 'metacode' => $result->metaData->code,
            // 'metamessage' => $result->metaData->message,
            'response' => json_decode($getDecryption)
        ];

        return response()->json($data, 200);
    }

    public function antreanGet($url)
    {
        $consid = env('BPJS_CONSID');
        $userkey = env('BPJS_USERKEY'); // 3531661b282c4997d496bf34de35871e

        $client = new Client();
        $res = $client->get('https://apijkn.bpjs-kesehatan.go.id/antreanrs/'.$url, [
            'headers' => [
                'X-cons-id' => $consid,
                'X-Timestamp' => $this->bpjsTimestamp(),
                'X-Signature' => $this->generateSignature(),
                'user_key' => $userkey,
            ]
        ]);
        // RESULT API INTO JSON DECODED
        return json_decode($res->getBody());
    }

    // public function antreanGetTester($url)
    // {
    //     $consid = env('BPJS_CONSID');
    //     $userkey = env('BPJS_USERKEY');

    //     $client = new Client();
    //     $res = $client->get('https://apijkn-dev.bpjs-kesehatan.go.id/antreanrs_dev/'.$url, [
    //         'headers' => [
    //             'X-cons-id' => $consid,
    //             'X-Timestamp' => $this->bpjsTimestamp(),
    //             'X-Signature' => $this->generateSignature(),
    //             'user_key' => $userkey,
    //         ]
    //     ]);
    //     // RESULT API INTO JSON DECODED
    //     return json_decode($res->getBody());
    // }

    // public function createRujukan()
    // {
    //     $consid = env('BPJS_CONSID');
    //     $userkey = env('BPJS_USERKEY');

    //     $client = new Client();

    //     $res = $client->post('https://apijkn.bpjs-kesehatan.go.id/antreanrs/'.$url, [
    //         'json' => [
    //             'kodebooking' => $kdbook
    //         ],
    //         'headers' => [
    //             'X-cons-id' => $consid,
    //             'X-Timestamp' => $this->bpjsTimestamp(),
    //             'X-Signature' => $this->generateSignature(),
    //             'user_key' => $userkey,
    //         ]
    //     ]);

    //     // RESULT API INTO JSON DECODED
    //     return json_decode($res->getBody());
    // }

    // public function vclaimGet($url)
    // {
    //     $consid = env('BPJS_CONSID');
    //     $userkey = env('BPJS_USERKEY');

    //     $client = new Client();
    //     $res = $client->get('https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest/'.$url, [
    //         'headers' => [
    //             'Accept' => 'application/Json',
    //             'X-cons-id' => $consid,
    //             'X-Timestamp' => $this->bpjsTimestamp(),
    //             'X-Signature' => $this->generateSignature(),
    //             'user_key' => $userkey,
    //         ]
    //     ]);
    //     // RESULT API INTO JSON DECODED
    //     return json_decode($res->getBody());
    // }

    // public function vclaimPost($url, $kdbook)
    // {
    //     $consid = env('BPJS_CONSID_DEV');
    //     $userkey = env('BPJS_USERKEY_DEV');

    //     $client = new Client();

    //     $res = $client->post('https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest/'.$url, [
    //         'json' => [
    //             'kodebooking' => $kdbook
    //         ],
    //         'headers' => [
    //             'X-cons-id' => $consid,
    //             'X-Timestamp' => $this->bpjsTimestamp(),
    //             'X-Signature' => $this->generateSignature(),
    //             'user_key' => $userkey,
    //         ]
    //     ]);

    //     // RESULT API INTO JSON DECODED
    //     return json_decode($res->getBody());
    // }

    // public function antreanPost($url, $kdbook)
    // {
    //     $consid = env('BPJS_CONSID');
    //     $userkey = env('BPJS_USERKEY');

    //     $client = new Client();

    //     $res = $client->post('https://apijkn.bpjs-kesehatan.go.id/antreanrs/'.$url, [
    //         'json' => [
    //             'kodebooking' => $kdbook
    //         ],
    //         'headers' => [
    //             'X-cons-id' => $consid,
    //             'X-Timestamp' => $this->bpjsTimestamp(),
    //             'X-Signature' => $this->generateSignature(),
    //             'user_key' => $userkey,
    //         ]
    //     ]);

    //     // RESULT API INTO JSON DECODED
    //     return json_decode($res->getBody());
    // }

    // ------------------------------------------------------------  TOOLS BPJS  --------------------------------------------------------------
	public function generateSignature()
	{
        // Computes the signature by hashing the salt with the secret key as the key
        $signature = hash_hmac('sha256', $this->consid."&".$this->bpjsTimestamp(), $this->secretkey, true);

        // base64 encode�
        $encodedSignature = base64_encode($signature);

		return $encodedSignature;
	}

	public function bpjsTimestamp() // DEFAULT
	{
        return (string) gmdate('U');
        // date_default_timezone_set('UTC');
        // $result = strval(time()-strtotime('1970-01-01 00:00:00'));
		// return $result;
	}

	// public function getTimestamp($date)
	// {
    //     Carbon::setLocale('id');
    //     return $result = Carbon::parse($date / 1000)->format("d M Y, H:m:s");
	// }

	public function stringDecrypt($string)
	{
        $key = $this->consid.$this->secretkey.$this->bpjsTimestamp();

		$encrtyp_method = 'AES-256-CBC';

        $key_hash = hex2bin(hash('sha256', $key));

        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

        $dekripsi = openssl_decrypt(base64_decode($string), $encrtyp_method, $key_hash, OPENSSL_RAW_DATA, $iv);

        $decompress = \LZCompressor\LZString::decompressFromEncodedURIComponent($dekripsi);

        return $decompress;
	}
}
