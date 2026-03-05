@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center align-items-center min-vh-75">
    <div class="col-md-5 col-lg-4">
        <div class="card shadow-lg border-0">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-lock" viewBox="0 0 16 16">
                            <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m7 8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1v-1c0-2.813 3.414-5.118 6.812-5.71a1.5 1.5 0 0 1 1.39.043c.332.196.518.528.518.905zm-9-5c-1.113 0-2.22.176-3.227.514C1.725 11.073 1 11.825 1 12.574V14h5v-3H5zm7 1a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z"/>
                        </svg>
                    </div>
                    <h2 class="fw-bold">Welcome Back</h2>
                    <p class="text-muted">Enter your credentials to access the portal</p>
                </div>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control form-control-lg border-start-0 ps-0" placeholder="name@company.com" required autofocus>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" class="form-control form-control-lg border-start-0 ps-0" placeholder="••••••••" required>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg py-3">Sign In</button>
                    </div>
                </form>

                <div class="mt-4 text-center">
                    <p class="mb-0 text-muted">Don't have an account? <a href="{{ route('home') }}#register-section" class="text-primary fw-bold text-decoration-none">Register for Approval</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background: radial-gradient(circle at 10% 20%, rgb(239, 246, 249) 0%, rgb(206, 239, 253) 90%);
    }
    .min-vh-75 { min-height: 75vh; }
    .input-group-text { border-radius: 0.5rem 0 0 0.5rem; }
    .form-control-lg { border-radius: 0 0.5rem 0.5rem 0; font-size: 1rem; }
    .card { border-radius: 1.25rem; }
</style>
@endsection
