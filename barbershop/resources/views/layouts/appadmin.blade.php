<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: 'Poppins', sans-serif; 
            background: #1a1a1a; 
            color: #fff; 
        }

        .admin-wrapper { display: flex; min-height: 100vh; }

        .sidebar {
            width: 260px;
            background: #0f0f0f;
            border-right: 1px solid rgba(255,255,255,0.05);
            position: fixed;
            height: 100vh;
        }

        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-header h3 {
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-nav { padding: 15px 0; }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 25px;
            color: rgba(255,255,255,0.7);
            cursor: pointer;
            transition: 0.3s;
        }

        .nav-item:hover, .nav-item.active {
            background: rgba(255,255,255,0.05);
            color: #fff;
        }

        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 30px;
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: 0.3s; }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

<div class="admin-wrapper">
    <!-- SIDEBAR KIRI (navbar posisi kiri) -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3><i style="color: white;" class="bi bi-layout-text-sidebar-reverse"></i> Laporan<span style="font-weight:300; margin-left:4px;">admin</span></h3>
        </div>
        <div class="sidebar-nav">
            <div class="nav-item {{ request()->is('admin/report*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-bar-graph"></i> <span>Report</span>
            </div>
            <div class="nav-item {{ request()->is('admin/user*') ? 'active' : '' }}">
                <i class="bi bi-person"></i> <span>User data</span>
            </div>
            <div class="nav-item {{ request()->is('admin/cashier*') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i> <span>Cashier Data</span>
            </div>
            <div class="nav-item {{ request()->is('admin/booking*') ? 'active' : '' }}">
                <i class="bi bi-calendar-check"></i> <span>Booking Data</span>
            </div>
            <div class="nav-item {{ request()->is('admin/service*') ? 'active' : '' }}">
                <i class="bi bi-shop"></i> <span>Service Data</span>
            </div>
            <div class="nav-item {{ request()->is('admin/customer*') ? 'active' : '' }}">
                <i class="bi bi-person-fill-lock"></i> <span>Data Customer</span>
            </div>
            <div class="nav-item {{ request()->is('admin/barber*') ? 'active' : '' }}">
                <i class="bi bi-scissors"></i> <span>Data Barber</span>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>