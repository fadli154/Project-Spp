<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class loginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.login', [
            'title' => 'Login',
            'active' => 'Login',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticated(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (auth()->user()->level == 'administrator' || auth()->user()->level == 'petugas') {
                Alert::success('Success', 'Berhasil Login !!');
                return redirect()->intended('/dashboard');
            } elseif (auth()->user()->level == 'wali') {
                Alert::success('Success', 'Berhasil Login !!');
                return redirect()->intended('/dashboard');
            }
        }

        Alert::error('', 'Gagal Untuk Log in !!');
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
