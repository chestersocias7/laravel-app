<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'iReply App')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
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
        </div>
    </header>
    <div class="container-fluid" style="flex:1 0 auto;">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block sidebar py-4">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('employees*') ? 'active' : '' }}" href="{{ route('employees.index') }}">Employees</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('equipment*') ? 'active' : '' }}" href="{{ route('equipment.index') }}">Equipment</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('requests*') ? 'active' : '' }}" href="{{ route('requests.index') }}">Requests</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('activity-logs') ? 'active' : '' }}" href="{{ route('activity_logs.index') }}">Activity Logs</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('admin*') ? 'active' : '' }}" href="{{ route('admin.index') }}">Admin</a></li>
                </ul>
            </nav>
            <main class="col-md-10 ms-sm-auto px-4 main-content py-4">
                @yield('content')
            </main>
        </div>
    </div>
    <footer class="footer mt-auto">
        <div class="container">
            <span class="text-muted">&copy; {{ date('Y') }} iReply App. All rights reserved.</span>
        </div>
    </footer>
</body>
</html>
