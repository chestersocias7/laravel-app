@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="row justify-content-center align-items-center py-5">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg border-0">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                        </svg>
                    </div>
                    <h2 class="fw-bold">Create Account</h2>
                    <p class="text-muted">Sign up to start using the system</p>
                </div>

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name" class="form-control form-control-lg" placeholder="John Doe" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="email" name="email" class="form-control form-control-lg" placeholder="name@company.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Role Type</label>
                        <select name="role" class="form-select form-select-lg" required>
                            <option value="employee" selected>Employee</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="••••••••" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">Confirm</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="••••••••" required>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg py-3">Register for Approval</button>
                    </div>
                </form>

                <div class="mt-4 text-center">
                    <p class="mb-0 text-muted">Already have an account? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Sign In</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background: radial-gradient(circle at 10% 20%, rgb(239, 246, 249) 0%, rgb(206, 239, 253) 90%);
    }
    .form-control-lg, .form-select-lg { border-radius: 0.5rem; font-size: 1rem; }
    .card { border-radius: 1.25rem; }
</style>
@endsection
