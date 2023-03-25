<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Biaya;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Models\TagihanDetails;
use RealRashid\SweetAlert\Facades\Alert;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        if (strlen($katakunci)) {
            $sppList = Tagihan::where('nama_biaya', 'like', "%$katakunci%")
                ->orWhere('nominal', 'like', "%$katakunci%")
                ->paginate(3);
        } else {
            $sppList = Tagihan::paginate(6);
        }


        return view('/pembayaran.tagihan.tagihan_data', [
            'title' => 'tagihan',
            'active' => 'tagihan',
            'active1' => 'pembayaran',
            'dataList' => $sppList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $biayaData = Biaya::get();
        $kelasData = Kelas::get();

        return view('/pembayaran.tagihan.tagihan_create', [
            'title' => 'Tambah Data',
            'active' => 'tagihan',
            'active1' => 'pembayaran',
            'biayaData' => $biayaData,
            'kelasData' => $kelasData,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'biaya_id.*' => 'required',
            'kelas_id' => 'required',
            'tanggal_tagihan' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date',
            'keterangan' => 'nullable',
        ]);

        $biayaIdArray = $request['biaya_id'];

        $siswa = Siswa::with('tagihan')->where('kelas_id', $request['kelas_id'])->get();

        foreach ($siswa as $item) {
            $itemSiswa = $item;
            $biaya = Biaya::whereIn('id', $biayaIdArray)->get();
            $dataTagihan = [
                'nisn' => $itemSiswa->nisn,
                'user_id' => $request['user_id'],
                'kelas_id' => $request['kelas_id'],
                'tanggal_tagihan' => $request['tanggal_tagihan'],
                'tanggal_jatuh_tempo' => $request['tanggal_jatuh_tempo'],
                'keterangan' => $request['keterangan'],
                'status' => 'baru',
            ];
            $tanggalTagihan = Carbon::parse($request['tanggal_tagihan']);
            $bulanTagihan = $tanggalTagihan->format('m');
            $tahunTagihan = $tanggalTagihan->format('Y');
            $cekTagihan = Tagihan::where('nisn', $itemSiswa->nisn)
                ->first();
            if ($cekTagihan == null) {
                $tagihan = Tagihan::create($dataTagihan);
                foreach ($biaya as $itemBiaya) {
                    $detail = TagihanDetails::create([
                        'tagihan_id' => $tagihan->id,
                        'nama_biaya' => $itemBiaya->nama_biaya,
                        'nominal_biaya' => $itemBiaya->nominal,
                    ]);
                }
            }
        }
        Alert::success('Success', 'Berhasil Menambah Data Tagihan !!');
        return redirect('/tagihan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailData = siswa::where('nisn', $id)->get();
        $waliList = User::with('siswa')->get();
        $kelasList = Kelas::with('siswa', 'WaliKelas')->get();
        $tagihan =  Tagihan::with('tagihanDetails')->where('nisn', $id)->get();
        foreach ($tagihan as $item) {
            $tagihanDetails = $item->tagihanDetails;
        }

        return view('/manajemen_siswa.siswa_detail', [
            'title' => 'Detail',
            'active' => 'siswa',
            'active1' => 'siswa',
            'detailData' => $detailData,
            'waliList' => $waliList,
            'kelasList' => $kelasList,
            'tagihanList' => $tagihan,
            'tagihanDetailList' => $tagihanDetails,
            'showTab' => 'tagihan',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
