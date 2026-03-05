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
        <h3>Recent Activity</h3>
        <p class="text-muted">Summary / Bird's eye view of current requests will be displayed here.</p>
    </div>
</div>
@endsection
