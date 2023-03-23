<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard', [
            'title' => 'Dashboard',
            'active' => 'Dashboard',
            'active1' => 'Dashboard',
        ]);
    }
}
