<?php

namespace App\Http\Controllers;

use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WaliKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jenis_kelamin = $request->jk;
        $jabatan = $request->jabatan;
        $status_pegawai = $request->status_pegawai;

        if (strlen($jenis_kelamin) || strlen($jabatan) || strlen($status_pegawai)) {
            $waliKelasList = WaliKelas::when(!is_null($jenis_kelamin), function ($query) use ($jenis_kelamin) {
                return $query->where('jk', $jenis_kelamin);
            })->when(!is_null($jabatan), function ($query) use ($jabatan) {
                return $query->where('jabatan', $jabatan);
            })->when(!is_null($status_pegawai), function ($query) use ($status_pegawai) {
                return $query->where('status_pegawai', $status_pegawai);
            })->latest()->paginate(8);
            $kelasList = DB::table('pegawai')->join('kelas', 'pegawai.nip_wali_kelas', '=', 'kelas.nip_wali_kelas')->select('kelas.*', 'kelas.kelas_id', 'kelas.kelas', 'kelas.angkatan')->get();
        } else if (strlen($katakunci)) {
            $waliKelasList = WaliKelas::where('nip_wali_kelas', 'like', "%$katakunci%")
                ->orWhere('nama_wali_kelas', 'like', "%$katakunci%")
                ->orWhere('jk', 'like', "%$katakunci%")
                ->paginate(8);
            $kelasList = DB::table('pegawai')->join('kelas', 'pegawai.nip_wali_kelas', '=', 'kelas.nip_wali_kelas')->where('kelas', 'like', "%$katakunci%")
                ->orWhere('angkatan', 'like', "%$katakunci%")
                ->paginate(8);
        } else {
            $waliKelasList = WaliKelas::paginate(8);
            $kelasList = DB::table('pegawai')->join('kelas', 'pegawai.nip_wali_kelas', '=', 'kelas.nip_wali_kelas')->select('kelas.*', 'kelas.kelas_id', 'kelas.kelas', 'kelas.angkatan')->get();
        }

        return view('/manajemen_siswa.wali_kelas.wali_kelas_data', [
            'title' => 'Wali Kelas',
            'active' => 'wali-kelas',
            'dataList' => $waliKelasList,
            'kelasList' => $kelasList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelasList = DB::table('pegawai')->rightJoin('kelas', 'pegawai.nip_wali_kelas', '=', 'kelas.nip_wali_kelas')->select('kelas.*', 'kelas.kelas_id', 'kelas.kelas', 'kelas.angkatan')->get();

        return view('/manajemen_siswa.wali_kelas.wali_kelas_create', [
            'title' => 'Wali Kelas',
            'active' => 'Wali Kelas',
            'kelasList' => $kelasList,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
