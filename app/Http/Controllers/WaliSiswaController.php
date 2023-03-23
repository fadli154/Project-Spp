<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class WaliSiswaController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validate([
            'wali_id' => 'required',
            'nisn' => 'required',
        ]);

        // $siswa = \App\Models\Siswa::where('nisn', $request['nisn']);
        // $siswa['wali_id'] = $request['wali_id'];
        Siswa::where('nisn', $request['nisn'])->update($validate);

        Alert::success('Success', 'Berhasil Menambah Data Anak!!');
        return back();
    }

    public function update(Request $request, $id)
    {
        Siswa::where('nisn', $id)->update(['wali_id' => null]);

        Alert::success('Success', 'Berhasil Menghapus Data Anak!!');
        return back();
    }
}
