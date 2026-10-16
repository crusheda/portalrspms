<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Publik\JadwalSpesialisController;
use App\Http\Controllers\Publik\KetersediaanTTController;

// -------------------------------------------  PUBLIC API  ---------------------------------------------

// --------------------------------------------  API BPJS  ----------------------------------------------
// PUBLIK
    // JADWAL DOKTER SPESIALIS
        Route::get('bpjs/bridging/antrean/poli/{poli}/{tgl}', [JadwalSpesialisController::class, 'cariJadwal']);
        Route::get('bpjs/bridging/antrean/poli', [JadwalSpesialisController::class, 'jadwalMingguanAllPoli']);
        Route::get('bpjs/bridging/antrean/poli/pdf', [JadwalSpesialisController::class,'exportJadwalPdf']);

    // KETERSEDIAAN TT
        Route::get('informasi/tt', [KetersediaanTTController::class, 'getTT'])->name('ketersediaan.tt.getTT');
