<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'employees' => \App\Models\Employee::count(),
            'equipment' => \App\Models\Equipment::count(),
            'requests' => \App\Models\Request::count(),
            'pending_requests' => \App\Models\Request::where('status', 'pending')->count(),
        ];
        return view('dashboard.index', compact('stats'));
    }
}
