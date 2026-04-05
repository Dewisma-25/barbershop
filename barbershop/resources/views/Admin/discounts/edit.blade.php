@extends('layouts.appadmin')

@section('title', 'Admin Panel · Edit Discount')
@section('page-title', 'Edit Discount')

@section('content')

<div class="breadcrumb-panel">
    <i class="bi bi-house-door"></i> Panel /
    <a href="{{ route('discounts.index') }}" style="color:inherit; text-decoration:none;">Discount Data</a> /
    <span style="font-weight:500; color:black;">Edit Discount</span>
</div>

<div class="container-fluid p-0 mt-4">
    <div class="user-card" style="max-width: 560px;">
        <div class="user-header">
            <h5 class="mb-0">Edit Discount</h5>
        </div>

        <div class="p-4">

            @if($errors->any())
                <div class="alert alert-danger py-2 mb-3" style="font-size:0.85rem;">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('discounts.update', $discount->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama Diskon --}}
                <div class="mb-3">
                    <label class="form-label fw-500" style="font-size:0.9rem;">Nama Diskon</label>
                    <input type="text" name="nama" class="form-control" placeholder="contoh: Diskon Hari Senin"
                           value="{{ old('nama', $discount->nama) }}" required
                           style="border-radius:8px; padding:10px 14px; font-size:0.9rem;">
                </div>

                {{-- Persen --}}
                <div class="mb-3">
                    <label class="form-label fw-500" style="font-size:0.9rem;">Persen Diskon (%)</label>
                    <input type="number" name="persen" class="form-control" placeholder="contoh: 20"
                           value="{{ old('persen', $discount->persen) }}" min="1" max="100" step="0.01" required
                           style="border-radius:8px; padding:10px 14px; font-size:0.9rem;">
                </div>

                {{-- Tanggal Mulai --}}
                <div class="mb-3">
                    <label class="form-label fw-500" style="font-size:0.9rem;">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control"
                           value="{{ old('tanggal_mulai', \Carbon\Carbon::parse($discount->tanggal_mulai)->format('Y-m-d')) }}" required
                           style="border-radius:8px; padding:10px 14px; font-size:0.9rem;">
                </div>

                {{-- Tanggal Selesai --}}
                <div class="mb-3">
                    <label class="form-label fw-500" style="font-size:0.9rem;">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control"
                           value="{{ old('tanggal_selesai', \Carbon\Carbon::parse($discount->tanggal_selesai)->format('Y-m-d')) }}" required
                           style="border-radius:8px; padding:10px 14px; font-size:0.9rem;">
                </div>

                {{-- Status info --}}
                <div class="mb-4 p-3" style="background:#f8f9fa; border-radius:8px; font-size:0.85rem; color:#555;">
                    <i class="bi bi-info-circle me-1"></i>
                    Status diskon saat ini:
                    @if($discount->is_active)
                        <span class="badge bg-success ms-1">Active</span>
                    @else
                        <span class="badge bg-secondary ms-1">Inactive</span>
                    @endif
                    — Ubah status melalui tombol <strong>Activate/Deactivate</strong> di halaman list.
                </div>

                {{-- Buttons --}}
                <div class="d-flex gap-3">
                    <a href="{{ route('discounts.index') }}" class="btn flex-fill"
                       style="background:#dc3545; color:#fff; font-weight:500; height:44px; border-radius:8px; border:none; font-size:0.95rem; display:flex; align-items:center; justify-content:center;">
                        Cancel
                    </a>
                    <button type="submit" class="btn flex-fill"
                            style="background:#a7b27a; color:#fff; font-weight:500; height:44px; border-radius:8px; border:none; font-size:0.95rem;">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection