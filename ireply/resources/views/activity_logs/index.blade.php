@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Activity Logs</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Employee</th>
                <th>Action</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
                <tr>
                    <td>{{ $log->created_at }}</td>
                    <td>{{ $log->employee->name ?? '-' }}</td>
                    <td>{{ $log->action }}</td>
                    <td>{{ $log->details }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No activity logs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
