<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/layouts/appadmin.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

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