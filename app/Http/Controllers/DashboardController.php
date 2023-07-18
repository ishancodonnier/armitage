<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $pagetitle = 'Dashboard';
        return view('dashboard', compact('pagetitle'));
    }
}
