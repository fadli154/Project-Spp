<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KonsentrasiKeahlian;
use RealRashid\SweetAlert\Facades\Alert;

class KonsentrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;

        if (strlen($request->tahun_program)) {
            $konsentrasiList = KonsentrasiKeahlian::where('tahun_program', '=', "$request->tahun_program")
                ->paginate(6);
        } else if (strlen($katakunci)) {
            $konsentrasiList = KonsentrasiKeahlian::where('id_kk', 'like', "%$katakunci%")
                ->orWhere('konsentrasi_keahlian', 'like', "%$katakunci%")
                ->orWhere('tahun_program', 'like', "%$katakunci%")
                ->paginate(6);
        } else {
            $konsentrasiList = KonsentrasiKeahlian::orderBy('tahun_program', 'asc')->paginate(6);
        }

        return view('/manajemen_siswa.konsentrasi_keahlian.konsentrasi_keahlian_data', [
            'title' => 'Konsentrasi Keahlian',
            'active' => 'konsentrasi-keahlian',
            'dataList' => $konsentrasiList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/manajemen_siswa.konsentrasi_keahlian.konsentrasi_keahlian_create', [
            'title' => 'Tambah Data',
            'active' => 'Tambah Data'
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
            'id_kk' => 'required|max:7|min:6|unique:konsentrasi_keahlian',
            'konsentrasi_keahlian' => 'required|max:100|min:3|unique:konsentrasi_keahlian',
            'tahun_program' => 'required',
        ]);

        if ($validateData) {
            KonsentrasiKeahlian::create($validateData);
            Alert::success('Success', 'Berhasil Menambah Data Konsentrasi Keahlian !!');
            return redirect('/konsentrasi-keahlian');
        } else {
            Alert::error('Error', 'Gagal Menambah Data Konsentrasi Keahlian !!');
            return redirect('/konsentrasi-keahlian');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailData = KonsentrasiKeahlian::where('id_kk', $id)->get();

        return view('/manajemen_siswa.konsentrasi_keahlian.konsentrasi_keahlian_detail', [
            'title' => 'Detail',
            'active' => 'Detail',
            'detailData' => $detailData,
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
        $dataList = KonsentrasiKeahlian::where('id_kk', $id)->get();

        return view('/manajemen_siswa.konsentrasi_keahlian.konsentrasi_keahlian_edit', [
            'title' => 'Edit',
            'active' => 'Edit',
            'dataList' => $dataList,
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
            'id_kk' => ['required', 'max:7', 'min:6', 'unique:konsentrasi_keahlian,id_kk,' . $id . ',id_kk'],
            'konsentrasi_keahlian' => 'required|max:100|min:3|unique:konsentrasi_keahlian,konsentrasi_keahlian,' . $id . ',id_kk',
            'tahun_program' => 'required',
        ]);

        if ($validateData) {
            KonsentrasiKeahlian::where('id_kk', $id)->update($validateData);

            Alert::success('Success', 'Berhasil Mengubah Data Konsentrasi Keahlian !!');
            return redirect('/konsentrasi-keahlian');
        } else {
            Alert::error('Error', 'Gagal Mengubah Data Konsentrasi Keahlian !!');
            return redirect('/konsentrasi-keahlian');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        KonsentrasiKeahlian::where('id_kk', $id)->delete();
        Alert::success('Success', 'Berhasil Menghapus Data Konsentrasi Keahlian !!');
        return redirect('/konsentrasi-keahlian');
    }
}
