@extends('layouts.app')

@section('content')
<div class="py-2">
    <div class="d-flex justify-content-between align-items-center mb-4 px-2">
        <h2 class="fw-bold mb-0">System Dashboard</h2>
        <div class="text-muted small">Overview of system transactions and metrics</div>
    </div>
    
    <!-- Stat Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #0d6efd !important;">
                <div class="card-body">
                    <div class="text-muted small fw-bold text-uppercase mb-1">Total Employees</div>
                    <div class="h3 fw-bold mb-0">{{ $stats['employees'] }}</div>
                    <div class="mt-2 small text-primary"><i class="bi bi-people-fill me-1"></i> Registered Users</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #198754 !important;">
                <div class="card-body">
                    <div class="text-muted small fw-bold text-uppercase mb-1">Active Equipment</div>
                    <div class="h3 fw-bold mb-0">{{ $stats['equipment'] }}</div>
                    <div class="mt-2 small text-success"><i class="bi bi-cpu-fill me-1"></i> Assets Managed</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #0dcaf0 !important;">
                <div class="card-body">
                    <div class="text-muted small fw-bold text-uppercase mb-1">Total Transactions</div>
                    <div class="h3 fw-bold mb-0">{{ $stats['requests'] }}</div>
                    <div class="mt-2 small text-info"><i class="bi bi-arrow-left-right me-1"></i> Lifetime Requests</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #ffc107 !important;">
                <div class="card-body">
                    <div class="text-muted small fw-bold text-uppercase mb-1">Pending Actions</div>
                    <div class="h3 fw-bold mb-0">{{ $stats['pending_requests'] }}</div>
                    <div class="mt-2 small text-warning"><i class="bi bi-exclamation-circle-fill me-1"></i> Awaiting Review</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row g-3 mb-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-3 pb-0">
                    <h6 class="fw-bold mb-0">Request Trends (Last 7 Days)</h6>
                </div>
                <div class="card-body" style="position: relative; height: 220px;">
                    <canvas id="trendsChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-3 pb-0">
                    <h6 class="fw-bold mb-0">Request Distribution</h6>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center" style="position: relative; height: 220px;">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Table -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
            <h6 class="fw-bold mb-0">Recent System Transactions</h6>
            <a href="{{ route('requests.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">View All</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 border-0">Employee</th>
                            <th class="border-0">Equipment</th>
                            <th class="border-0">Status</th>
                            <th class="border-0">Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentRequests as $request)
                            <tr>
                                <td class="ps-4 border-0">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3 d-none d-sm-block">
                                            <i class="bi bi-person"></i>
                                        </div>
                                        <div>{{ $request->employee->name ?? 'Deleted User' }}</div>
                                    </div>
                                </td>
                                <td class="border-0">{{ $request->equipment->name ?? 'Unknown' }}</td>
                                <td class="border-0">
                                    @if($request->status == 'pending')
                                        <span class="badge rounded-pill bg-warning text-dark px-3 mt-1">Pending</span>
                                    @elseif($request->status == 'approved')
                                        <span class="badge rounded-pill bg-success px-3 mt-1">Approved</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger px-3 mt-1">Rejected</span>
                                    @endif
                                </td>
                                <td class="border-0 text-muted small">{{ $request->created_at->format('M d, Y h:i A') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">No transactions registered.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js and Data Setup -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Trends Chart
        const trendsCtx = document.getElementById('trendsChart').getContext('2d');
        const trendsData = @json($trendsData) || {};
        
        if (Object.keys(trendsData).length > 0) {
            new Chart(trendsCtx, {
                type: 'line',
                data: {
                    labels: Object.keys(trendsData),
                    datasets: [{
                        label: 'Daily Requests',
                        data: Object.values(trendsData),
                        borderColor: '#0d6efd',
                        backgroundColor: 'rgba(13, 110, 253, 0.1)',
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#0d6efd',
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1, precision: 0 }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });
        }

        // Status Distribution Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const statusData = @json($statusStats) || {};
        
        if (Object.keys(statusData).length > 0) {
            new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(statusData).map(k => k.charAt(0).toUpperCase() + k.slice(1)),
                    datasets: [{
                        data: Object.values(statusData),
                        backgroundColor: [
                            '#ffc107', // pending
                            '#198754', // approved
                            '#dc3545'  // rejected
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { usePointStyle: true, padding: 20 }
                        }
                    },
                    cutout: '70%'
                }
            });
        }
    });
</script>
@endsection
