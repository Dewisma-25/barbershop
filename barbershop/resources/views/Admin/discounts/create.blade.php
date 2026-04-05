@extends('layouts.appadmin')

@section('title', 'Admin Panel · Add Discount')
@section('page-title', 'Add Discount')

@section('content')

<div class="breadcrumb-panel">
    <i class="bi bi-house-door"></i> Panel /
    <a href="{{ route('discounts.index') }}" style="color:inherit; text-decoration:none;">Discount Data</a> /
    <span style="font-weight:500; color:black;">Add Discount</span>
</div>

<div class="container-fluid p-0 mt-4">
    <div class="user-card" style="max-width: 560px;">
        <div class="user-header">
            <h5 class="mb-0">Add New Discount</h5>
        </div>

        <div class="p-4">

            @if($errors->any())
                <div class="alert alert-danger py-2 mb-3" style="font-size:0.85rem;">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('discounts.store') }}" method="POST">
                @csrf

                {{-- Nama Diskon --}}
                <div class="mb-3">
                    <label class="form-label fw-500" style="font-size:0.9rem;">Discount name</label>
                    <input type="text" name="nama" class="form-control" placeholder="Example: Ramadhan holiday discount"
                           value="{{ old('nama') }}" required
                           style="border-radius:8px; padding:10px 14px; font-size:0.9rem;">
                </div>

                {{-- Persen --}}
                <div class="mb-3">
                    <label class="form-label fw-500" style="font-size:0.9rem;">Discount percent (%)</label>
                    <input type="number" name="persen" class="form-control" placeholder="example: 20"
                           value="{{ old('persen') }}" min="1" max="100" step="0.01" required
                           style="border-radius:8px; padding:10px 14px; font-size:0.9rem;">
                </div>

                {{-- Tanggal Mulai --}}
                <div class="mb-3">
                    <label class="form-label fw-500" style="font-size:0.9rem;">Discount start date</label>
                    <input type="date" name="tanggal_mulai" class="form-control"
                           value="{{ old('tanggal_mulai') }}" required
                           style="border-radius:8px; padding:10px 14px; font-size:0.9rem;">
                </div>

                {{-- Tanggal Selesai --}}
                <div class="mb-3">
                    <label class="form-label fw-500" style="font-size:0.9rem;">Discount end date</label>
                    <input type="date" name="tanggal_selesai" class="form-control"
                           value="{{ old('tanggal_selesai') }}" required
                           style="border-radius:8px; padding:10px 14px; font-size:0.9rem;">
                </div>

                {{-- Buttons --}}
                <div class="d-flex gap-3 mt-4">
                    <a href="{{ route('discounts.index') }}" class="btn flex-fill"
                       style="background:#dc3545; color:#fff; font-weight:500; height:44px; border-radius:8px; border:none; font-size:0.95rem; display:flex; align-items:center; justify-content:center;">
                        Cancel
                    </a>
                    <button type="submit" class="btn flex-fill"
                            style="background:#a7b27a; color:#fff; font-weight:500; height:44px; border-radius:8px; border:none; font-size:0.95rem;">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection