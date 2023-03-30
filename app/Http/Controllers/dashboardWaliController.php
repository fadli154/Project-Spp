<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class dashboardWaliController extends Controller
{
    public function index()
    {
        // Timezone
        $currentTime = Carbon::now();
        $hour = $currentTime->hour;

        if ($hour >= 5 && $hour <= 12) {
            $greeting = 'Selamat Pagi';
        } elseif ($hour >= 13 && $hour <= 17) {
            $greeting = 'Selamat Sore';
        } else {
            $greeting = 'Selamat Malam';
        }

        return view('wali-murid.dashboard', [
            'title' => 'Dashboard',
            'active' => 'Dashboard',
            'active1' => 'Dashboard',
            'greeting' => $greeting,
        ]);
    }
}
