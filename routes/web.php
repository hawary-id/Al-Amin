<?php

use App\Http\Controllers\BPRS\PesertaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::name('bprs.')->middleware('auth')->group(function () {
    Route::resource('peserta', PesertaController::class);
    Route::get('peserta/status/upload', [PesertaController::class, 'upload'])->name('peserta.upload');
    Route::get('peserta/status/diterima', [PesertaController::class, 'terima'])->name('peserta.terima');
    Route::get('peserta/status/ditolak', [PesertaController::class, 'tolak'])->name('peserta.tolak');
    Route::get('peserta/status/dokumen-ditolak', [PesertaController::class, 'dokumenTolak'])->name('peserta.dokumenTolak');
    Route::get('peserta/{id}/print', [PesertaController::class, 'print'])->name('peserta.print');
    
    Route::get('dokumen/upload', [PesertaController::class, 'dokumenUpload'])->name('dokumen.upload');
    Route::post('dokumen/upload', [PesertaController::class, 'dokumenStore'])->name('dokumen.store');
});


array_map(function ($file) {
    require_once $file;
}, [
    __DIR__.'/auth.php',
    __DIR__.'/admin.php'
]);
