@extends('layouts.appadmin')

@section('title', 'Admin Panel · Data Users')
@section('page-title', 'Data User')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/users/index.css') }}">
@endpush

@section('content')

<div class="breadcrumb-panel">
    <i style="color:black;" class="bi bi-house-door"></i> Panel /
    <span style="font-weight:500; color:black;">User data</span>
</div>

<div class="container-fluid p-0 mt-4">
    <div class="user-card">

        <div class="user-header">
            <h5>👤 User data</h5>
            <button class="btn-add" data-bs-toggle="modal" data-bs-target="#createModal">
                add account +
            </button>
        </div>

        @if(session('success'))
        <div class="user-header">
            <p class="alert alert-success">{{ session('success') }}</p>
        </div>
        @endif
        @if($errors->has('password_lama'))
        <div class="user-header">
            <p class="alert alert-danger">{{ $errors->first('password_lama') }}</p>
        </div>
        @endif


        <div class="table-wrapper">
            <table class="table table-borderless user-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Address</th>
                        <th>Phone number</th>
                        <!-- <th>History</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->kasir->alamat ?? "-"}}</td>
                        <td>{{ $user->kasir->no_hp ?? "-"}}</td>
                        <!-- <td>
                            update : {{ $user->updated_at->format('d/m/Y') }} <br>
                            dibuat : {{ $user->created_at->format('d/m/Y') }}
                        </td> -->
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn-edit"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal-{{ $user->id }}">
                                    Edit
                                </button>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-delete" type="submit"
                                        onclick="return confirm('Are you sure want to delete this data?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- MODAL EDIT per baris --}}
                    <div class="modal fade" id="editModal-{{ $user->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
                            <div class="modal-content bg-dark text-white border-0">
                                <div class="modal-header border-0 pb-0">
                                    <span style="background:#2b2b2b; color:#fff; padding:8px 14px; border-radius:12px; font-size:.88rem; font-weight:600;">
                                        Edit User
                                    </span>
                                </div>
                                <form method="POST" action="{{ route('users.update', $user->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body d-flex flex-column gap-3">
                                        <input type="email" name="email"
                                            class="form-control custom-input"
                                            placeholder="Email"
                                            value="{{ $user->email }}">
                                        <input type="password" name="password_lama"
                                            class="form-control custom-input"
                                            placeholder="Pasword lama">
                                        <input type="password" name="password_baru"
                                            class="form-control custom-input"
                                            placeholder="password _baru">

                                        <select name="role" class="form-select custom-input role-select">
                                            <option value="admin" {{ $user->role == 'admin'    ? 'selected' : '' }}>Admin</option>
                                            <option value="kasir" {{ $user->role == 'kasir'    ? 'selected' : '' }}>Kasir</option>
                                            <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                                        </select>
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

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL CREATE --}}
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
        <div class="modal-content bg-dark text-white border-0">
            <div class="modal-header border-0 pb-0">
                <span style="background:#2b2b2b; color:#fff; padding:8px 14px; border-radius:12px; font-size:.88rem; font-weight:600;">
                    Tambah User
                </span>
            </div>
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="modal-body d-flex flex-column gap-3">
                    <input type="text" name="nama" class="form-control custom-input" placeholder="Name">
                    <input type="text" name="username" class="form-control custom-input" placeholder="Username">
                    <input type="password" name="password" class="form-control custom-input" placeholder="Password">
                    <input type="password" name="password_confirmation" class="form-control custom-input" placeholder="Confirm password">
                    <input type="email" name="email" class="form-control custom-input" placeholder="Email">
                    <select id="create-role" name="role" class="form-select custom-input role-select">
                        <option value="" selected disabled>Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="kasir">Kasir</option>
                        <option value="customer">Customer</option>
                    </select>

                    <!-- {{-- Show/hide tergantung role --}} -->
                    <div id="customerFields" style="display: none;">
                        <div class="d-flex flex-column gap-3">
                            <input type="text" name="no_hp" class="form-control custom-input" placeholder="Phone number">
                            <input type="text" name="alamat" class="form-control custom-input" placeholder="Address">
                        </div>
                    </div>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('create-role');
        const customerFields = document.getElementById('customerFields');

        function toggleFields() {
            customerFields.style.display =
                roleSelect.value === 'admin' ? 'none' : 'block';
        }

        roleSelect.addEventListener('change', toggleFields);
    });
</script>
@push('scripts')
@endpush