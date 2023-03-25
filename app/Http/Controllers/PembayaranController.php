<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['jumlah_dibayar'] =
            currencyIDRToNumeric($request->jumlah_dibayar);

        $validateData = $request->validate([
            'tagihan_id' => 'required',
            'jumlah_dibayar' => 'required',
            'tanggal_bayar' => 'required|date',
            'bukti_bayar' => 'image|file|max:1024',
            'user_id' => 'required',
        ]);

        $validateData['status_konfirmasi'] = 'sudah';
        if ($request->file('bukti_bayar')) {
            $validateData['bukti_bayar'] = $request->file('bukti_bayar')->store('bukti-pembayaran');
        }

        $tagihan = Tagihan::findOrFail($validateData['tagihan_id']);
        if ($validateData['jumlah_dibayar'] >= $tagihan->tagihanDetails->sum('nominal_biaya')) {
            $tagihan->status = 'lunas';
        } else {
            $tagihan->status = 'angsur';
        }
        $tagihan->save();
        Pembayaran::create($validateData);
        Alert::success('Success', 'Berhasil Menambah Data Pembayaran !!');
        return back();
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
