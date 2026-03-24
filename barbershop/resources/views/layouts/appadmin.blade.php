<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ===== CHECKBOX HACK ===== */
        #sidebar-toggle { display: none; }

        /* ===== OVERLAY ===== */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 199;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 240px;
            height: 100vh;
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 60%, #0f3460 100%);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 200;
            box-shadow: 4px 0 15px rgba(0,0,0,0.3);
            overflow-y: auto;
            transition: transform 0.3s ease;
        }

        .sidebar-header {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .sidebar-header h3 {
            color: #fff;
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-header h3 i { font-size: 1.3rem; color: #e94560; }
        .sidebar-header h3 span { color: rgba(255,255,255,0.55); font-weight: 300; }

        .sidebar-nav {
            flex: 1;
            padding: 16px 0;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: rgba(255,255,255,0.65);
            font-size: 0.88rem;
            font-weight: 500;
            border-radius: 0 24px 24px 0;
            margin-right: 16px;
            transition: all 0.25s ease;
            text-decoration: none;
        }

        .nav-item i { font-size: 1rem; width: 20px; text-align: center; flex-shrink: 0; }

        .nav-item:hover {
            background: rgba(233,69,96,0.15);
            color: #fff;
            transform: translateX(4px);
        }

        .nav-item:hover i { color: #e94560; }

        .nav-item.active {
            background: linear-gradient(90deg, rgba(233,69,96,0.3), rgba(233,69,96,0.1));
            color: #fff;
            border-left: 3px solid #e94560;
            padding-left: 17px;
        }

        .nav-item.active i { color: #e94560; }

        .sidebar-logout {
            padding: 16px 20px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .sidebar-logout .btn-logout {
            width: 100%;
            background: rgba(233,69,96,0.15);
            color: #e94560;
            border: 1px solid rgba(233,69,96,0.3);
            border-radius: 10px;
            padding: 10px;
            font-size: 0.88rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .sidebar-logout .btn-logout:hover {
            background: #e94560;
            color: #fff;
            border-color: #e94560;
        }

        /* ===== MAIN WRAPPER ===== */
        .main-wrapper {
            margin-left: 240px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            background: #fff;
            padding: 14px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .topbar-left { display: flex; align-items: center; gap: 14px; }

        /* hamburger label — hidden on desktop */
        .btn-toggle {
            display: none;
            font-size: 1.5rem;
            color: #1a1a2e;
            cursor: pointer;
            line-height: 1;
            user-select: none;
        }

        .topbar-title { font-size: 1.1rem; font-weight: 700; color: #1a1a2e; }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.88rem;
            color: #555;
            font-weight: 500;
        }

        .topbar-user .avatar {
            width: 34px;
            height: 34px;
            background: linear-gradient(135deg, #1a1a2e, #0f3460);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .page-content { flex: 1; padding: 28px; }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f0f2f5; }
        ::-webkit-scrollbar-thumb { background: #c5c9d6; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #a0a5b3; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            /* when checkbox checked — show sidebar & overlay */
            #sidebar-toggle:checked ~ .sidebar-overlay { display: block; }
            #sidebar-toggle:checked ~ .sidebar { transform: translateX(0); }

            .main-wrapper {
                margin-left: 0;
            }

            .btn-toggle { display: block; }

            .page-content { padding: 16px; }
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- CHECKBOX HACK — harus di luar semua wrapper --}}
    <input type="checkbox" id="sidebar-toggle">

    {{-- OVERLAY — klik untuk tutup sidebar (pakai label) --}}
    <label for="sidebar-toggle" class="sidebar-overlay"></label>

    {{-- SIDEBAR --}}
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>
                <i class="bi bi-layout-text-sidebar-reverse"></i>
                Laporan<span>admin</span>
            </h3>
        </div>

        <div class="sidebar-nav">
            <a href="/admin/admindashboard" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid"></i><span>Dashboard</span>
            </a>
            <a href="/admin/users" class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="bi bi-person"></i><span>User Data</span>
            </a>
            <a href="/admin/kasir" class="nav-item {{ request()->routeIs('kasir.*') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i><span>Cashier Data</span>
            </a>
            <a href="/admin/bookings" class="nav-item {{ request()->routeIs('bookings.*') ? 'active' : '' }}">
                <i class="bi bi-calendar3"></i><span>Booking Data</span>
            </a>
            <a href="/admin/transactions" class="nav-item {{ request()->routeIs('transactions.*') ? 'active' : '' }}">
                <i class="bi bi-credit-card"></i><span>Transaction</span>
            </a>
            <a href="/admin/laporan" class="nav-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line"></i><span>Report Data</span>
            </a>
            <a href="/admin/services" class="nav-item {{ request()->routeIs('services.*') ? 'active' : '' }}">
                <i class="bi bi-card-checklist"></i><span>Service Data</span>
            </a>
            <a href="/admin/customers" class="nav-item {{ request()->routeIs('customers.*') ? 'active' : '' }}">
                <i class="bi bi-person-fill-lock"></i><span>Data Customer</span>
            </a>
            <a href="/admin/barbers" class="nav-item {{ request()->routeIs('barbers.*') ? 'active' : '' }}">
                <i class="bi bi-scissors"></i><span>Data Barber</span>
            </a>
        </div>

        <div class="sidebar-logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>

    {{-- MAIN WRAPPER --}}
    <div class="main-wrapper">
        <div class="topbar">
            <div class="topbar-left">
                {{-- Hamburger label --}}
                <label for="sidebar-toggle" class="btn-toggle">
                    <i class="bi bi-list"></i>
                </label>
                <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
            </div>
            <div class="topbar-right">
                <div class="topbar-user">
                    <div class="avatar">A</div>
                    <span>Admin</span>
                </div>
            </div>
        </div>

        <div class="page-content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

</body>
</html>