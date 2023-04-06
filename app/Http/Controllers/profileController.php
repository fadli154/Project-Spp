<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class profileController extends Controller
{
    public function index()
    {
        $detailData = User::where('id', auth()->user()->id)->get();

        return view('/pages.profile', [
            'title' => 'Profile',
            'active' => 'Profile',
            'active1' => 'Profile',
            'detailData' => $detailData,
        ]);
    }

    public function changePassword()
    {
        $editData = User::where('id', auth()->user()->id)->get();

        return view('/pages.change_password', [
            'title' => 'Edit Password',
            'active' => 'change-password',
            'active1' => 'Password',
            'editData' => $editData,
        ]);
    }

    public function processChangePassword(Request $request)
    {
        if ($request->password_lama == null) {
            Alert::error('Gagal Mengubah Profile', 'Masukkan Password Lama Terlebih Dahulu !!');
            return back();
        }
        // cek password lama
        $cek = Hash::check($request->password_lama, auth()->user()->password);
        // kalau password tidak sama maka akan di kembalikan
        if (!$cek) {
            Alert::error('Gagal Mengubah Profile', 'Password Salah !!');
            return back();
        } else {
            // jika password lama sama dengan yg di database dan password_baru null/tidak ingin mengganti password
            if ($request->password_baru == null) {
                // cek validasi
                $validateData = $request->validate([
                    'name' => 'required|max:60|min:1',
                    'username' => 'required|max:40|min:4|unique:users,username,' . auth()->user()->id . ',id',
                    'email' => 'required|email:dns|unique:users,email,' . auth()->user()->id . ',id',
                    'no_telp' => 'required|max:13|min:10|unique:users,no_telp,' . auth()->user()->id . ',id',
                    'password' => 'max:20|min:5',
                    'foto' => 'image|file|max:1024',
                ]);

                // password masih sama dengan yg lama dan lakukan hashing
                $validateData['password'] = Hash::make($request->password_lama);

                if ($request->file('foto')) {
                    if ($request->oldImage) {
                        Storage::delete($request->oldImage);
                    }
                    $validateData['foto'] = $request->file('foto')->store('foto-' . auth()->user()->level);
                }

                User::where('id', auth()->user()->id)->update($validateData);
                Alert::success('Success', 'Berhasil Edit Profile !!');
                return redirect('/profile');
            } elseif ($request->password_baru != null) {
                // kalau password baru tidak sama dengan password yg di ulangi maka kembalikan
                if ($request->password_baru != $request->password_repeat) {
                    Alert::error('Gagal Mengubah Profile', 'Password Baru yg di ulang salah !!');
                    return back();
                } else {
                    // cek validasi
                    $validateData = $request->validate([
                        'name' => 'required|max:60|min:1',
                        'username' => 'required|max:40|min:4|unique:users,username,' . auth()->user()->id . ',id',
                        'email' => 'required|email:dns|unique:users,email,' . auth()->user()->id . ',id',
                        'no_telp' => 'required|max:13|min:10|unique:users,no_telp,' . auth()->user()->id . ',id',
                        'password' => 'max:20|min:5',
                        'foto' => 'image|file|max:1024',
                    ]);

                    // password diubah jadi baru dan lakukan hashing
                    $validateData['password'] = Hash::make($request->password_baru);

                    if ($request->file('foto')) {
                        if ($request->oldImage) {
                            Storage::delete($request->oldImage);
                        }
                        $validateData['foto'] = $request->file('foto')->store('foto-' . auth()->user()->level);
                    }

                    User::where('id', auth()->user()->id)->update($validateData);
                    Alert::success('Success', 'Berhasil Edit Profile dan Password !!');
                    return redirect('/profile');
                }
            }
        }
    }
}
