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

        // Request Status Distribution
        $statusStats = \App\Models\Request::select('status', \Illuminate\Support\Facades\DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // 7-Day Request Trends
        $trendsData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $count = \App\Models\Request::whereDate('created_at', $date)->count();
            $trendsData[$date] = $count;
        }

        $recentRequests = \App\Models\Request::with(['employee', 'equipment'])->latest()->take(5)->get();
        
        return view('dashboard.index', compact('stats', 'recentRequests', 'statusStats', 'trendsData'));
    }
}
