<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController, loginController, PetugasController, dashboardController, KonsentrasiController, SiswaController, WaliKelasController, WaliMuridController, KelasController};

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
