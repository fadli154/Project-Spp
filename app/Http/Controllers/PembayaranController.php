<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PembayaranController extends Controller
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
            $pembayaranList = Pembayaran::where('nama_biaya', 'like', "%$katakunci%")
                ->orWhere('nominal', 'like', "%$katakunci%")
                ->paginate(3);
        } else {
            $pembayaranList = Pembayaran::with('tagihan')->paginate(6);
            $tagihanList = Tagihan::with('siswa', 'kelas')->get();
        }

        foreach ($tagihanList as $item) {
            $kelasList = $item->kelas;
        }

        return view('/pembayaran.pembayaran.pembayaran_data', [
            'title' => 'pembayaran',
            'active' => 'pembayaran',
            'active1' => 'pembayaran',
            'dataList' => $pembayaranList,
            'tagihanList' => $tagihanList,
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
        if (intval($validateData['jumlah_dibayar']) >= $tagihan->tagihanDetails->sum('nominal_biaya')) {
            Tagihan::where('id', $validateData['tagihan_id'])->update(array('status' => 'lunas'));
        } else {
            Tagihan::where('id', $validateData['tagihan_id'])->update(array('status' => 'angsur'));
        }

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
