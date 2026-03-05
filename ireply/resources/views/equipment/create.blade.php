@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="fw-bold mb-0"><i class="bi bi-cpu me-2 text-primary"></i>Add New Equipment</h4>
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

                    <form method="POST" action="{{ route('equipment.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold small text-uppercase text-muted">Equipment Name</label>
                            <input type="text" class="form-control border-0 bg-light @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ old('name') }}" placeholder="e.g. MacBook Pro M3" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="type" class="form-label fw-bold small text-uppercase text-muted">Category / Type</label>
                            <select class="form-select border-0 bg-light @error('type') is-invalid @enderror" id="type" name="type" required>
                                <option value="" disabled selected>Select Category</option>
                                <optgroup label="Computing">
                                    <option value="Laptop" {{ old('type') == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                                    <option value="Desktop" {{ old('type') == 'Desktop' ? 'selected' : '' }}>Desktop</option>
                                    <option value="Tablet" {{ old('type') == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                                </optgroup>
                                <optgroup label="Peripherals">
                                    <option value="Mouse" {{ old('type') == 'Mouse' ? 'selected' : '' }}>Mouse</option>
                                    <option value="Keyboard" {{ old('type') == 'Keyboard' ? 'selected' : '' }}>Keyboard</option>
                                    <option value="Monitor" {{ old('type') == 'Monitor' ? 'selected' : '' }}>Monitor</option>
                                    <option value="Headset" {{ old('type') == 'Headset' ? 'selected' : '' }}>Headset</option>
                                    <option value="Webcam" {{ old('type') == 'Webcam' ? 'selected' : '' }}>Webcam</option>
                                </optgroup>
                                <optgroup label="Others">
                                    <option value="Printer" {{ old('type') == 'Printer' ? 'selected' : '' }}>Printer</option>
                                    <option value="Cables" {{ old('type') == 'Cables' ? 'selected' : '' }}>Cables / Adapters</option>
                                    <option value="Other" {{ old('type') == 'Other' ? 'selected' : '' }}>Other</option>
                                </optgroup>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold small text-uppercase text-muted">Description (Optional)</label>
                            <textarea class="form-control border-0 bg-light @error('description') is-invalid @enderror" 
                                id="description" name="description" rows="3" placeholder="Enter specifications, serial numbers, etc.">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2 pt-2">
                            <button type="submit" class="btn btn-primary px-4 rounded-pill">Add Equipment</button>
                            <a href="{{ route('equipment.index') }}" class="btn btn-light px-4 rounded-pill">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
