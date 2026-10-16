<?php

namespace App\Http\Controllers\Bpjs;

use App\Http\Controllers\Controller;
use App\Services\BpjsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ICareController extends Controller
{
    protected $BpjsService;

    public function __construct(BpjsService $BpjsService)
    {
        $this->bpjs = $BpjsService;
    }

    public function getICare() // $no_kartu, $kd_dokter
    {
        $url = 'api/rs/validate';

        $result = $this->bpjs->serviceGetIcare($url, '0000562895425', '272681'); // RM.139218 (dr. Totok)

        if (($result['metaData']['code'] ?? 500) != 200) {
            return response()->json($result, 500);
        }

        // $getDecryption = $this->bpjs->stringDecrypt($result->response);
        $getDecryption = $this->bpjs->stringDecrypt($result['response']);

        // return response()->json(json_decode($getDecryption, true), 200);

        $data = json_decode($getDecryption, true);

        return view('pages.icare', [
            'url' => $data['url']
        ]);
    }
}
