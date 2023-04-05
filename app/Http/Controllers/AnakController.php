<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnakController extends Controller
{
    public function index()
    {
        $dataAnak = Auth::user()->siswa;
        $kelasList = Kelas::get();


        return view('wali-murid.anak_wali_data', [
            'title' => 'Data Anak',
            'active' => 'siswa',
            'active1' => 'siswa',
            'dataList' => $dataAnak,
            'kelasList' => $kelasList,
        ]);
    }

    public function tagihan()
    {
        $nisnSiswa = Auth::user()->siswa->pluck('nisn');
        $dataTagihan = Tagihan::whereIn('nisn', $nisnSiswa)->get();

        return view('wali-murid.tagihan_wali', [
            'title' => 'Data Tagihan',
            'active' => 'Tagihan',
            'active1' => 'pembayaran',
            'dataList' => $dataTagihan,
        ]);
    }

    public function riwayatPembayaran()
    {
        $nisnSiswa = Auth::user()->siswa->pluck('nisn');
        $kelasList = Kelas::get();
        $dataTagihan = Tagihan::whereIn('nisn', $nisnSiswa)->get();
        $dataPembayaran = Pembayaran::with('tagihan')->paginate(2);

        return view('wali-murid.riwayat_pembayaran', [
            'title' => 'Data Tagihan',
            'active' => 'Pembayaran',
            'active1' => 'pembayaran',
            'tagihanList' => $dataTagihan,
            'dataList' => $dataPembayaran,
            'kelasList' => $kelasList,
        ]);
    }
}
