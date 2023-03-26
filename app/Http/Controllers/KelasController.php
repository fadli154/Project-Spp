<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;

        if (strlen($request->angkatan)) {
            $kelasList = Kelas::where('angkatan', '=', "$request->angkatan")
                ->paginate(6);
            $waliKelasList = DB::table('kelas')->join('pegawai', 'kelas.nip_wali_kelas', '=', 'pegawai.nip_wali_kelas')->select('pegawai.*', 'pegawai.nip_wali_kelas')->get();
            $konsentrasiList = Kelas::with('konsentrasi')->get();
        } else if (strlen($katakunci)) {
            $kelasList = Kelas::where('kelas_id', 'like', "%$katakunci%")
                ->orWhere('kelas', 'like', "%$katakunci%")
                ->orWhere('angkatan', 'like', "%$katakunci%")
                ->orWhere('nip_wali_kelas', 'like', "%$katakunci%")
                ->orWhere('id_kk', 'like', "%$katakunci%")
                ->paginate(3);
            $waliKelasList = DB::table('kelas')->join('pegawai', 'kelas.nip_wali_kelas', '=', 'pegawai.nip_wali_kelas')->select('pegawai.*', 'pegawai.nip_wali_kelas')->get();
            $konsentrasiList = Kelas::with('konsentrasi')->get();
        } else {
            $kelasList = Kelas::paginate(3);
            $waliKelasList = DB::table('kelas')->join('pegawai', 'kelas.nip_wali_kelas', '=', 'pegawai.nip_wali_kelas')->select('pegawai.*', 'pegawai.nip_wali_kelas')->get();
            $konsentrasiList = DB::table('kelas')->join('konsentrasi_keahlian', 'kelas.id_kk', '=', 'konsentrasi_keahlian.id_kk')->select('konsentrasi_keahlian.*', 'konsentrasi_keahlian.id_kk', 'konsentrasi_keahlian.konsentrasi_keahlian')->get();
        }

        return view('/manajemen_siswa.kelas.kelas_data', [
            'title' => 'Kelas',
            'active' => 'kelas',
            'active1' => 'siswa',
            'dataList' => $kelasList,
            'waliKelasList' => $waliKelasList,
            'konsentrasiList' => $konsentrasiList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $waliKelasList = DB::table('kelas')->rightJoin('pegawai', 'kelas.nip_wali_kelas', '=', 'pegawai.nip_wali_kelas')->select('pegawai.*', 'pegawai.nama_wali_kelas', 'pegawai.nip_wali_kelas')->get();
        $konsentrasiList = DB::table('kelas')->rightJoin('konsentrasi_keahlian', 'kelas.id_kk', '=', 'konsentrasi_keahlian.id_kk')->select('konsentrasi_keahlian.*', 'konsentrasi_keahlian.id_kk', 'konsentrasi_keahlian.konsentrasi_keahlian')->get();

        return view('/manajemen_siswa.kelas.kelas_create', [
            'title' => 'Kelas',
            'active' => 'kelas',
            'active1' => 'siswa',
            'waliKelasList' => $waliKelasList,
            'konsentrasiList' => $konsentrasiList,
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
            'kelas_id' => 'required|max:16|min:8|unique:kelas',
            'kelas' => 'required|min:3|max:100|unique:kelas',
            'angkatan' => 'required|min:4|max:4',
            'nip_wali_kelas' => 'numeric|unique:kelas',
            'id_kk' => 'required',
            'foto' => 'image|file|max:1024',
        ]);

        if ($request->file('foto')) {
            $validateData['foto'] = $request->file('foto')->store('foto-kelas');
        }

        Kelas::create($validateData);

        Alert::success('Success', 'Berhasil Menambah Data Kelas !!');
        return redirect('/kelas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailData = Kelas::where('kelas_id', $id)->get();
        $waliKelasList = DB::table('kelas')->rightJoin('pegawai', 'kelas.nip_wali_kelas', '=', 'pegawai.nip_wali_kelas')->select('pegawai.*', 'pegawai.nama_wali_kelas', 'pegawai.nip_wali_kelas')->get();
        $konsentrasiList = DB::table('kelas')->join('konsentrasi_keahlian', 'kelas.id_kk', '=', 'konsentrasi_keahlian.id_kk')->select('konsentrasi_keahlian.*', 'konsentrasi_keahlian.id_kk', 'konsentrasi_keahlian.konsentrasi_keahlian')->get();

        return view('/manajemen_siswa.kelas.kelas_detail', [
            'title' => 'Detail',
            'active' => 'kelas',
            'active1' => 'siswa',
            'detailData' => $detailData,
            'waliKelasList' => $waliKelasList,
            'konsentrasiList' => $konsentrasiList,

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
        $kelasList = Kelas::where('kelas_id', $id)->get();
        $kelasListAll = Kelas::all();
        $waliKelasList = DB::table('kelas')->rightJoin('pegawai', 'kelas.nip_wali_kelas', '=', 'pegawai.nip_wali_kelas')->select('pegawai.*', 'pegawai.nama_wali_kelas', 'pegawai.nip_wali_kelas')->get();
        $konsentrasiList = DB::table('kelas')->rightJoin('konsentrasi_keahlian', 'kelas.id_kk', '=', 'konsentrasi_keahlian.id_kk')->select('konsentrasi_keahlian.*', 'konsentrasi_keahlian.id_kk', 'konsentrasi_keahlian.konsentrasi_keahlian')->get();

        return view('manajemen_siswa.kelas.kelas_edit', [
            'title' => 'Edit',
            'active' => 'kelas',
            'active1' => 'siswa',
            'editData' => $kelasList,
            'kelasAll' => $kelasListAll,
            'waliKelasList' => $waliKelasList,
            'konsentrasiList' => $konsentrasiList,
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
            'kelas_id' => 'required|max:16|min:8|unique:kelas,kelas_id,' . $id . ',kelas_id',
            'kelas' => 'required|max:100|min:3|unique:kelas,kelas,' . $id . ',kelas_id',
            'angkatan' => 'required|min:4|max:4',
            'nip_wali_kelas' => 'numeric|unique:kelas,nip_wali_kelas,' . $id . ',kelas_id',
            'id_kk' => 'required',
            'foto' => 'image|file|max:1024',
        ]);

        if ($request->file('foto')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['foto'] = $request->file('foto')->store('foto-kelas');
        }

        Kelas::where('kelas_id', $id)->update($validateData);
        Alert::success('Success', 'Berhasil Mengubah Data Kelas !!');
        return redirect('/kelas');
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
        // $deleteStudent = DB::table('users')->where('id', $id)->delete();
        // User::destroy($user->id);]
        Kelas::where('kelas_id', $id)->delete();
        Alert::success('Success', 'Berhasil Menghapus Data kelas !!');
        return redirect('/kelas');
    }
}
