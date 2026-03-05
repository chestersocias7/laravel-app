<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'iReply App')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <style>
        html { box-sizing: border-box; }
        *, *:before, *:after { box-sizing: inherit; }
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', 'Roboto', 'Arial', sans-serif;
            background: #f4f6fa;
            color: #222;
        }
        .main-content { flex: 1 0 auto; }
        .sidebar {
            min-width: 220px;
            max-width: 220px;
            background: #212529;
            min-height: 100vh;
            border-right: 1px solid #dee2e6;
        }
        .sidebar .nav-link {
            color: #fff;
            border-radius: 4px;
            margin-bottom: 4px;
            transition: background 0.2s, color 0.2s;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: #0d6efd;
            color: #fff;
        }
        .footer {
            background: #212529;
            border-top: 1px solid #dee2e6;
            padding: 1rem 0;
            text-align: center;
            color: #fff;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            border: none;
            margin-bottom: 1.5rem;
        }
        .card-header {
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            font-weight: 500;
        }
        .btn-primary, .btn-primary:focus {
            background: #0d6efd;
            border-color: #0d6efd;
            box-shadow: none;
        }
        .btn-primary:hover {
            background: #0b5ed7;
            border-color: #0a58ca;
        }
        .table {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13,110,253,.15);
        }
        .alert {
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <header class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">iReply App</a>
            <div class="d-flex align-items-center">
                @auth
                    <span class="text-white me-3">Welcome, {{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})</span>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-light btn-sm">Register</a>
                @endauth
            </div>
        </div>
    </header>
    <div class="container-fluid" style="flex:1 0 auto;">
        <div class="row">
            @auth
            <nav class="col-md-2 d-none d-md-block sidebar py-4">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('employees*') ? 'active' : '' }}" href="{{ route('employees.index') }}">Employees</a></li>
                    
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item"><a class="nav-link {{ request()->is('equipment*') ? 'active' : '' }}" href="{{ route('equipment.index') }}">Equipment</a></li>
                    @endif
                    
                    <li class="nav-item"><a class="nav-link {{ request()->is('requests*') ? 'active' : '' }}" href="{{ route('requests.index') }}">Requests</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('activity-logs') ? 'active' : '' }}" href="{{ route('activity_logs.index') }}">Activity Logs</a></li>
                    
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item"><a class="nav-link {{ request()->is('admin*') ? 'active' : '' }}" href="{{ route('admin.index') }}">Admin</a></li>
                    @endif
                </ul>
            </nav>
            @endauth
            <main class="{{ Auth::check() ? 'col-md-10 ms-sm-auto' : 'col-12' }} px-4 main-content py-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    <footer class="footer mt-auto">
        <div class="container">
            <span class="text-muted">&copy; {{ date('Y') }} iReply App. All rights reserved.</span>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
