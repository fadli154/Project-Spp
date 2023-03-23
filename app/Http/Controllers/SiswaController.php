<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SiswaController extends Controller
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

        if (strlen($jenis_kelamin)) {
            $siswaList = Siswa::when(!is_null($jenis_kelamin), function ($query) use ($jenis_kelamin) {
                return $query->where('jk', $jenis_kelamin);
            })->latest()->paginate(8);
            $waliList = DB::table('siswa')->join('users', 'siswa.wali_id', '=', 'users.id')->select('users.*', 'users.name', 'users.id')->paginate(3);
            $kelasList = DB::table('siswa')->join('kelas', 'siswa.kelas_id', '=', 'kelas.kelas_id')->select('kelas.*', 'kelas.angkatan', 'kelas.kelas')->paginate(3);
        } else if (strlen($katakunci)) {
            $siswaList = Siswa::where('nisn', 'like', "%$katakunci%")
                ->orWhere('nik', 'like', "%$katakunci%")
                ->orWhere('nama', 'like', "%$katakunci%")
                ->orWhere('kelas_id', 'like', "%$katakunci%")
                ->orWhere('spp_id', 'like', "%$katakunci%")
                ->orWhere('jk', 'like', "%$katakunci%")
                ->orWhere('tempat_lahir', 'like', "%$katakunci%")
                ->paginate(3);
        } else {
            $siswaList = siswa::paginate(3);
            $waliList = DB::table('siswa')->join('users', 'siswa.wali_id', '=', 'users.id')->select('users.*', 'users.name', 'users.id')->paginate(3);
            $kelasList = DB::table('siswa')->join('kelas', 'siswa.kelas_id', '=', 'kelas.kelas_id')->select('kelas.*', 'kelas.angkatan', 'kelas.kelas')->paginate(3);
        }

        return view('/manajemen_siswa.siswa_data', [
            'title' => 'Siswa',
            'active' => 'siswa',
            'active1' => 'siswa',
            'dataList' => $siswaList,
            'waliList' => $waliList,
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
        $waliList = DB::table('siswa')->rightJoin('users', 'siswa.wali_id', '=', 'users.id')->select('users.*', 'users.name', 'users.id')->where('users.id', '!=', 'NULL')->get();
        $kelasList = DB::table('siswa')->rightJoin('kelas', 'siswa.kelas_id', '=', 'kelas.kelas_id')->select('kelas.*', 'kelas.angkatan', 'kelas.kelas')->get();
        // $sppList = DB::table('siswa')->rightJoin('spp', 'siswa.spp_id', '=', 'spp.spp_id')->select('spp.*', 'spp.tahun', 'spp.nominal')->get();
        return view('/manajemen_siswa.siswa_create', [
            'title' => 'Tambah Data',
            'active' => 'siswa',
            'active1' => 'siswa',
            'waliList' => $waliList,
            // 'sppList' => $sppList,
            'kelasList' => $kelasList
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
            'nisn' => 'required|max:11|min:10|unique:siswa',
            'nik' => 'required|max:17|min:16|unique:siswa',
            'wali_id' => '',
            'nama' => 'required|max:60',
            'jk' => 'required',
            'tempat_lahir' => 'required|max:60',
            'kelas_id' => 'required',
            // 'spp_id' => 'required',
            'foto' => 'image|file|max:1024',
        ]);

        if ($request->file('foto')) {
            $validateData['foto'] = $request->file('foto')->store('foto-siswa');
        }

        siswa::create($validateData);

        Alert::success('Success', 'Berhasil Menambah Data Siswa !!');
        return redirect('/siswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailData = siswa::where('nisn', $id)->get();
        $waliList = DB::table('siswa')->rightJoin('users', 'siswa.wali_id', '=', 'users.id')->select('users.*', 'users.name', 'users.id')->where('users.id', '!=', 'NULL')->get();
        $kelasList = DB::table('siswa')->rightJoin('kelas', 'siswa.kelas_id', '=', 'kelas.kelas_id')->select('kelas.*', 'kelas.angkatan', 'kelas.kelas')->get();
        // $sppList = DB::table('siswa')->rightJoin('spp', 'siswa.spp_id', '=', 'spp.spp_id')->select('spp.*', 'spp.tahun', 'spp.nominal')->get();
        $siswa = DB::table('siswa')
            ->join('kelas', 'siswa.kelas_id', '=', 'kelas.kelas_id')
            ->join('pegawai', 'pegawai.nip_wali_kelas', '=', 'kelas.nip_wali_kelas')
            ->select('kelas.*', 'kelas.kelas_id', 'kelas.nip_wali_kelas')
            ->select('pegawai.*', 'pegawai.nip_wali_kelas')
            ->get();

        return view('/manajemen_siswa.siswa_detail', [
            'title' => 'Detail',
            'active' => 'siswa',
            'active1' => 'siswa',
            'detailData' => $detailData,
            'waliList' => $waliList,
            'kelasList' => $kelasList,
            // 'sppList' => $sppList,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataList = siswa::where('nisn', $id)->get();
        $waliList = DB::table('siswa')->rightJoin('users', 'siswa.wali_id', '=', 'users.id')->select('users.*', 'users.name', 'users.id')->where('users.id', '!=', 'NULL')->get();
        $kelasList = DB::table('siswa')->rightJoin('kelas', 'siswa.kelas_id', '=', 'kelas.kelas_id')->select('kelas.*', 'kelas.angkatan', 'kelas.kelas', 'kelas.kelas_id')->get();
        $siswa = DB::table('siswa')
            ->join('kelas', 'siswa.kelas_id', '=', 'kelas.kelas_id')
            ->join('wali_kelas', 'wali_kelas.nip_wali_kelas', '=', 'kelas.nip_wali_kelas')
            ->select('kelas.*', 'kelas.kelas_id', 'kelas.nip_wali_kelas')
            ->select('wali_kelas.*', 'wali_kelas.nip_wali_kelas')
            ->get();

        return view('/data_peserta.siswa.edit', [
            'title' => 'edit',
            'active' => 'siswa',
            'active1' => 'siswa',
            'dataList' => $dataList,
            'waliList' => $waliList,
            'kelasList' => $kelasList,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'nisn' => 'required|max:10|min:10|unique:siswa,nisn,' . $id . ',nisn',
            'nik' => 'required|max:16|min:16|unique:siswa,nik,' . $id . ',nisn',
            'nama' => 'required|max:60',
            'wali_id' => '',
            'jk' => 'required',
            'tempat_lahir' => 'required|max:60',
            'kelas_id' => 'required',
            'foto' => 'image|file|max:1024',
        ]);

        if ($request->file('foto')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['foto'] = $request->file('foto')->store('foto-siswa');
        }

        siswa::where('nisn', $id)->update($validateData);
        Alert::success('Success', 'Berhasil Mengubah Data siswa !!');
        return redirect('/siswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(siswa $siswa)
    {
        //
    }

    public function getScoutKey(siswa $siswa)
    {
        return $siswa->nisn;
    }
}
