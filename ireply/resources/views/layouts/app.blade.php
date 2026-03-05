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
            height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', 'Roboto', 'Arial', sans-serif;
            background: #f4f6fa;
            color: #222;
        }
        .main-content { 
            flex: 1;
            overflow-y: auto;
            position: relative;
            display: flex;
            flex-direction: column;
            background: #f8f9fa; /* Consistent background */
        }
        /* Custom scrollbar for main content */
        .main-content::-webkit-scrollbar {
            width: 8px;
        }
        .main-content::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        .main-content::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }
        .main-content::-webkit-scrollbar-thumb:hover {
            background: #bbb;
        }
        .content-body {
            flex: 1;
        }
        .sidebar {
            width: 240px;
            background: #1a1d20;
            height: calc(100vh - 56px); /* Assume header is 56px */
            border-right: 1px solid #2d3238;
            transition: width 0.3s ease;
            flex-shrink: 0;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        .sidebar-content {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
        }
        .sidebar-content::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-content::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
        }
        .sidebar.collapsed {
            width: 70px;
        }
        .sidebar #sidebarToggle {
            transition: opacity 0.3s;
        }
        .sidebar.collapsed #sidebarToggle {
            opacity: 0.8;
        }
        .sidebar.collapsed .justify-content-end {
            justify-content: center !important;
        }
        .sidebar .nav-link {
            color: #bdc5cd;
            border-radius: 6px;
            margin: 0 10px 5px 10px;
            padding: 0 15px;
            height: 48px; /* Slightly taller for better symmetry */
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            white-space: nowrap;
            text-decoration: none;
            position: relative;
        }
        .sidebar.collapsed .nav-link {
            margin: 0 10px 5px 10px;
            justify-content: center;
            padding: 0;
            width: 50px;
        }
        .sidebar .nav-link i {
            font-size: 1.25rem;
            min-width: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .sidebar.collapsed .nav-link i {
            margin: 0;
        }
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.08);
            color: #fff;
        }
        .sidebar .nav-link.active {
            background: #0d6efd;
            color: #fff;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25);
        }
        .sidebar .nav-link.indent {
            padding-left: 1.75rem; /* Slightly reduced indentation */
        }
        .sidebar.collapsed .nav-link.indent {
            padding-left: 0.75rem;
        }
        .sidebar .submenu-arrow {
            margin-left: auto;
            transition: transform 0.3s;
            font-size: 0.75rem;
        }
        .sidebar .nav-link[aria-expanded="true"] .submenu-arrow {
            transform: rotate(180deg);
        }
        .sidebar .submenu {
            background: rgba(0,0,0,0.2);
            padding: 0.25rem 0;
        }
        .sidebar.collapsed .submenu {
            display: none !important;
        }
        .sidebar.collapsed .nav-link span,
        .sidebar.collapsed h6,
        .sidebar.collapsed .submenu-arrow {
            display: none;
        }
        .sidebar.collapsed .px-3 {
            padding-left: 0.25rem !important;
            padding-right: 0.25rem !important;
        }
        /* Tooltips for collapsed state */
        .sidebar.collapsed .nav-link {
            position: relative;
        }
        .sidebar.collapsed .nav-link::after {
            content: attr(data-title);
            position: absolute;
            left: 100%;
            margin-left: 10px;
            background: #1a1d20;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.75rem;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s;
            white-space: nowrap;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            border: 1px solid #2d3238;
        }
        .sidebar.collapsed .nav-link:hover::after {
            opacity: 1;
        }
        .sidebar h6 {
            color: #adb5bd !important;
            letter-spacing: 0.05rem;
            font-size: 0.7rem;
            font-weight: 700 !important;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
            padding: 0 20px;
            text-transform: uppercase;
            transition: opacity 0.3s;
        }
        .sidebar.collapsed h6 {
            opacity: 0;
            height: 0;
            margin: 0;
            overflow: hidden;
        }
        .sidebar-header {
            padding: 24px 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            margin-bottom: 15px;
        }
        .sidebar.collapsed .sidebar-header {
            justify-content: center;
            padding: 24px 0;
        }
        .sidebar-logo {
            font-size: 1.6rem;
            color: #0d6efd;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .sidebar-brand {
            font-size: 1.15rem;
            font-weight: 600;
            color: #fff;
            white-space: nowrap;
            transition: opacity 0.3s;
        }
        .sidebar.collapsed .sidebar-brand {
            display: none;
        }
        /* Toggle button in header */
        .sidebar-toggle-btn {
            background: none;
            border: none;
            color: #bdc5cd;
            padding: 0;
            margin-left: auto;
            transition: color 0.2s;
        }
        .sidebar-toggle-btn:hover {
            color: #fff;
        }
        .sidebar.collapsed .sidebar-toggle-btn {
            margin: 0;
            display: none; /* Hide toggle in collapsed mode if header icon is clickable OR just keep it hidden like the reference */
        }
        /* Re-show toggle if you want it visible in collapsed mode too */
        .sidebar.collapsed .sidebar-header:hover .sidebar-toggle-btn {
             /* Optional: show on hover */
        }

        .sidebar-profile {
            margin-top: auto;
            padding: 15px;
            border-top: 1px solid rgba(255,255,255,0.05);
            display: flex;
            align-items: center;
            gap: 12px;
            overflow: hidden;
            background: rgba(0,0,0,0.1);
        }
        .sidebar.collapsed .sidebar-profile {
            justify-content: center;
            padding: 15px 0;
        }
        .profile-img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #2d3238;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #adb5bd;
            flex-shrink: 0;
            font-size: 1.2rem;
        }
        .profile-details {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: opacity 0.3s;
        }
        .sidebar.collapsed .profile-details {
            display: none;
        }
        .profile-name {
            font-size: 0.875rem;
            font-weight: 600;
            color: #fff;
            white-space: nowrap;
        }
        .profile-role {
            font-size: 0.75rem;
            color: #adb5bd;
            white-space: nowrap;
            text-transform: capitalize;
        }

        /* Tooltips */
        .sidebar.collapsed .nav-link::after {
            content: attr(data-title);
            position: absolute;
            left: 100%;
            margin-left: 15px;
            background: #212529;
            color: #fff;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.8rem;
            opacity: 0;
            pointer-events: none;
            transition: 0.2s ease;
            white-space: nowrap;
            z-index: 1050;
            box-shadow: 0 4px 12px rgba(0,0,0,0.5);
        }
        .sidebar.collapsed .nav-link:hover::after {
            opacity: 1;
            transform: translateX(5px);
        }
        .footer {
            background: #212529;
            border-top: 1px solid #2d3238;
            padding: 0.75rem 0; /* More compact footer */
            text-align: center;
            color: #adb5bd;
            width: 100%;
            margin: 0; /* Zero margin */
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
                    <div id="real-time-clock" class="text-white me-4 small d-none d-md-block">
                        <i class="bi bi-clock me-1"></i> <span id="clock-display"></span>
                    </div>
                    <span class="text-white py-1 px-3 rounded-pill bg-white bg-opacity-10 small">
                        <i class="bi bi-person-circle me-1"></i> Welcome, {{ auth()->user()->name }}
                    </span>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-light btn-sm">Register</a>
                @endauth
            </div>
        </div>
    </header>
    <div class="container-fluid p-0" style="flex: 1; overflow: hidden;">
        <div class="row g-0 flex-nowrap h-100">
            @auth
            <nav class="sidebar d-none d-md-flex" id="sidebar">
                <div class="sidebar-header">
                    <div class="sidebar-logo">
                        <i class="bi bi-cloud-check-fill"></i>
                    </div>
                    <div class="sidebar-brand">iReply App</div>
                    <button id="sidebarToggle" class="sidebar-toggle-btn">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                </div>

                <div class="sidebar-content">
                    <div class="mb-4">
                        <h6>Overview</h6>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}" data-title="Dashboard">
                                    <i class="bi bi-speedometer2"></i> <span class="ms-3">Dashboard</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="mb-2">
                        <h6>Employee Module</h6>
                        <ul class="nav flex-column gap-1">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('employees*') || request()->is('requests*') ? 'active' : '' }}" 
                                   data-bs-toggle="collapse" href="#employeeSubmenu" role="button" 
                                   aria-expanded="{{ request()->is('employees*') || request()->is('requests*') ? 'true' : 'false' }}"
                                   data-title="Employees">
                                    <i class="bi bi-people"></i> <span class="ms-3">Manage Employees</span>
                                    <i class="bi bi-chevron-down submenu-arrow"></i>
                                </a>
                                <div class="collapse {{ request()->is('employees*') || request()->is('requests*') ? 'show' : '' }} submenu" id="employeeSubmenu">
                                    <ul class="nav flex-column gap-1">
                                        <li class="nav-item">
                                            <a class="nav-link indent {{ request()->routeIs('employees.index') ? 'active' : '' }}" href="{{ route('employees.index') }}" data-title="View Employee">
                                                <i class="bi bi-list"></i> <span class="ms-3">View Employee</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link indent {{ request()->routeIs('requests.index') ? 'active' : '' }}" href="{{ route('requests.index') }}" data-title="View Request">
                                                <i class="bi bi-clipboard-list"></i> <span class="ms-3">View Request</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link indent {{ request()->routeIs('employees.approved') ? 'active' : '' }}" href="{{ route('employees.approved') }}" data-title="View Approved">
                                                <i class="bi bi-check-circle"></i> <span class="ms-3">View Approved</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link indent {{ request()->is('activity-logs*') ? 'active' : '' }}" href="{{ route('activity_logs.index') }}" data-title="Activity Logs">
                                                <i class="bi bi-journal-text"></i> <span class="ms-3">View Activity Logs</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>

                    @if(auth()->user()->role === 'admin')
                    <div class="mb-2">
                        <h6>Equipment Management</h6>
                        <ul class="nav flex-column gap-1">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('equipment*') ? 'active' : '' }}" 
                                   data-bs-toggle="collapse" href="#equipmentSubmenu" role="button"
                                   aria-expanded="{{ request()->is('equipment*') ? 'true' : 'false' }}"
                                   data-title="Equipment">
                                    <i class="bi bi-tools"></i> <span class="ms-3">Equipment Mgmt</span>
                                    <i class="bi bi-chevron-down submenu-arrow"></i>
                                </a>
                                <div class="collapse {{ request()->is('equipment*') ? 'show' : '' }} submenu" id="equipmentSubmenu">
                                    <ul class="nav flex-column gap-1">
                                        <li class="nav-item">
                                            <a class="nav-link indent {{ request()->routeIs('equipment.index') ? 'active' : '' }}" href="{{ route('equipment.index') }}" data-title="All Equipment">
                                                <i class="bi bi-cpu"></i> <span class="ms-3">All Equipment</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link indent {{ request()->routeIs('equipment.create') ? 'active' : '' }}" href="{{ route('equipment.create') }}" data-title="Add New">
                                                <i class="bi bi-plus-lg"></i> <span class="ms-3">Add New</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link indent {{ request()->routeIs('equipment.archived') ? 'active' : '' }}" href="{{ route('equipment.archived') }}" data-title="Archived">
                                                <i class="bi bi-archive"></i> <span class="ms-3">Archived</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h6>Super Admin</h6>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin*') ? 'active' : '' }}" href="{{ route('admin.index') }}" data-title="Roles">
                                    <i class="bi bi-shield-lock"></i> <span class="ms-3">Role Management</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    @endif
                </div>

                <div class="sidebar-profile">
                    <div class="profile-img">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <div class="profile-details">
                        <div class="profile-name text-truncate" style="max-width: 140px;">{{ auth()->user()->name }}</div>
                        <div class="profile-role">{{ auth()->user()->role }}</div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="ms-auto m-0 d-none d-lg-block">
                        @csrf
                        <button type="submit" class="btn btn-link text-white p-0" title="Logout">
                            <i class="bi bi-box-arrow-right fs-5"></i>
                        </button>
                    </form>
                </div>
            </nav>
            @endauth
            <main class="flex-grow-1 main-content p-0 pt-4">
                <div class="content-body px-4">
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
                </div>
                
                <footer class="footer mt-auto">
                    <div class="container-fluid">
                        <span class="small">&copy; {{ date('Y') }} iReply App. All rights reserved.</span>
                    </div>
                </footer>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebarToggle');
            const headerLogo = document.querySelector('.sidebar-logo');
            
            if (sidebar) {
                // Check local storage for saved state
                if (localStorage.getItem('sidebar-collapsed') === 'true') {
                    sidebar.classList.add('collapsed');
                }
                
                const handleToggle = () => {
                    sidebar.classList.toggle('collapsed');
                    localStorage.setItem('sidebar-collapsed', sidebar.classList.contains('collapsed'));
                };

                if (toggle) toggle.addEventListener('click', handleToggle);
                if (headerLogo) headerLogo.addEventListener('click', handleToggle);
            }

            // Real-time Clock
            function updateClock() {
                const now = new Date();
                const options = { 
                    weekday: 'short', 
                    year: 'numeric', 
                    month: 'short', 
                    day: 'numeric',
                    hour: '2-digit', 
                    minute: '2-digit', 
                    second: '2-digit' 
                };
                const display = document.getElementById('clock-display');
                if (display) {
                    display.innerText = now.toLocaleString('en-US', options);
                }
            }
            setInterval(updateClock, 1000);
            updateClock();
        });
    </script>
</body>
</html>
