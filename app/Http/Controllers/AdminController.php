<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
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
                ->having('level', '=', 'administrator')
                ->paginate(6);
        } else {
            $usersList = User::where('level', 'administrator')->paginate(6);
        }

        return view('/admin.admin_data', [
            'title' => 'Admin',
            'active' => 'administrator',
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
        return view('/admin.admin_create', [
            'title' => 'Tambah Data',
            'active' => 'administrator',
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
            $validateData['foto'] = $request->file('foto')->store('foto-administrator');
        }

        $validateData['password'] = Hash::make($validateData['password']);

        User::create($validateData);

        Alert::success('Success', 'Berhasil Menambah Data Administrator !!');
        return redirect('/administrator');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailData = User::where('id', $id)->get();

        return view('admin.admin_detail', [
            'title' => 'Detail',
            'active' => 'administrator',
            'active1' => 'users',
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
        $editData = User::where('id', $id)->get();

        return view('admin.admin_edit', [
            'title' => 'edit',
            'active' => 'administrator',
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
            'username' => 'required|max:40|min:4',
            'level' => 'required',
            'email' => 'required|email:dns',
            'no_telp' => 'required|max:13|min:10',
            'foto' => 'image|file|max:1024',
        ]);

        if ($request->file('foto')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['foto'] = $request->file('foto')->store('foto-administrator');
        }

        User::where('id', $id)->update($validateData);
        Alert::success('Success', 'Berhasil Edit Data Administrator !!');
        return redirect('/administrator');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if ($request->oldImage) {
            Storage::delete($request->oldImage);
        }
        // $deleteStudent = DB::table('users')->where('id', $id)->delete();
        // User::destroy($user->id);
        User::where('id', $id)->delete();
        Alert::success('Success', 'Berhasil Menghapus Data administrator !!');
        return redirect('/administrator');
    }
}
