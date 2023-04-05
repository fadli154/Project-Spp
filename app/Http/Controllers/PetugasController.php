<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class PetugasController extends Controller
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
                ->having('level', '=', 'petugas')
                ->paginate(6);
        } else {
            $usersList = User::where('level', 'petugas')->paginate(6);
        }

        return view('/admin.petugas.petugas_data', [
            'title' => 'Petugas',
            'active' => 'Petugas',
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
        return view('/admin.petugas.petugas_create', [
            'title' => 'Tambah Data',
            'active' => 'Petugas',
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
            $validateData['foto'] = $request->file('foto')->store('foto-petugas');
        }

        $validateData['password'] = Hash::make($validateData['password']);

        User::create($validateData);

        Alert::success('Success', 'Berhasil Menambah Data Petugas !!');
        return redirect('/petugas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailData = User::where('id', $id)->get();

        return view('admin.petugas.petugas_detail', [
            'title' => 'Detail',
            'active' => 'Petugas',
            'active1' => 'users',
            'detailData' => $detailData,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = User::where('id', $id)->get();

        return view('admin.petugas.petugas_edit', [
            'title' => 'edit',
            'active' => 'Petugas',
            'active1' => 'users',
            'editData' => $editData,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required|max:60|min:1',
            'username' => 'required|max:40|min:4|unique:users,username,' . $id . ',id',
            'level' => 'required',
            'email' => 'required|email:dns|unique:users,email,' . $id . ',id',
            'no_telp' => 'required|max:13|min:10|unique:users,no_telp,' . $id . ',id',
            'foto' => 'image|file|max:1024',
        ]);

        if ($request->file('foto')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['foto'] = $request->file('foto')->store('foto-petugas');
        }

        User::where('id', $id)->update($validateData);
        Alert::success('Success', 'Berhasil Edit Data Petugas !!');
        return redirect('/petugas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->oldImage) {
            Storage::delete($request->oldImage);
        }
        // $deleteStudent = DB::table('users')->where('id', $id)->delete();
        // User::destroy($user->id);
        User::where('id', $id)->delete();
        Alert::success('Success', 'Berhasil Menghapus Data Petugas !!');
        return redirect('/petugas');
    }
}
