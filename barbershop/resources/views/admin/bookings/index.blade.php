@extends('layouts.appadmin')

@section('title', 'Admin Panel · Booking Data')

@section('page-title', 'Booking Data')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/users/index.css') }}">
@endpush

@section('content')

<div class="breadcrumb-panel">
    <i style="color:black;" class="bi bi-house-door"></i> Panel /
    <span style="font-weight:500; color:black;">Booking Data</span>
</div>
<div class="page-title">Data Booking</div>

<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="user-card">
        <div class="user-header">
            <h5>Customer Booking Data</h5>
        </div>

        <table class="table table-borderless user-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Barber</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $i => $booking)
                <tr>
                    <td>{{ $i + 1 }}.</td>
                    <td>{{ $booking->username }}</td>
                    <td>{{ $booking->email }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->tanggal)->format('j/n/Y·H:i') }}</td>
                    <td>Barber {{ $booking->nama_barber ?? '-' }}</td>
                    <td>
                        @if($booking->status === 'diterima')
                            <span class="badge bg-success">Diterima</span>
                        @elseif($booking->status === 'batal')
                            <span class="badge bg-danger">Batal</span>
                        @else
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2 flex-wrap">
                            @if($booking->status === 'menunggu')
                                <form action="{{ route('bookings.accept', $booking->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn-edit border-0"
                                            style="background:#4caf50; color:#fff; padding:5px 14px; border-radius:20px; cursor:pointer; font-size:0.85rem;">
                                        Accept
                                    </button>
                                </form>
                                <form action="{{ route('bookings.reject', $booking->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn-delete border-0"
                                            style="padding:5px 14px; border-radius:20px; cursor:pointer; font-size:0.85rem;"
                                            onclick="return confirm('Yakin tolak booking ini?')">
                                        Reject
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('bookings.edit', $booking->id) }}"
                               class="btn-edit text-decoration-none"
                               style="padding:5px 14px; border-radius:20px; font-size:0.85rem;">
                                Edit
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4">Belum ada data booking.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection