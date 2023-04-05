<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class WaliMuridController extends Controller
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
            $usersList = User::where('email', 'like', "%$katakunci%")
                ->orWhere('name', 'like', "%$katakunci%")
                ->orWhere('level', 'like', "%$katakunci%")
                ->orWhere('no_telp', 'like', "%$katakunci%")
                ->having('level', '=', 'wali')
                ->paginate(6);
        } else {
            $usersList = User::where('level', 'wali')->paginate(6);
        }

        return view('/admin.wali_murid.wali_murid_data', [
            'title' => 'Wali-Murid',
            'active' => 'wali-murid',
            'active1' => 'users',
            'users' => $usersList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/admin.wali_murid.wali_murid_create', [
            'title' => 'Tambah Data',
            'active' => 'wali-murid',
            'active1' => 'users',
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
            'name' => 'required|max:60|min:1',
            'username' => 'required|max:40|min:4|unique:users',
            'level' => 'required',
            'email' => 'required|email:dns|unique:users',
            'no_telp' => 'required|max:13|min:10',
            'password' => 'required|max:20|min:5',
            'foto' => 'image|file|max:1024',
        ]);

        if ($request->file('foto')) {
            $validateData['foto'] = $request->file('foto')->store('foto-wali');
        }

        $validateData['password'] = Hash::make($validateData['password']);

        User::create($validateData);

        Alert::success('Success', 'Berhasil Menambah Data Wali Murid!!');
        return redirect('/wali-murid');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa = User::find($id)->siswa()->get();
        $detailData = User::where('id', $id)->with('siswa')->get();

        // dd($siswaData[0]->siswa);

        return view('admin.wali_murid.wali_murid_detail', [
            'title' => 'Detail',
            'active' => 'wali-murid',
            'active1' => 'users',
            'detailData' => $detailData,
            'siswaData' => $siswa,
            'allSiswa' => \App\Models\Siswa::whereNotIn('wali_id', [$id])->orWhere('wali_id', '=', null)->get(),
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
        $editData = User::where('id', $id)->get();

        return view('admin.wali_murid.wali_murid_edit', [
            'title' => 'Edit',
            'active' => 'wali-murid',
            'active1' => 'users',
            'editData' => $editData,
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
            'name' => 'required|max:60|min:1',
            'username' => 'required|max:40|min:4|unique:users,username,' . $id . ',id',
            'id' => 'unique:users,id,' . $id . ',id',
            'level' => 'required',
            'email' => 'required|email:dns|unique:users,email,' . $id . ',id',
            'no_telp' => 'required|max:13|min:10|unique:users,no_telp,' . $id . ',id',
            'foto' => 'image|file|max:1024',
        ]);

        if ($request->file('foto')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['foto'] = $request->file('foto')->store('foto-wali');
        }

        User::where('id', $id)->update($validateData);
        Alert::success('Success', 'Berhasil Edit Data Wali Murid !!');
        return redirect('/wali-murid');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     */
    public function destroy(Request $request, $id, User $user)
    {
        if ($request->oldImage) {
            Storage::delete($request->oldImage);
        }
        // $deleteStudent = DB::table('users')->where('id', $id)->delete();
        // User::destroy($user->id);
        User::where('id', $id)->delete();

        Alert::success('Success', 'Berhasil Menghapus Data Wali Murid!!');
        return redirect('/wali-murid');
    }
}
