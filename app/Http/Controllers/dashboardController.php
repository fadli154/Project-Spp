<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\WaliKelas;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->level == 'administrator') {
            $totalAdmin = User::where('level', 'administrator')->get();
            $totalAdmin = count($totalAdmin);

            $totalWaliMurid = User::where('level', 'wali')->get();
            $totalWaliMurid = count($totalWaliMurid);

            $totalSiswa = Siswa::get();
            $totalSiswa = count($totalSiswa);
            $totalLaki = Siswa::where('jk', 'L')->get();
            $totalLaki = count($totalLaki);
            $totalPerempuan = Siswa::where('jk', 'P')->get();
            $totalPerempuan = count($totalPerempuan);

            $tagihanData = Tagihan::latest()->paginate(6);

            $pembayaranList = Pembayaran::with('tagihan')->latest()->paginate(6);
            $tagihanList = Tagihan::with('siswa')->groupBy('nisn')->get();
            $kelasList = Kelas::get();

            $waliKelasList = WaliKelas::get();
            $totalWaliKelas = count($waliKelasList);
        } else if (auth()->user()->level == 'petugas') {
            $totalSiswa = Siswa::get();
            $totalSiswa = count($totalSiswa);

            $totalLaki = Siswa::where('jk', 'L')->get();
            $totalLaki = count($totalLaki);
            $totalPerempuan = Siswa::where('jk', 'P')->get();
            $totalPerempuan = count($totalPerempuan);

            $totalWaliMurid = User::where('level', 'wali')->get();
            $totalWaliMurid = count($totalWaliMurid);
            $tagihanData = Tagihan::latest()->paginate(6);

            $pembayaranList = Pembayaran::with('tagihan')->latest()->paginate(6);
            $tagihanList = Tagihan::with('siswa')->groupBy('nisn')->get();
            $kelasList = Kelas::get();

            $waliKelasList = WaliKelas::get();
            $totalWaliKelas = count($waliKelasList);
        } else if (auth()->user()->level == 'wali') {
            // data untuk wali
            $dataAnak = Auth::user()->siswa;
            $tagihanList = Tagihan::with('siswa')->groupBy('nisn')->get();
            $kelasList = Kelas::get();
            $totalTagihan = null;
            $totalPembayaran = null;
            if ($dataAnak) {
                foreach ($dataAnak as $item) {
                    $tagihanAnak = Tagihan::where('nisn', $item->nisn)->get();
                    foreach ($tagihanAnak as $tagihanAnakItem) {
                        $PembayaranAnak = Pembayaran::where('tagihan_id', $tagihanAnakItem->id)->get();
                        foreach ($PembayaranAnak as $pembayaranAnakItem) {
                            $totalPembayaran = $pembayaranAnakItem->sum('jumlah_dibayar');
                        }
                        $totalTagihan = $tagihanAnakItem->sum('sisa_tagihan');
                    }
                }
            }
        }

        // Timezone
        $currentTime = Carbon::now();
        $hour = $currentTime->hour;

        if ($hour >= 5 && $hour <= 12) {
            $greeting = 'Selamat Pagi';
        } elseif ($hour >= 13 && $hour <= 17) {
            $greeting = 'Selamat Sore';
        } else {
            $greeting = 'Selamat Malam';
        }

        if (auth()->user()->level == 'wali') {
            return view('pages.dashboard', [
                'title' => 'Dashboard',
                'active' => 'Dashboard',
                'active1' => 'Dashboard',
                'greeting' => $greeting,
                'dataAnak' => $dataAnak,
                'kelasList' => $kelasList,
                'tagihanList' => $tagihanList,
                'tagihanAnak' => $tagihanAnak,
                'totalTagihan' => $totalTagihan,
                'totalPembayaran' => $totalPembayaran,
            ]);
        } else if (auth()->user()->level == 'petugas') {
            return view('pages.dashboard', [
                'title' => 'Dashboard',
                'active' => 'Dashboard',
                'active1' => 'Dashboard',
                'greeting' => $greeting,
                'totalSiswa' => $totalSiswa,
                'dataList' => $pembayaranList,
                'tagihanList' => $tagihanList,
                'tagihanData' => $tagihanData,
                'kelasList' => $kelasList,
                'totalWaliMurid' => $totalWaliMurid,
                'totalLaki' => $totalLaki,
                'totalPerempuan' => $totalPerempuan,
            ]);
        } else if (auth()->user()->level == 'administrator') {
            return view('pages.dashboard', [
                'title' => 'Dashboard',
                'active' => 'Dashboard',
                'active1' => 'Dashboard',
                'greeting' => $greeting,
                'totalAdmin' => $totalAdmin,
                'totalSiswa' => $totalSiswa,
                'totalLaki' => $totalLaki,
                'totalPerempuan' => $totalPerempuan,
                'dataList' => $pembayaranList,
                'tagihanList' => $tagihanList,
                'tagihanData' => $tagihanData,
                'kelasList' => $kelasList,
                'totalWaliKelas' => $totalWaliKelas,
                'totalWaliMurid' => $totalWaliMurid,
            ]);
        }
    }
}
