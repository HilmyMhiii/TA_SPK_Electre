<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        $data = [];
        return view('dashboard.index', $data);
    }
}
