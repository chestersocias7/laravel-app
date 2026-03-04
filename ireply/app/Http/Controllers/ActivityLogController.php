<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = \App\Models\ActivityLog::with('employee')->latest()->get();
        return view('activity_logs.index', compact('logs'));
    }
}
