@extends('layouts.appadmin')

@section('title', 'Admin Panel · Discount Data')
@section('page-title', 'Discount Data')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/users/index.css') }}">
<style>
    /* ── Discount Modal Styles ─────────────────────────────── */
    .discount-modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.55);
        backdrop-filter: blur(2px);
        z-index: 1050;
        align-items: center;
        justify-content: center;
    }
    .discount-modal-overlay.show {
        display: flex;
    }
    .discount-modal {
        background: #1e1e1e;
        border-radius: 14px;
        width: 100%;
        max-width: 420px;
        padding: 0;
        box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        animation: modalSlideIn 0.22s ease;
        overflow: hidden;
    }
    @keyframes modalSlideIn {
        from { opacity: 0; transform: translateY(-18px) scale(0.97); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }
    .discount-modal-header {
        padding: 18px 22px 14px;
        border-bottom: 1px solid #2e2e2e;
    }
    .discount-modal-header h6 {
        margin: 0;
        color: #f0f0f0;
        font-size: 0.95rem;
        font-weight: 600;
        letter-spacing: 0.01em;
    }
    .discount-modal-body {
        padding: 20px 22px 22px;
    }
    .discount-modal-body .form-label {
        color: #c8c8c8;
        font-size: 0.82rem;
        font-weight: 500;
        margin-bottom: 5px;
    }
    .discount-modal-body .form-control,
    .discount-modal-body .form-select {
        background: #fff;
        border: 1.5px solid #e0e0e0;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 0.9rem;
        color: #222;
        transition: border-color 0.2s;
    }
    .discount-modal-body .form-control:focus,
    .discount-modal-body .form-select:focus {
        border-color: #a7b27a;
        box-shadow: 0 0 0 3px rgba(167,178,122,0.18);
        outline: none;
    }
    .discount-modal-body .form-control::placeholder {
        color: #aaa;
    }
    .discount-modal-footer {
        display: flex;
        gap: 12px;
        padding: 0 22px 22px;
    }
    .btn-modal-cancel {
        flex: 1;
        background: #dc3545;
        color: #fff;
        font-weight: 600;
        font-size: 0.92rem;
        height: 44px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: background 0.18s;
    }
    .btn-modal-cancel:hover { background: #c0303e; }
    .btn-modal-save {
        flex: 1;
        background: #a7b27a;
        color: #fff;
        font-weight: 600;
        font-size: 0.92rem;
        height: 44px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: background 0.18s;
    }
    .btn-modal-save:hover { background: #8f9a63; }
    .discount-modal-body .alert-danger {
        font-size: 0.82rem;
        padding: 8px 12px;
        border-radius: 7px;
        background: #3a1a1a;
        border: 1px solid #7a2020;
        color: #f88;
    }
    .status-info-box {
        background: #2a2a2a;
        border-radius: 8px;
        padding: 10px 13px;
        font-size: 0.82rem;
        color: #aaa;
    }
    /* input[type=date] icon color fix */
    .discount-modal-body input[type="date"]::-webkit-calendar-picker-indicator {
        cursor: pointer;
        opacity: 0.7;
    }
</style>
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

    {{-- Show validation errors from store/update in a flash-style alert --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="user-card">
        <div class="user-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Discount Data</h5>
            {{-- Trigger Add Modal --}}
            <button type="button" class="btn-add" onclick="openAddModal()">
                <i class="bi bi-plus-lg me-1"></i> Add Discount
            </button>
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
                                {{-- Trigger Edit Modal --}}
                                <button type="button" class="btn-edit"
                                    onclick="openEditModal(
                                        {{ $discount->id }},
                                        '{{ addslashes($discount->nama) }}',
                                        '{{ $discount->persen }}',
                                        '{{ \Carbon\Carbon::parse($discount->tanggal_mulai)->format('Y-m-d') }}',
                                        '{{ \Carbon\Carbon::parse($discount->tanggal_selesai)->format('Y-m-d') }}',
                                        {{ $discount->is_active ? 'true' : 'false' }}
                                    )">
                                    Edit
                                </button>

                                {{-- Toggle Active/Inactive --}}
                                <form id="status-form-{{ $discount->id }}" action="{{ route('discounts.toggle', $discount->id) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('PATCH')
                                    @if($discount->is_active)
                                        <button onclick="confirmStatus('{{ $discount->id }}')" type="button" class="btn-delete" style="border-radius:8px;">
                                            Inactive
                                        </button>
                                    @else
                                        <button onclick="confirmStatus('{{ $discount->id }}')" type="button" class="btn btn-sm btn-success" style="border-radius:8px;">
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

{{-- ══════════════════════════════════════════════
     ADD DISCOUNT MODAL
══════════════════════════════════════════════ --}}
<div class="discount-modal-overlay" id="addDiscountModal" onclick="handleOverlayClick(event, 'addDiscountModal')">
    <div class="discount-modal">
        <div class="discount-modal-header">
            <h6><i class="bi bi-tag-fill me-2" style="color:#a7b27a;"></i>Add New Discount</h6>
        </div>
        <form action="{{ route('discounts.store') }}" method="POST" id="addDiscountForm">
            @csrf
            <div class="discount-modal-body">

                <div class="mb-3">
                    <label class="form-label">Discount Name</label>
                    <input type="text" name="nama" class="form-control"
                           placeholder="Example: Ramadhan holiday discount"
                           value="{{ old('nama') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Discount Percent (%)</label>
                    <input type="number" name="persen" class="form-control"
                           placeholder="Example: 20"
                           value="{{ old('persen') }}" min="1" max="100" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="tanggal_mulai" class="form-control"
                           value="{{ old('tanggal_mulai') }}" required>
                </div>

                <div class="mb-0">
                    <label class="form-label">End Date</label>
                    <input type="date" name="tanggal_selesai" class="form-control"
                           value="{{ old('tanggal_selesai') }}" required>
                </div>

            </div>
            <div class="discount-modal-footer">
                <button type="button" class="btn-modal-cancel" onclick="closeModal('addDiscountModal')">Cancel</button>
                <button type="submit" class="btn-modal-save">Save</button>
            </div>
        </form>
    </div>
</div>

{{-- ══════════════════════════════════════════════
     EDIT DISCOUNT MODAL
══════════════════════════════════════════════ --}}
@foreach ($discounts as $discount)
<div class="discount-modal-overlay" id="editDiscountModal" onclick="handleOverlayClick(event, 'editDiscountModal')">
    <div class="discount-modal">
        <div class="discount-modal-header">
            <h6><i class="bi bi-pencil-fill me-2" style="color:#a7b27a;"></i>Edit Discount</h6>
        </div>
        <form action="{{ route('discounts.update', $discount->id) }}" id="editDiscountForm" method="POST">
            @csrf
            @method('PUT')
            <div class="discount-modal-body">

                <div class="mb-3">
                    <label class="form-label">Discount Name</label>
                    <input type="text" name="nama" id="edit_nama" class="form-control"
                           placeholder="Discount name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Discount Percent (%)</label>
                    <input type="number" name="persen" id="edit_persen" class="form-control"
                           placeholder="Example: 20" min="1" max="100" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="tanggal_mulai" id="edit_tanggal_mulai" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">End Date</label>
                    <input type="date" name="tanggal_selesai" id="edit_tanggal_selesai" class="form-control" required>
                </div>

                <div class="status-info-box">
                    <i class="bi bi-info-circle me-1"></i>
                    Current status:
                    <span id="edit_status_badge"></span>
                    — Change status via <strong>Activate/Deactivate</strong> button on the list.
                </div>

            </div>
            <div class="discount-modal-footer">
                <button type="button" class="btn-modal-cancel" onclick="closeModal('editDiscountModal')">Cancel</button>
                <button type="submit" class="btn-modal-save">Update</button>
            </div>
        </form>
    </div>
</div>
@endforeach

@push('scripts')
<script>
    // ── Helpers ───────────────────────────────────────────────
    function openModal(id) {
        document.getElementById(id).classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    function closeModal(id) {
        document.getElementById(id).classList.remove('show');
        document.body.style.overflow = '';
    }
    function handleOverlayClick(e, id) {
        if (e.target === document.getElementById(id)) closeModal(id);
    }
    // Close on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal('addDiscountModal');
            closeModal('editDiscountModal');
        }
    });

    // ── Add Modal ─────────────────────────────────────────────
    function openAddModal() {
        openModal('addDiscountModal');
    }

    // ── Edit Modal ────────────────────────────────────────────
    function openEditModal(id, nama, persen, tanggalMulai, tanggalSelesai, isActive) {
        // Set form action dynamically
        const baseUrl = '{{ url("admin/discounts") }}';
        document.getElementById('editDiscountForm').action = baseUrl + '/' + id;

        // Populate fields
        document.getElementById('edit_nama').value          = nama;
        document.getElementById('edit_persen').value        = persen;
        document.getElementById('edit_tanggal_mulai').value  = tanggalMulai;
        document.getElementById('edit_tanggal_selesai').value = tanggalSelesai;

        // Status badge
        const badge = document.getElementById('edit_status_badge');
        if (isActive) {
            badge.innerHTML = '<span class="badge bg-success ms-1">Active</span>';
        } else {
            badge.innerHTML = '<span class="badge bg-secondary ms-1">Inactive</span>';
        }

        openModal('editDiscountModal');
    }

    // ── Re-open modal with old input on validation error ──────
    @if($errors->any() && old('_method') === 'PUT')
        // Re-open edit modal if it was a PUT (update) with errors
        // You may enhance this by passing back the discount id in the session
    @elseif($errors->any())
        // Re-open add modal if there were store errors
        document.addEventListener('DOMContentLoaded', function() {
            openAddModal();
        });
    @endif
</script>
@endpush

@endsection