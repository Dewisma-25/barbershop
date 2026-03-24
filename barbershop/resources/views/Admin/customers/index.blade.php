@extends('layouts.appadmin')

@section('title', 'Admin Panel · Data Customers')
@section('page-title', 'Data Customers')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/users/index.css') }}">
@endpush

@section('content')

<div class="breadcrumb-panel">
    <i style="color:black;" class="bi bi-house-door"></i> Panel / <span style="font-weight:500; color:black;">User data</span>
</div>
<div class="page-title">Data Customers</div>

<div class="container-fluid p-0 mt-4">
    <div class="user-card">
        <div class="user-header">
            <h5>👤 Data Customers</h5>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show m-3">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <table class="table table-borderless user-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Alamat</th>
                    <th>No Telp</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $customer->user->username ?? '-' }}</td>
                    <td>{{ $customer->alamat }}</td>
                    <td>{{ $customer->no_hp }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <button class="btn-edit"
                                    data-id="{{ $customer->id }}"
                                    data-nohp="{{ $customer->no_hp }}"
                                    data-alamat="{{ $customer->alamat }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                Edit
                            </button>
                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-delete" type="submit"
                                        onclick="return confirm('Yakin hapus customer ini?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL EDIT --}}
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
        <div class="modal-content bg-dark text-white border-0">
            <div class="modal-header border-0 pb-0">
                <span class="badge" style="background:#2b2b2b; color:#fff; padding:8px 14px; border-radius:12px; font-size:0.88rem; font-weight:600;">
                    Edit Customer
                </span>
            </div>
            <form id="edit-form" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body d-flex flex-column gap-3">
                    <input type="text" name="no_hp" id="modal-nohp"
                           class="form-control" placeholder="Nomor HP" required>
                    <input type="text" name="alamat" id="modal-alamat"
                           class="form-control" placeholder="Alamat">
                </div>
                <div class="modal-footer border-0 d-flex gap-2">
                    <button type="button" class="btn flex-fill"
                            style="background:#dc3545; color:#fff; font-weight:600; height:45px;"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn flex-fill"
                            style="background:#a7b27a; color:#fff; font-weight:600; height:45px;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.querySelectorAll('[data-bs-target="#editModal"]').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('modal-nohp').value   = this.dataset.nohp;
            document.getElementById('modal-alamat').value = this.dataset.alamat;
            document.getElementById('edit-form').action   = '/admin/customers/' + this.dataset.id;
        });
    });
</script>
@endpush