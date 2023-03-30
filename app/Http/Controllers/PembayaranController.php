<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\User;
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
                ->latest()->paginate(3);
        } else {
            $pembayaranList = Pembayaran::with('tagihan')->latest()->paginate(6);
            $tagihanList = Tagihan::with('siswa')->groupBy('nisn')->get();
            $kelasList = Kelas::get();
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
        $siswaList = Siswa::with('tagihan')->get();

        return view('/pembayaran.pembayaran.pembayaran_create', [
            'title' => 'Tambah Data',
            'active' => 'transaksi-pembayaran',
            'active1' => 'pembayaran',
            'siswaList' => $siswaList
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
        if ($request['nisn'] != null) {
            $tagihan = Tagihan::where('nisn', $request['nisn'])->get();
            $request['tagihan_id'] =  $tagihan[0]->id;
        }

        $request['jumlah_dibayar'] =
            currencyIDRToNumeric($request->jumlah_dibayar);

        if ($request['tagihan_id'] == null) {
            Alert::error('error', 'Belum ada Tagihan !!');
            return back();
        }

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
        if ($tagihan->status == "lunas") {
            Alert::error('error', 'Tagihan Sudah Lunas !!');
            return back();
        } elseif ($tagihan->status == "angsur" || $tagihan->status == "baru") {
            if ($tagihan->sisa_tagihan <= 0 || $tagihan->sisa_tagihan <= intval($validateData['jumlah_dibayar'])) {
                Tagihan::where('id', $validateData['tagihan_id'])->update(array('status' => 'lunas', 'sisa_tagihan' => 0));
            } else {
                Tagihan::where('id', $validateData['tagihan_id'])->update(array('status' => 'angsur', 'sisa_tagihan' => $tagihan->sisa_tagihan - intval($validateData['jumlah_dibayar'])));
            }
        }

        Pembayaran::create($validateData);

        Alert::success('Success', 'Berhasil Menambah Data Pembayaran !!');
        return redirect('/pembayaran');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailData = Pembayaran::where('id', $id)->get();
        $userList = User::get();

        return view('/pembayaran.pembayaran.pembayaran_detail', [
            'title' => 'Detail',
            'active' => 'pembayaran',
            'active1' => 'pembayaran',
            'detailData' => $detailData,
            'userList' => $userList,
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
    public function destroy($id)
    {
        //
    }
}
