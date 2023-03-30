<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
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

        return view('wali-murid.anak_wali', [
            'title' => 'Data Anak',
            'active' => 'Anak',
            'active1' => 'Anak',
            'dataList' => $dataAnak,
            'kelasList' => $kelasList,
        ]);
    }
}
