@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h1>Admin Dashboard</h1>
        <p class="text-muted">System management and user oversight.</p>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card bg-dark text-white h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title">User Management</h5>
                        <p class="card-text">Manage user roles, permissions, and accounts.</p>
                        <div class="display-4">{{ $userCount }}</div>
                        <p class="mb-0">Total system users ({{ $adminCount }} admins)</p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.roles') }}" class="btn btn-outline-light">Manage Roles</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title">System Settings</h5>
                        <p class="card-text">Global configuration and application settings.</p>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check-circle text-success me-2"></i> Database: Connected</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i> Environment: {{ app()->environment() }}</li>
                            <li><i class="bi bi-clock text-primary me-2"></i> Timezone: {{ config('app.timezone') }}</li>
                        </ul>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-secondary" disabled>Settings (Coming Soon)</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Quick Actions</div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-3">
                    <a href="{{ route('employees.create') }}" class="btn btn-primary w-100 mb-2">Add Employee</a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('equipment.create') }}" class="btn btn-primary w-100 mb-2">Add Equipment</a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('requests.index') }}" class="btn btn-info text-white w-100 mb-2">Review Requests</a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('activity_logs.index') }}" class="btn btn-secondary w-100 mb-2">View System Logs</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
