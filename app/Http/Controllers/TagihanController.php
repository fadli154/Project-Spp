<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Biaya;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\TagihanDetails;
use Illuminate\Support\Facades\DB;
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
            $tagihanList = Tagihan::where('status', 'like', "%$katakunci%")
                ->orWhere('nisn', 'like', "%$katakunci%")
                ->orWhere('kelas_id', 'like', "%$katakunci%")
                ->latest()->paginate(3);
        } else {
            $tagihanList = Tagihan::latest()->paginate(6);
        }


        return view('/pembayaran.tagihan.tagihan_data', [
            'title' => 'tagihan',
            'active' => 'tagihan',
            'active1' => 'pembayaran',
            'dataList' => $tagihanList,
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
        // melakukan validasi tagihan
        $request->validate([
            'biaya_id.*' => 'required',
            'kelas_id' => 'required',
            'tanggal_tagihan' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date',
            'keterangan' => 'nullable',
        ]);

        // masukkan semua biaya yang ingin di tagih
        $biayaIdArray = $request['biaya_id'];

        // ambil semua data siswa yang aktif dan sesuai dengan kelas yang ingin di tagih
        $siswa = Siswa::with('tagihan')->where('kelas_id', $request['kelas_id'])->where('status', '1')->get();
        if (count($siswa) == 0) {
            Alert::error('Error', 'Data Siswa Tidak ada !!');
            return redirect('/tagihan');
        }

        foreach ($siswa as $item) {
            $itemSiswa = $item;
            $biaya = Biaya::whereIn('id', $biayaIdArray)->get();
            foreach ($biaya as $biayaData) {
                $sisa_tagihan[] = $biayaData->nominal;
            }

            $dataTagihan = [
                'nisn' => $itemSiswa->nisn,
                'user_id' => $request['user_id'],
                'kelas_id' => $request['kelas_id'],
                'tanggal_tagihan' => $request['tanggal_tagihan'],
                'tanggal_jatuh_tempo' => $request['tanggal_jatuh_tempo'],
                'keterangan' => $request['keterangan'],
                'status' => 'baru',
                'sisa_tagihan' => array_sum($sisa_tagihan),
            ];

            $tanggalTagihan = Carbon::parse($request['tanggal_tagihan']);
            // $bulanTagihan = $tanggalTagihan->format('m');
            // $tahunTagihan = $tanggalTagihan->format('Y');
            $cekTagihan = TagihanDetails::has('tagihan')->whereIn('biaya_id', $biayaIdArray)
                ->first();
            $cekSiswa = Tagihan::has('siswa')->where('nisn', $itemSiswa->nisn)->first();
            // $cekKelas = Tagihan::has('kelas')->where('kelas_id', $request['kelas_id'])->first();

            if ($cekTagihan == null || $cekSiswa == null) {
                $tagihan = Tagihan::create($dataTagihan);
                // $sisa_tagihan[] = 0;
                foreach ($biaya as $itemBiaya) {
                    $detail = TagihanDetails::create([
                        'tagihan_id' => $tagihan->id,
                        'biaya_id' => $itemBiaya->id,
                        'nama_biaya' => $itemBiaya->nama_biaya,
                        'nominal_biaya' => $itemBiaya->nominal,
                    ]);
                    for ($i = 0; $i < count($sisa_tagihan); $i++) {
                        $sisa_tagihan = [$i => 0];
                    }
                }
            } else {
                Alert::error('Error', 'Gagal Menambah data Tagihan !!');
                return redirect('/tagihan');
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
        $pembayaran = Pembayaran::get();
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
            'pembayaranList' => $pembayaran,
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
    public function destroy($id, Request $request)
    {
        TagihanDetails::where('id', $request['id_details'])->delete();
        Alert::success('Success', 'Berhasil Menghapus Data Tagihan Siswa !!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapus($id, Request $request)
    {
        Tagihan::where('id', $id)->with('tagihanDetails', 'pembayaran')->delete();
        Alert::success('Success', 'Berhasil Menghapus Data Tagihan Siswa !!');
        return back();
    }
}
