@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="fw-bold mb-0"><i class="bi bi-plus-circle me-2 text-primary"></i>New Equipment Request</h4>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm mb-4">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($equipment->isEmpty())
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="bi bi-box-seam font-large text-muted" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="fw-bold">No Equipment Available</h5>
                            <p class="text-muted">There are currently no active equipment items available for request.</p>
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('equipment.create') }}" class="btn btn-primary mt-2">
                                    <i class="bi bi-plus-lg me-1"></i> Add New Equipment
                                </a>
                            @else
                                <p class="small text-info"><i class="bi bi-info-circle me-1"></i> Please contact your administrator to add new inventory.</p>
                            @endif
                            <div class="mt-4">
                                <a href="{{ route('requests.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Go Back</a>
                            </div>
                        </div>
                    @else
                        <form method="POST" action="{{ route('requests.store') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="employee_id" class="form-label fw-bold small text-uppercase text-muted">Requesting Employee</label>
                                <select class="form-select border-0 bg-light" id="employee_id" name="employee_id" required>
                                    <option value="">Select Employee</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ auth()->user()->id == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="equipment_id" class="form-label fw-bold small text-uppercase text-muted">Select Equipment</label>
                                <select class="form-select border-0 bg-light" id="equipment_id" name="equipment_id" required>
                                    <option value="">Select an Item</option>
                                    @foreach($equipment as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->type }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="reason" class="form-label fw-bold small text-uppercase text-muted">Reason for Request</label>
                                <textarea class="form-control border-0 bg-light" id="reason" name="reason" rows="4" placeholder="Briefly describe why you need this equipment..."></textarea>
                            </div>

                            <div class="d-flex gap-2 pt-2">
                                <button type="submit" class="btn btn-primary px-4 rounded-pill">Submit Request</button>
                                <a href="{{ route('requests.index') }}" class="btn btn-light px-4 rounded-pill">Cancel</a>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
