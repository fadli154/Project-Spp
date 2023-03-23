<?php

namespace App\Http\Controllers;

use App\Models\WaliKelas;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

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
            $kelasList = WaliKelas::with('kelas')->paginate(6);
        } else if (strlen($katakunci)) {
            $waliKelasList = WaliKelas::where('nip_wali_kelas', 'like', "%$katakunci%")
                ->orWhere('nama_wali_kelas', 'like', "%$katakunci%")
                ->orWhere('jabatan', 'like', "%$katakunci%")
                ->paginate(8);
            $kelasList = WaliKelas::has('kelas')->paginate(6);
        } else {
            $waliKelasList = WaliKelas::paginate(8);
            $kelasList = WaliKelas::with('kelas')->paginate(6);
        }

        return view('/manajemen_siswa.wali_kelas.wali_kelas_data', [
            'title' => 'Wali Kelas',
            'active' => 'wali-kelas',
            'active1' => 'siswa',
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
            'active' => 'wali-kelas',
            'active1' => 'siswa',
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
        $validateData = $request->validate([
            'nip_wali_kelas' => 'required|max:18|min:18|unique:pegawai',
            'nama_wali_kelas' => 'required|max:60|min:2',
            'jk' => 'required',
            'foto' => 'image|file|max:1024',
        ]);

        if ($request->file('foto')) {
            $validateData['foto'] = $request->file('foto')->store('foto-wali-kelas');
        }

        WaliKelas::create($validateData);

        Alert::success('Success', 'Berhasil Menambah Data Wali Kelas !!');
        return redirect('/wali-kelas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailData = WaliKelas::where('nip_wali_kelas', $id)->get();
        $kelasList = DB::table('pegawai')->join('kelas', 'pegawai.nip_wali_kelas', '=', 'kelas.nip_wali_kelas')->select('kelas.*', 'kelas.kelas_id', 'kelas.kelas', 'kelas.angkatan')->where('kelas.nip_wali_kelas', '=', $id)->get();

        return view('/manajemen_siswa.wali_kelas.wali_kelas_detail', [
            'title' => 'Detail',
            'active' => 'wali-kelas',
            'active1' => 'siswa',
            'detailData' => $detailData,
            'kelasList' => $kelasList,
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
        $waliKelasList = WaliKelas::where('nip_wali_kelas', $id)->get();

        return view('manajemen_siswa.wali_kelas.wali_kelas_edit', [
            'title' => 'Edit',
            'active' => 'wali-kelas',
            'active1' => 'siswa',
            'editData' => $waliKelasList,
        ]);
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
        $validateData = $request->validate([
            'nip_wali_kelas' => 'required|max:18|min:18|unique:pegawai,nip_wali_kelas,' . $id . ',nip_wali_kelas',
            'nama_wali_kelas' => 'required|max:60',
            'jk' => 'required',
            'foto' => 'image|file|max:1024',
        ]);

        if ($request->file('foto')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['foto'] = $request->file('foto')->store('foto-wali-kelas');
        }

        WaliKelas::where('nip_wali_kelas', $id)->update($validateData);
        Alert::success('Success', 'Berhasil Mengubah Data Wali Kelas !!');
        return redirect('/wali-kelas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if ($request->oldImage) {
            Storage::delete($request->oldImage);
        }
        WaliKelas::where('nip_wali_kelas', $id)->delete();
        Alert::success('Success', 'Berhasil Menghapus Data Wali Kelas !!');
        return redirect('/wali-kelas');
    }
}
