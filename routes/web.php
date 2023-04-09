<?php

use Illuminate\Support\Facades\Route;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
use App\Http\Controllers\{AdminController, AnakController, loginController, PetugasController, dashboardController, KonsentrasiController, SiswaController, WaliKelasController, WaliMuridController, KelasController, BiayaController, dashboardWaliController, KwitansiPembayaranController, TagihanController, WaliSiswaController, PembayaranController, profileController, ExportController, LaporanController};

Route::get('/', function () {
    return view('pages.index', [
        'title' => 'Start Page',
        'active' => 'Start Page',
    ]);
});

Route::get('/login', [loginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [loginController::class, 'authenticated']);
Route::post('/logout', [loginController::class, 'logout']);

Route::get('/dashboard', [dashboardController::class, 'index'])->middleware('auth');
Route::get('/profile', [profileController::class, 'index'])->middleware('auth');
Route::get('/change-password', [profileController::class, 'changePassword'])->middleware('auth');
Route::post('/process-change-password', [profileController::class, 'processChangePassword'])->middleware('auth');

// route admin\
Route::resource('/administrator', AdminController::class)->middleware('admin');
Route::resource('/petugas', PetugasController::class)->middleware('admin');
Route::resource('/wali-murid', WaliMuridController::class)->middleware('admin');
Route::resource('/siswa', SiswaController::class)->middleware('auth');
Route::resource('/konsentrasi-keahlian', KonsentrasiController::class)->middleware('admin');
Route::resource('/wali-kelas', WaliKelasController::class)->middleware('admin');
Route::resource('/kelas', KelasController::class)->middleware('admin');
Route::resource('/biaya', BiayaController::class)->middleware('petugas');
Route::resource('/tagihan', TagihanController::class)->middleware('petugas');
Route::resource('/wali-siswa', WaliSiswaController::class)->except('index', 'create', 'show', 'destroy', 'edit')->middleware('admin');
Route::resource('/pembayaran', PembayaranController::class)->middleware('auth');
Route::resource('/kwitansi-pembayaran', KwitansiPembayaranController::class)->except('index', 'create', 'store', 'update', 'destroy', 'edit')->middleware('petugas');
Route::get('laporan-pembayaran', [LaporanController::class, 'laporanPembayaran'])->middleware('admin');
Route::get('tagihan1/{id}', [TagihanController::class, 'hapus'])->middleware('admin');
// export to excel
Route::get('/siswa-export', [ExportController::class, 'siswaExport'])->name('siswa-export')->middleware('admin');
Route::post('/pembayaran-export', [LaporanController::class, 'pembayaranExport'])->name('pembayaran-export')->middleware('admin');

// Router Wali
Route::get('/anak', [AnakController::class, 'index'])->middleware('wali');
Route::get('/tagihan-wali', [AnakController::class, 'tagihan'])->middleware('wali');
Route::get('/riwayat-pembayaran', [AnakController::class, 'riwayatPembayaran'])->middleware('wali');
