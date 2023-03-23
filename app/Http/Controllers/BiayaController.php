<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BiayaController extends Controller
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
            $sppList = Biaya::where('nama_biaya', 'like', "%$katakunci%")
                ->orWhere('nominal', 'like', "%$katakunci%")
                ->paginate(3);
        } else {
            $sppList = Biaya::with('user')->paginate(6);
        }


        return view('/pembayaran.biaya.biaya_data', [
            'title' => 'SPP',
            'active' => 'biaya',
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
        return view('/pembayaran.biaya.biaya_create', [
            'title' => 'Tambah Data',
            'active' => 'biaya',
            'active1' => 'pembayaran',
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
        $request['nominal'] =
            currencyIDRToNumeric($request->nominal);

        $validateData = $request->validate([
            'nama_biaya' => 'required|max:20|min:3|unique:biaya',
            'nominal' => 'required',
            'user_id' => '',
        ]);

        if ($validateData) {
            Biaya::create($validateData);
            Alert::success('Success', 'Berhasil Menambah Data Biaya !!');
            return redirect('/biaya');
        } else {
            Alert::error('Error', 'Gagal Menambah Data Biaya !!');
            return redirect('/biaya');
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
        $detailData = Biaya::where('id', $id)->with('user')->get();

        return view('/pembayaran.biaya.biaya_detail', [
            'title' => 'Detail',
            'active' => 'biaya',
            'active1' => 'pembayaran',
            'detailData' => $detailData,
            'detail_data' => $detailData,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SPP  $sPP
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sppList = Biaya::where('id', $id)->get();

        return view('/pembayaran.biaya.biaya_edit', [
            'title' => 'Edit',
            'active' => 'biaya',
            'active1' => 'pembayaran',
            'editData' => $sppList,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SPP  $sPP
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request['nominal'] =
            currencyIDRToNumeric($request->nominal);

        $validateData = $request->validate([
            'nama_biaya' => ['required', 'max:20', 'min:3', 'unique:biaya,nama_biaya,' . $id . ',id'],
            'nominal' => 'required|numeric',
            'user_id' => 'required',
        ]);

        if ($validateData) {
            Biaya::where('id', $id)->update($validateData);

            Alert::success('Success', 'Berhasil Mengubah Data Biaya !!');
            return redirect('/biaya');
        } else {
            Alert::error('Error', 'Gagal Mengubah Data Biaya !!');
            return redirect('/biaya');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SPP  $sPP
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Biaya::where('id', $id)->delete();
        Alert::success('Success', 'Berhasil Menghapus Data Biaya !!');
        return redirect('/biaya');
    }
}
