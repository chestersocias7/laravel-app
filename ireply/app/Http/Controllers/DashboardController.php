<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // TODO: Fetch summary data for current requests
        return view('dashboard.index');
    }
}
