@extends('layouts.app')

@section('title', 'Welcome to iReply')

@section('content')
<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
            <h1 class="display-3 fw-bold mb-4">Internal Inventory & <br><span class="text-primary">Employee Management</span></h1>
            <p class="lead mb-4">Streamline your equipment requests, track activity, and manage your team efficiently with the iReply internal portal.</p>
            <div class="d-flex gap-2">
                <a href="#register-section" class="btn btn-primary btn-lg px-4">Get Started</a>
                <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg px-4 text-dark">Employee Login</a>
            </div>
        </div>
        <div class="col-lg-5 offset-lg-1" id="register-section">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <h3 class="fw-bold mb-4 text-center">Create your account</h3>
                    <p class="text-muted text-center mb-4">Registration requested will be subject to admin approval.</p>
                    
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name" class="form-control form-control-lg" placeholder="John Doe" required>
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
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="••••••••" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="••••••••" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg py-3">Register for Approval</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background: radial-gradient(circle at 10% 20%, rgb(239, 246, 249) 0%, rgb(206, 239, 253) 90%);
    }
    .navbar {
        background: transparent !important;
        box-shadow: none !important;
    }
    .navbar-brand, .nav-link {
        color: #212529 !important;
    }
    .main-content {
        padding-top: 0 !important;
    }
</style>
@endsection
