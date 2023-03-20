<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KonsentrasiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\WaliKelasController;
use App\Http\Controllers\WaliMuridController;

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
