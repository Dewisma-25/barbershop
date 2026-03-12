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

    /* chart tabs */
    .chart-tabs {
        display: flex;
        gap: 8px;
        padding: 12px 16px 0;
    }
    .chart-tab-btn {
        background: #3a3a3a;
        color: #aaaaaa;
        border: none;
        border-radius: 20px;
        padding: 5px 16px;
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    .chart-tab-btn.active {
        background: #b5a08c;
        color: #1a1a1a;
    }
    .chart-tab-btn:hover:not(.active) {
        background: #4a4a4a;
        color: #ffffff;
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

        {{-- TAB BUTTONS --}}
        <div class="chart-tabs">
            <button class="chart-tab-btn active" onclick="switchChart('weekly', this)">Mingguan</button>
            <button class="chart-tab-btn" onclick="switchChart('monthly', this)">Bulanan</button>
            <button class="chart-tab-btn" onclick="switchChart('yearly', this)">Tahunan</button>
        </div>

        <div style="background:#1e1e1e; padding: 8px 16px 16px;">
            <canvas id="incomeChart" style="max-height: 220px;"></canvas>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
    const chartData = {
        weekly: {
            labels: {!! json_encode($weeklyLabels) !!},
            data:   {!! json_encode($weeklyData) !!},
        },
        monthly: {
            labels: {!! json_encode($monthlyLabels) !!},
            data:   {!! json_encode($monthlyData) !!},
        },
        yearly: {
            labels: {!! json_encode($yearlyLabels) !!},
            data:   {!! json_encode($yearlyData) !!},
        }
    };

    const ctx = document.getElementById('incomeChart').getContext('2d');

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartData.weekly.labels,
            datasets: [{
                label: 'Income (Rp)',
                data: chartData.weekly.data,
                backgroundColor: 'rgba(180, 80, 60, 0.8)',
                borderColor: 'rgba(220, 100, 80, 1)',
                borderWidth: 1,
                borderRadius: 5,
                borderSkipped: false,
            }]
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
                    callbacks: {
                        label: function(context) {
                            return ' Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                x: {
                    ticks: { color: '#aaaaaa', font: { size: 10 } },
                    grid: { color: 'rgba(255,255,255,0.05)' }
                },
                y: {
                    ticks: {
                        color: '#aaaaaa',
                        font: { size: 10 },
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    },
                    grid: { color: 'rgba(255,255,255,0.07)' },
                    beginAtZero: true
                }
            }
        }
    });

    function switchChart(type, btn) {
        // update active button
        document.querySelectorAll('.chart-tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        // update chart data
        chart.data.labels = chartData[type].labels;
        chart.data.datasets[0].data = chartData[type].data;
        chart.update();
    }
</script>
@endpush