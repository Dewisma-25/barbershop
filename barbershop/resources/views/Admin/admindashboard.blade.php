@extends('layouts.appadmin')

@section('title', 'Admin Panel · Laporan')

@section('page-title', 'Laporan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/users/index.css') }}">
<style>
    .dark-card {
        background: #1e1e1e !important;
        border-radius: 12px;
        overflow: hidden;
    }
    .dark-card .user-header {
        background: #1e1e1e !important;
    }
    .dark-card thead th {
        background: #2e2e2e !important;
        color: #e0e0e0 !important;
    }
    .dark-card tbody tr:nth-child(odd) td {
        background: #1e1e1e !important;
        color: #e0e0e0 !important;
    }
    .dark-card tbody tr:nth-child(even) td {
        background: #2e2e2e !important;
        color: #e0e0e0 !important;
    }
    .dark-card.income-card thead th {
        background: #8b2a1e !important;
        color: #ffffff !important;
    }
    .dark-card.income-card tbody tr td {
        background: #8b2a1e !important;
        color: #ffffff !important;
    }
</style>
@endpush

@section('content')

<div class="breadcrumb-panel">
    <i class="bi bi-house-door"></i> Panel / <span style="font-weight:500; color:black;">Laporan</span>
</div>

<div class="d-flex flex-column gap-3">

    {{-- LAPORAN CUSTOMER BULAN INI --}}
    <div class="user-card">
        <div class="user-header">
            <h5 class="mb-0">
                <i class="bi bi-person-circle me-2"></i> Laporan Customer Bulan Ini
            </h5>
        </div>
        <table class="table table-borderless user-table mb-0">
            <thead>
                <tr>
                    <th class="text-center">Customer Repeat</th>
                    <th class="text-center">Customer Baru</th>
                    <th class="text-center">Total Customer</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center fw-bold">{{ $customerRepeat }} Person</td>
                    <td class="text-center fw-bold">{{ $customerBaru }} Person</td>
                    <td class="text-center fw-bold">{{ $totalCustomer }} Person</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- PESANAN HARI INI --}}
    <div class="user-card dark-card">
        <div class="user-header">
            <span class="btn-add" style="pointer-events:none; background:#b5a08c; color:#1a1a1a;">Pesanan Hari Ini</span>
        </div>
        <table class="table table-borderless user-table mb-0">
            <thead>
                <tr>
                    <th class="text-center">Laporan Pesanana Selesai</th>
                    <th class="text-center">Laporan Pesanan Tidak Selesai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">
                        <i class="bi bi-receipt-cutoff me-1"></i>
                        pesanan selesai : {{ $pesananSelesai }} person
                    </td>
                    <td class="text-center">
                        <i class="bi bi-receipt-cutoff me-1"></i>
                        pesanan tidak selesai : {{ $pesananTidakSelesai }} person
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- INCOME REPORT --}}
    <div class="user-card dark-card income-card">
        <div class="user-header">
            <span class="btn-add" style="pointer-events:none; background:#b5a08c; color:#1a1a1a;">Income Report</span>
        </div>
        <table class="table table-borderless user-table">
            <thead>
                <tr>
                    <th class="text-center">Total Income This Month</th>
                    <th class="text-center">Total Income This Year</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center fw-bold fs-5">
                        <i class="bi bi-currency-dollar"></i>
                        Rp {{ number_format($incomeBulanIni, 0, ',', '.') }}
                    </td>
                    <td class="text-center fw-bold fs-5">
                        <i class="bi bi-currency-dollar"></i>
                        Rp {{ number_format($incomeTahunIni, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div style="background:#1e1e1e; padding: 8px 16px 16px;">
            <canvas id="incomeChart" style="max-height: 220px;"></canvas>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
    const labels      = {!! json_encode($chartLabels) !!};
    const dataSelesai = {!! json_encode($chartSelesai) !!};
    const dataBaru    = {!! json_encode($chartBaru) !!};
    const dataRepeat  = {!! json_encode($chartRepeat) !!};

    const ctx = document.getElementById('incomeChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Customer Repeat',
                    data: dataRepeat,
                    backgroundColor: 'rgba(180, 140, 110, 0.75)',
                    borderRadius: 4,
                    borderSkipped: false,
                },
                {
                    label: 'Customer Baru',
                    data: dataBaru,
                    backgroundColor: 'rgba(100, 160, 210, 0.75)',
                    borderRadius: 4,
                    borderSkipped: false,
                },
                {
                    label: 'Pesanan Selesai',
                    data: dataSelesai,
                    backgroundColor: 'rgba(100, 200, 140, 0.75)',
                    borderRadius: 4,
                    borderSkipped: false,
                },
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    labels: { color: '#cccccc', font: { size: 11 } }
                },
                tooltip: {
                    backgroundColor: '#2e2e2e',
                    titleColor: '#ffffff',
                    bodyColor: '#cccccc',
                }
            },
            scales: {
                x: {
                    ticks: { color: '#aaaaaa', font: { size: 10 } },
                    grid: { color: 'rgba(255,255,255,0.05)' }
                },
                y: {
                    ticks: { color: '#aaaaaa', font: { size: 10 } },
                    grid: { color: 'rgba(255,255,255,0.07)' },
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush