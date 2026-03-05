@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>All Requests</h1>
        <a href="{{ route('requests.create') }}" class="btn btn-primary">New Request</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Employee</th>
                            <th>Equipment</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $request)
                            <tr>
                                <td>{{ $request->employee->name }}</td>
                                <td>{{ $request->equipment->name }} ({{ $request->equipment->type }})</td>
                                <td>{{ $request->reason ?? 'N/A' }}</td>
                                <td>
                                    @if($request->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($request->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @else
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>{{ $request->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    @if($request->status == 'pending')
                                        <div class="btn-group btn-group-sm">
                                            <form action="{{ route('requests.approve', $request->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Approve</button>
                                            </form>
                                            <form action="{{ route('requests.reject', $request->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Reject</button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">No requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
