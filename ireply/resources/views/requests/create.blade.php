@extends('layouts.app')

@section('content')
<div class="container">
    <h1>New Request</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('requests.store') }}">
        @csrf
        <div class="mb-3">
            <label for="employee_id" class="form-label">Employee</label>
            <select class="form-control" id="employee_id" name="employee_id" required>
                <option value="">Select Employee</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="equipment_id" class="form-label">Equipment</label>
            <select class="form-control" id="equipment_id" name="equipment_id" required>
                <option value="">Select Equipment</option>
                @foreach($equipment as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="reason" class="form-label">Reason</label>
            <textarea class="form-control" id="reason" name="reason"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Request</button>
        <a href="{{ route('requests.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
