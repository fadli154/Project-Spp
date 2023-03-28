<?php

use Illuminate\Support\Facades\Route;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
use App\Http\Controllers\{AdminController, loginController, PetugasController, dashboardController, KonsentrasiController, SiswaController, WaliKelasController, WaliMuridController, KelasController, BiayaController, KwitansiPembayaranController, TagihanController, WaliSiswaController, PembayaranController};

Route::get('/', function () {
    return view('pages.index', [
        'title' => 'Start Page',
        'active' => 'Start Page',
    ]);
});

Route::get('/login', [loginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [loginController::class, 'authenticated']);
Route::post('/logout', [loginController::class, 'logout']);

Route::get('/dashboard', [dashboardController::class, 'index'])->middleware('petugas');

Route::resource('/administrator', AdminController::class)->middleware('petugas');
Route::resource('/petugas', PetugasController::class)->middleware('petugas');
Route::resource('/wali-murid', WaliMuridController::class)->middleware('petugas');
Route::resource('/siswa', SiswaController::class)->middleware('petugas');
Route::resource('/konsentrasi-keahlian', KonsentrasiController::class)->middleware('petugas');
Route::resource('/wali-kelas', WaliKelasController::class)->middleware('petugas');
Route::resource('/kelas', KelasController::class)->middleware('petugas');
Route::resource('/biaya', BiayaController::class)->middleware('petugas');
Route::resource('/tagihan', TagihanController::class)->middleware('petugas');
Route::resource('/wali-siswa', WaliSiswaController::class)->except('index', 'create', 'show', 'destroy', 'edit')->middleware('petugas');
Route::resource('/pembayaran', PembayaranController::class)->middleware('petugas');

Route::resource('/kwitansi-pembayaran', KwitansiPembayaranController::class)->except('index', 'create', 'store', 'update', 'destroy', 'edit');
Route::get('tagihan1/{id}', [TagihanController::class, 'hapus']);
