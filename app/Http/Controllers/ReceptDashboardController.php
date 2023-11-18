<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceptDashboardController extends Controller
{
    public function dashboard()
    {
        return view('receptionist.dashboard');
    }
}
