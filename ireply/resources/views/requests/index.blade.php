@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Requests</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('requests.create') }}" class="btn btn-primary mb-3">New Request</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Equipment</th>
                <th>Status</th>
                <th>Reason</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $request)
                <tr>
                    <td>{{ $request->employee->name ?? '-' }}</td>
                    <td>{{ $request->equipment->name ?? '-' }}</td>
                    <td>{{ ucfirst($request->status) }}</td>
                    <td>{{ $request->reason }}</td>
                    <td>
                        @if($request->status === 'pending')
                            <form action="{{ route('requests.approve', $request->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>
                            <form action="{{ route('requests.reject', $request->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        @else
                            <span class="text-muted">No actions</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No requests found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
