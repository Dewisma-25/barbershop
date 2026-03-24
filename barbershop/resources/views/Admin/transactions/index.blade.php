
@extends('layouts.appadmin')

@section('title', 'Admin Panel · Data Services')

@section('page-title', 'Proses Transaksi')

@push('styles')
<link rel="stylesheet" href="{{asset('css/admin/users/index.css')}}">
@endpush

@section('content')

<!-- panel atas breadcrumb -->
<div class="breadcrumb-panel">
    <i style="color: black;" class="bi bi-house-door"></i> Panel / <span style="font-weight:500; color:black;">Proses Transaksi</span>
</div>

<!-- CARD UTAMA -->
<div class="container-fluid p-0 mt-4">

    <div class="user-card">

        <div class="user-header">
            <h5>⚙️ Proses Transaksi</h5>
        </div>

        @if(session('success'))
        <div class="user-header">
            <p class="alert alert-success">{{session('success')}}</p>
        </div>
        @endif
<div class="table-wrapper">
        <table class="table table-borderless user-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Customer</th>
                    <th>Barber</th>
                    <th>Kasir</th>
                    <th>Booking</th>
                    <th>Tanggal</th>
                    <th>Metode bayar</th>
                    <th>Total</th>
                    <th>Status layanan</th>
                    <th>status pembayaran</th>
                    <th>Final</th>
                </tr>
            </thead>

            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$transaction->customer->user->nama ?? '-'}}</td>
                    <td>{{$transaction->barber->nama ?? '-'}}</td>
                    <td>{{$transaction->kasir->user->nama ?? '-'}}</td>
                    <td>{{$transaction->booking->id ?? '-'}}</td>
                    <td>{{$transaction->tanggal->format('j/n/Y·H:i')}}</td>
                    <td>{{$transaction->metode_bayar}}</td>
                    <td>Rp {{number_format($transaction->total,0,',','.' )}}</td>
                    <td>
                        @if($transaction->status_layanan == 'proses')
                        <span class="badge bg-warning">Proses</span>
                        @else
                        <span class="badge bg-success">Selesai</span>
                        @endif
                    </td>
                    <td>
                        @if($transaction->status_pembayaran == 'pending')
                        <span class="badge bg-danger">Pending</span>
                        @else
                        <span class="badge bg-success">Lunas</span>
                        @endif
                    </td>
                    <td>
                        @if($transaction->status_layanan == 'proses')
                        <div class="d-flex gap-2">
                            <form action="{{ route('transactions.complete', $transaction->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-success btn-sm">
                                    Selesaikan
                                </button>
                            </form>
                        @else
                            <form action="{{ route('transactions.complete', $transaction->id) }}" method="POST">
                                @csrf
                                <button style="background-color: #2D2D2D;" disabled class="btn btn-secondary btn-sm text-white">
                                    Selesaikan
                                </button>
                            </form>
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>

    </div>

</div>

@endsection