@extends('layouts.appadmin')

@section('title', 'Admin Panel · Discount Data')
@section('page-title', 'Discount Data')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/users/index.css') }}">
@endpush

@section('content')

<div class="breadcrumb-panel">
    <i class="bi bi-house-door"></i> Panel / <span style="font-weight:500; color:black;">Discount Data</span>
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
        <div class="user-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Discount Data</h5>
            <a href="{{ route('discounts.create') }}" class="btn-add"
                <i class="bi bi-plus-lg me-1"></i> Add Discount +
            </a>
        </div>

        <div class="table-wrapper">
            <table class="table table-borderless user-table mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Discount name</th>
                        <th>Percent</th>
                        <th>Start</th>
                        <th>Over</th>
                        <th>Created by</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($discounts as $i => $discount)
                    <tr>
                        <td>{{ $i + 1 }}.</td>
                        <td>{{ $discount->nama }}</td>
                        <td><strong>{{ $discount->persen }}%</strong></td>
                        <td>{{ \Carbon\Carbon::parse($discount->tanggal_mulai)->translatedFormat('l, d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($discount->tanggal_selesai)->translatedFormat('l, d/m/Y') }}</td>
                        <td>{{ $discount->creator->nama ?? '-' }}</td>
                        <td>
                            @if($discount->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2 flex-wrap">
                                {{-- Edit --}}
                                <a href="{{ route('discounts.edit', $discount->id) }}" class="btn-edit text-decoration-none">
                                    Edit
                                </a>

                                {{-- Toggle Active/Inactive --}}
                                <form action="{{ route('discounts.toggle', $discount->id) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('PATCH')
                                    @if($discount->is_active)
                                        <button type="submit" class="btn-delete" style="border-radius:8px;">
                                            Inactive
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-success" style="border-radius:8px;">
                                            Activate
                                        </button>
                                    @endif
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">No discounts yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection