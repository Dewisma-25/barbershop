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

<div class="container-fluid p-0 mt-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="user-card">
        <div class="user-header">
            <h5 class="mb-0">Customer Booking Data</h5>
        </div>

        <div class="table-wrapper">
        <table class="table table-borderless user-table mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Barber</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Transaction Process</th>
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
                        @if($booking->status === 'diterima')
                            <span class="badge bg-success">Accepted</span>
                        @elseif($booking->status === 'batal')
                            <span class="badge bg-danger">Rejected</span>
                        @elseif($booking->status === 'selesai')
                            <span class="badge btn-edit">Done</span>
                        @else
                            <span class="badge bg-warning text-dark">Pending</span>
                        @endif
                    </td>
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
                            {{-- UBAH: Jadi button modal --}}
                            <button type="button" class="btn-edit" data-bs-toggle="modal" data-bs-target="#editModal{{ $booking->id }}">
                                Edit
                            </button>
                        </div>
                    </td>
                    <td>
                        @if($booking->status === 'diterima' && !$booking->transaction_id)
                            {{-- UBAH: Jadi button modal --}}
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#transactionModal{{ $booking->id }}">
                                Transaction Process
                            </button>
                        @elseif($booking->transaction_id)
                            <button style="background-color: #2D2D2D;" disabled class="btn btn-secondary btn-sm">Transaction created</button>
                        @else
                            <button style="background-color: #2D2D2D;" disabled class="btn btn-secondary btn-sm">Transaction done</button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4">No booking's yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

</div>

{{-- ═══════════════════════ MODALS ═══════════════════════ --}}
@foreach($bookings as $booking)

{{-- EDIT MODAL --}}
<div class="modal fade" id="editModal{{ $booking->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
        <div class="modal-content bg-dark text-white border-0">
            <div class="modal-header border-0 pb-0 justify-content-center">
                <span style="background:#2b2b2b; color:#fff; padding:8px 14px; border-radius:12px; font-size:.88rem; font-weight:600;">
                    <i class="bi bi-pencil-square me-1"></i> Edit Data Booking
                </span>
            </div>
            
            <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="modal-body px-4 py-3">
                    {{-- Error messages --}}
                    @if($errors->any() && old('booking_id') == $booking->id)
                        <div class="alert alert-danger py-2 mb-3" style="font-size:0.82rem;">
                            @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                        </div>
                    @endif

                    {{-- Date --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-secondary border-0"><i class="bi bi-calendar3 text-white"></i></span>
                        <input type="date" name="tanggal_booking"
                               class="form-control"
                               value="{{ \Carbon\Carbon::parse($booking->tanggal)->format('Y-m-d') }}"
                               required>
                    </div>

                    {{-- Hour --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-secondary border-0"><i class="bi bi-clock text-white"></i></span>
                        <select name="jam_booking" class="form-select" required>
                            <option value="" disabled>-- Select Hour --</option>
                            @foreach(['10:00','11:00','13:00','14:00','15:00','16:00','19:00'] as $jam)
                                <option value="{{ $jam }}"
                                    {{ \Carbon\Carbon::parse($booking->tanggal)->format('H:i') === $jam ? 'selected' : '' }}>
                                    {{ $jam }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Barber --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-secondary border-0"><i class="bi bi-person-badge text-white"></i></span>
                        <select name="id_barber" class="form-select">
                            <option value="">-- Pilih Barber --</option>
                            @foreach($barbers as $barber)
                                <option value="{{ $barber->id }}"
                                    {{ $booking->id_barber == $barber->id ? 'selected' : '' }}>
                                    {{ $barber->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-secondary border-0"><i class="bi bi-flag text-white"></i></span>
                        <select name="status" class="form-select">
                            <option value="menunggu" {{ $booking->status === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="diterima" {{ $booking->status === 'diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="batal"    {{ $booking->status === 'batal'    ? 'selected' : '' }}>Batal</option>
                        </select>
                    </div>
                    
                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                </div>
                
                <div class="modal-footer border-0 d-flex gap-2 px-4 pb-4 pt-0">
                    <button type="button" class="btn flex-fill" data-bs-dismiss="modal"
                            style="background:#dc3545; color:#fff; font-weight:600; height:45px;">
                        Cancel
                    </button>
                    <button type="submit" class="btn flex-fill"
                            style="background:#a7b27a; color:#fff; font-weight:600; height:45px;">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- TRANSACTION MODAL --}}
@if($booking->status === 'diterima' && !$booking->transaction_id)
<div class="modal fade" id="transactionModal{{ $booking->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:360px;">
        <div class="modal-content bg-dark text-white border-0">
            <div class="modal-header border-0 pb-0 justify-content-center">
                <span style="background:#2b2b2b; color:#fff; padding:8px 14px; border-radius:12px; font-size:.88rem; font-weight:600;">
                    <i class="bi bi-credit-card-2-front me-1"></i> Payment
                </span>
            </div>
            
            <form method="POST" action="{{ route('transactions.store', $booking->id) }}">
                @csrf
                
                <div class="modal-body px-4 py-3">
                    {{-- Error messages --}}
                    @if($errors->any() && old('transaction_booking_id') == $booking->id)
                        <div class="alert alert-danger py-2 mb-3" style="font-size:0.82rem;">
                            @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                        </div>
                    @endif

                    @if(session('error') && session('booking_id') == $booking->id)
                        <div class="alert alert-danger py-2 mb-3" style="font-size:0.82rem;">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Payment Method --}}
                    <div class="mb-3">
                        <select name="metode_bayar" class="form-select" required>
                            <option value="" disabled selected>Pilih Metode Bayar</option>
                            <option value="tunai">Tunai</option>
                            <option value="qris">Qris</option>
                        </select>
                    </div>

                    {{-- Info Customer --}}
                    <div style="background:#3a3a3a; border-radius:8px; padding:14px 16px; font-size:0.86rem; color:#e0e0e0; display:flex; flex-direction:column; gap:8px;">
                        <div><strong style="color:#fff;">Username :</strong> {{ $booking->username }}</div>
                        <div><strong style="color:#fff;">Barber :</strong> {{ $booking->nama_barber ?? '-' }}</div>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <strong style="color:#fff;">Time</strong>
                            <span style="background:#1a1a1a; border:1px solid #555; border-radius:20px; padding:1px 10px; font-size:0.78rem; color:#fff;">
                                {{ \Carbon\Carbon::parse($booking->tanggal)->format('H:i') }}
                            </span>
                        </div>
                        <div>
                            <strong style="color:#fff;">Services :</strong>
                            <ul style="list-style:none; margin:4px 0 0; padding:0; font-size:0.82rem; color:#bbb;">
                                @foreach(DB::table('booking_details')
                                    ->join('services', 'booking_details.id_service', '=', 'services.id')
                                    ->where('booking_details.id_booking', $booking->id)
                                    ->select('services.nama_service', 'booking_details.harga')
                                    ->get() as $detail)
                                <li style="padding:1px 0;">• {{ $detail->nama_service }} — Rp {{ number_format($detail->harga) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    {{-- Total --}}
                    <div class="mt-3" style="background:#fff; border-radius:6px; padding:11px 14px; color:#1a1a1a; font-weight:700; font-size:0.92rem;">
                        Total : Rp {{ number_format($booking->total_harga ?? 0) }}
                    </div>
                    
                    <input type="hidden" name="transaction_booking_id" value="{{ $booking->id }}">
                </div>
                
                <div class="modal-footer border-0 d-flex gap-2 px-4 pb-4 pt-0">
                    <button type="button" class="btn flex-fill" data-bs-dismiss="modal"
                            style="background:#dc3545; color:#fff; font-weight:600; height:45px;">
                        Cancel
                    </button>
                    <button type="submit" class="btn flex-fill"
                            style="background:#a7b27a; color:#fff; font-weight:600; height:45px;">
                        Proses
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@endforeach

@endsection