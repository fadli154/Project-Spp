<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\TagihanDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $this->authorize('entri-pembayaran');

        $katakunci = $request->katakunci;
        $jenis_kelamin = $request->jk;
        $status = $request->status;

        if (strlen($jenis_kelamin) || strlen($status)) {
            $siswaList = Siswa::when(!is_null($jenis_kelamin), function ($query) use ($jenis_kelamin) {
                return $query->where('jk', $jenis_kelamin);
            })->when(!is_null($status), function ($query) use ($status) {
                return $query->where('status', $status);
            })->latest()->paginate(8);
            $waliList = Siswa::with('user')->get();
            $kelasList = Siswa::with('kelas')->get();
        } else if (strlen($katakunci)) {
            $siswaList = Siswa::with('kelas')->where('nisn', 'like', "%$katakunci%")
                ->orWhere('nik', 'like', "%$katakunci%")
                ->orWhere('nama', 'like', "%$katakunci%")
                ->orWhere('kelas_id', 'like', "%$katakunci%")
                ->orWhere('jk', 'like', "%$katakunci%")
                ->orWhere('tempat_lahir', 'like', "%$katakunci%")
                ->paginate(6);
            $waliList = Siswa::with('user')->get();
            $kelasList = Siswa::with('kelas')->get();
        } else {
            $siswaList = siswa::paginate(6);
            $waliList = Siswa::with('user')->get();
            $kelasList = Siswa::with('kelas')->get();
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
        $this->authorize('administrator');

        $waliList = user::where('level', 'wali')->get();
        // dd($waliList[16]->siswa[0]->wali_id);
        $kelasList = Kelas::with('siswa')->groupBy('kelas_id')->get();
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
        $this->authorize('administrator');

        $validateData = $request->validate([
            'nisn' => 'required|max:11|min:10|unique:siswa',
            'nik' => 'required|max:17|min:16|unique:siswa',
            'wali_id' => '',
            'nama' => 'required|max:60',
            'jk' => 'required',
            'status' => 'required',
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
        if (auth()->check()) {
            $detailData = siswa::where('nisn', $id)->get();
            $waliList = User::with('siswa')->get();
            $kelasList = Kelas::with('siswa', 'WaliKelas')->get();
            $tagihan =  Tagihan::where('nisn', $id)->get();
            $tagihanDetails = TagihanDetails::get();
            $pembayaran = Pembayaran::get();

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
                'showTab' => 'profile',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('administrator');

        $dataList = siswa::where('nisn', $id)->get();
        $kelasList = Kelas::get();

        return view('/manajemen_siswa.siswa_edit', [
            'title' => 'edit',
            'active' => 'siswa',
            'active1' => 'siswa',
            'editData' => $dataList,
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
        $this->authorize('administrator');

        $validateData = $request->validate([
            'nisn' => 'required|max:10|min:10|unique:siswa,nisn,' . $id . ',nisn',
            'nik' => 'required|max:16|min:16|unique:siswa,nik,' . $id . ',nisn',
            'nama' => 'required|max:60',
            'wali_id' => '',
            'jk' => 'required',
            'status' => 'required',
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
    public function destroy($id, Request $request)
    {
        $this->authorize('administrator');

        if ($request->oldImage) {
            Storage::delete($request->oldImage);
        }

        Siswa::where('nisn', $id)->delete();
        Alert::success('Success', 'Berhasil Menghapus Data Siswa !!');
        return redirect('/siswa');
    }

    public function getScoutKey(siswa $siswa)
    {
        return $siswa->nisn;
    }
}
