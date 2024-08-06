<?php

use App\Http\Controllers\Admin\PesertaController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function() {
    Route::prefix('peserta')->name('peserta.')->group(function(){
        Route::get('/', [PesertaController::class, 'index'])->name('index');
        Route::get('/{id}/show', [PesertaController::class, 'show'])->name('show');
        Route::get('/{id}/approved', [PesertaController::class, 'approvedPeserta'])->name('approved');
        Route::get('/{id}/tolak', [PesertaController::class, 'rejectedPeserta'])->name('rejected');

        Route::get('/upload', [PesertaController::class, 'upload'])->name('upload');
        Route::get('/tolak', [PesertaController::class, 'tolak'])->name('tolak');
        Route::get('/terima', [PesertaController::class, 'terima'])->name('terima');
        Route::get('/tolak-dokumentasi', [PesertaController::class, 'dokumenTolak'])->name('dokumenTolak');
    });

    Route::prefix('dokumen')->name('dokumen.')->group(function(){
        Route::get('/{id}/approved', [PesertaController::class, 'approvedDokumen'])->name('approved');
        Route::get('/{id}/tolak', [PesertaController::class, 'rejectedDokumen'])->name('rejected');
    });
});