<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'dashboard')
    ->name('beranda');

Route::livewire('/profil-rs', 'profil-rs')
    ->name('profil-rs');

Route::livewire('/tentang', 'tentang')
    ->name('tentang');

Route::livewire('/jadwal-dokter', 'jadwal-dokter')
    ->name('jadwal-dokter');

Route::livewire('/ketersediaan-tempat-tidur', 'ketersediaan-tempat-tidur')
    ->name('ketersediaan-tempat-tidur');
