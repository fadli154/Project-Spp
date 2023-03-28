<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Http\Request;

class KwitansiPembayaranController extends Controller
{
    public function show($id)
    {
        $pemabayaranList = Pembayaran::with('tagihan')->where('id', $id)->get();
        $userList = User::get();
        // dd($pemabayaranList[0]);

        return view('/pembayaran.pembayaran.kwitansi_pembayaran', [
            'pembayaranList' => $pemabayaranList,
            'userList' => $userList,
            'title' => 'Kwitansi Pembayaran',
        ]);
    }
}
