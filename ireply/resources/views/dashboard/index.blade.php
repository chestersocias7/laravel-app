@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>
    
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Employees</h5>
                    <p class="card-text h2">{{ $stats['employees'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Equipment</h5>
                    <p class="card-text h2">{{ $stats['equipment'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Requests</h5>
                    <p class="card-text h2">{{ $stats['requests'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pending</h5>
                    <p class="card-text h2">{{ $stats['pending_requests'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <h3>Recent Requests</h3>
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Employee</th>
                                <th>Equipment</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentRequests as $request)
                                <tr>
                                    <td>{{ $request->employee->name }}</td>
                                    <td>{{ $request->equipment->name }}</td>
                                    <td>
                                        @if($request->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($request->status == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @else
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>{{ $request->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">No recent requests.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($recentRequests->count() > 0)
                <div class="card-footer text-center">
                    <a href="{{ route('requests.index') }}" class="btn btn-sm btn-link">View All Requests</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
