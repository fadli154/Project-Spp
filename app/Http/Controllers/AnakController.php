<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnakController extends Controller
{
    public function index()
    {
        $dataAnak = Auth::user()->siswa;
        if ($dataAnak != null) {
            foreach ($dataAnak as $item) {
                $kelasList = Kelas::where('kelas_id', $item->kelas_id)->get();
            }
        }

        return view('wali-murid.anak_wali_data', [
            'title' => 'Data Anak',
            'active' => 'Anak',
            'active1' => 'Anak',
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
            'active1' => 'Tagihan',
            'dataList' => $dataTagihan,
        ]);
    }
}
