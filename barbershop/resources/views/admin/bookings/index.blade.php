@extends('layouts.appadmin')

@section('title', 'Admin Panel · Booking Data')
@section('page-title', 'Booking Data')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/users/index.css') }}">
@endpush

@section('content')

<div class="breadcrumb-panel">
    <i class="bi bi-house-door"></i> Panel / <span style="font-weight:500; color:black;">Booking Data</span>
</div>

<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="user-card">
        <div class="user-header">
            <h5 class="mb-0">Customer Booking Data</h5>
        </div>

        <table class="table table-borderless user-table mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Barber</th>
                    <th>Action</th>
                    <th>Transaction Proccess</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $i => $booking)
                <tr>
                    <td>{{ $i + 1 }}.</td>
                    <td>{{ $booking->username }}</td>
                    <td>{{ $booking->email }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->tanggal)->format('d/m/Y H:i') }}</td>
                    <td>{{ $booking->nama_barber ? 'Barber ' . $booking->nama_barber : '-' }}</td>
                    <td>
                        <div class="d-flex gap-2 flex-wrap">
                            @if($booking->status === 'menunggu')
                                <form action="{{ route('bookings.accept', $booking->id) }}" method="POST" class="m-0">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn-edit">Accept</button>
                                </form>
                                <form action="{{ route('bookings.reject', $booking->id) }}" method="POST" class="m-0">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn-delete"
                                            onclick="return confirm('Yakin tolak booking ini?')">Reject</button>
                                </form>
                            @endif
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn-edit text-decoration-none">
                                Edit
                            </a>
                        </div>
                    </td>
                    <td>
                        @if ($booking->status == 'diterima')
                        <a class="btn btn-success btn-sm" href="{{ route('transactions.create', $booking->id) }}">Proses Transaksi</a>

                        @elseif ($booking->status =='menuggu')
                        <button disabled class="btn btn-secondary btn-sm">Proses Transaksi</button>
                        @else
                        <button disabled class="btn btn-secondary btn-sm">Proses Transaksi</button>
                        @endif
                </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">Belum ada data booking.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection