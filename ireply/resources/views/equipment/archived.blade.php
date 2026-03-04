@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Archived Equipment</h1>
    <a href="{{ route('equipment.index') }}" class="btn btn-secondary mb-3">Back to Equipment List</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Description</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($equipment as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->type }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No archived equipment found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
