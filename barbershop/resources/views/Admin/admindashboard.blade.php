@extends('layouts.appadmin')

@section('title', 'Admin Panel · Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/users/index.css') }}">
<style>
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 20px;
    }
    .stat-card {
        background: #2D2D2D;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }
    .stat-info p {
        margin: 0;
        font-size: 0.78rem;
        color: #aaa;
    }
    .stat-info h4 {
        margin: 4px 0 0;
        font-size: 1.4rem;
        font-weight: 700;
        color: #fff;
    }
    .row-cards {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 20px;
    }
    .dash-card {
        background: #2D2D2D;
        border-radius: 12px;
        overflow: hidden;
    }
    .dash-card-header {
        background: #1e1e1e;
        padding: 14px 18px;
        color: #fff;
        font-weight: 600;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .dash-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.84rem;
    }
    .dash-table thead th {
        background: #3E3B3B;
        color: #ccc;
        padding: 10px 14px;
        font-weight: 600;
        text-align: left;
    }
    .dash-table tbody td {
        padding: 10px 14px;
        color: #e0e0e0;
        border-bottom: 1px solid rgba(255,255,255,0.04);
        vertical-align: middle;
    }
    
    .dash-table tbody tr:last-child td { border-bottom: none; }
    .dash-table tbody tr:hover td { background: rgba(255,255,255,0.03); }
    .status-badge {
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .status-menunggu { background: rgba(255,193,7,0.15); color: #ffc107; }
    .status-diterima { background: rgba(76,175,80,0.15); color: #4caf50; }
    .status-batal    { background: rgba(229,57,53,0.15);  color: #e57373; }
    .status-selesai    { background: rgb(44, 114, 227, 0.15);  color: #3B82F6; }
    @media (max-width: 992px) {
        .stat-grid  { grid-template-columns: repeat(2, 1fr); }
        .row-cards  { grid-template-columns: 1fr; }
    }
    @media (max-width: 576px) {
        .stat-grid  { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div style="padding: 0 15px;">

<div class="breadcrumb-panel">
    <i class="bi bi-house-door"></i> Panel / <span style="font-weight:500; color:black;">Dashboard</span>
</div>

{{-- STAT CARDS --}}
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background:rgba(59,130,246,0.15);">
            <i class="bi bi-people" style="color:#3b82f6;"></i>
        </div>
        <div class="stat-info">
            <p>Total Customer</p>
            <h4>{{ $totalCustomer }}</h4>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background:rgba(76,175,80,0.15);">
            <i class="bi bi-calendar-check" style="color:#4caf50;"></i>
        </div>
        <div class="stat-info">
            <p>Booking Hari Ini</p>
            <h4>{{ $bookingHariIni }}</h4>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background:rgba(255,193,7,0.15);">
            <i class="bi bi-scissors" style="color:#ffc107;"></i>
        </div>
        <div class="stat-info">
            <p>Total Barber</p>
            <h4>{{ $totalBarber }}</h4>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background:rgba(181,160,140,0.2);">
            <i class="bi bi-currency-dollar" style="color:#b5a08c;"></i>
        </div>
        <div class="stat-info">
            <p>Income Bulan Ini</p>
            <h4 style="font-size:1rem;">Rp {{ number_format($incomeBulanIni, 0, ',', '.') }}</h4>
        </div>
    </div>
</div>

{{-- ROW: BOOKING TERBARU + BARBER --}}
<div class="row-cards">

    {{-- BOOKING TERBARU --}}
    <div class="dash-card">
        <div class="dash-card-header">
            <i class="bi bi-calendar3"></i> Booking Terbaru
        </div>
        <table class="dash-table">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookingTerbaru as $b)
                <tr>
                    <td>{{ $b->username }}</td>
                    <td>{{ \Carbon\Carbon::parse($b->tanggal)->format('d/m/Y H:i') }}</td>
                    <td>
                        <span class="status-badge status-{{ $b->status }}">
                            {{ ucfirst($b->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center" style="color:#666;">Belum ada booking.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- DATA BARBER --}}
    <div class="dash-card">
        <div class="dash-card-header">
            <i class="bi bi-scissors"></i> Data Barber
        </div>
        <table class="dash-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barbers as $barber)
                <tr>
                    <td>{{ $barber->nama }}</td>
                    <td>{{ $barber->no_hp ?? '-' }}</td>
                    <td>{{ $barber->alamat ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center" style="color:#666;">Belum ada barber.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

{{-- ROW: SERVICE --}}
<div class="dash-card">
    <div class="dash-card-header">
        <i class="bi bi-card-checklist"></i> Daftar Service
    </div>
    <table class="dash-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Service</th>
                <th>Harga</th>
                <th>Estimasi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $i => $s)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $s->nama_service }}</td>
                <td>Rp {{ number_format($s->harga, 0, ',', '.') }}</td>
                <td>{{ $s->estimasi_menit }} menit</td>
                <td>
                    @if($s->is_active)
                        <span class="status-badge status-diterima">Aktif</span>
                    @else
                        <span class="status-badge status-batal">Nonaktif</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center" style="color:#666;">Belum ada service.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

</div>
@endsection