@extends('layouts.appadmin')

@section('title', 'Admin Panel · Data Users')
@section('page-title', 'Data User')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/users/index.css') }}">
@endpush

@section('content')

<div class="breadcrumb-panel">
    <i style="color:black;" class="bi bi-house-door"></i> Panel /
    <span style="font-weight:500; color:black;">Barber data</span>
</div>

<div class="container-fluid p-0 mt-4">
    <div class="user-card">

        <div class="user-header">
            <h5>👤 Data Barber</h5>
            <button class="btn-add" data-bs-toggle="modal" data-bs-target="#createModal">
                add account +
            </button>
        </div>

        @if(session('success'))
            <div class="user-header">
                <p class="alert alert-success">{{ session('success') }}</p>
            </div>
        @endif

        <div class="table-wrapper">
            <table class="table table-borderless user-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No Telp</th>
                        <th>Alamat</th>
                        <th>Foto</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barbers as $barber)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $barber->nama }}</td>
                        <td>{{ $barber->no_hp }}</td>
                        <td>{{ $barber->alamat }}</td>
                        <td><img width="80" height="110" src="{{ asset('storage/'.$barber->image) }}" alt="Foto Barber"></td>
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn-edit"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal-{{ $barber->id }}">
                                    Edit
                                </button>
                                <form action="{{ route('barbers.destroy', $barber->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-delete" type="submit"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- MODAL EDIT per baris --}}
                    <div class="modal fade" id="editModal-{{ $barber->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
                            <div class="modal-content bg-dark text-white border-0">
                                <div class="modal-header border-0 pb-0">
                                    <span style="background:#2b2b2b; color:#fff; padding:8px 14px; border-radius:12px; font-size:.88rem; font-weight:600;">
                                        Edit Barber
                                    </span>
                                </div>
                                <form method="POST"
                                      enctype="multipart/form-data"
                                      action="{{ route('barbers.update', $barber->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body d-flex flex-column gap-3">
                                        <input type="text" name="nama"
                                               class="form-control custom-input"
                                               placeholder="Nama"
                                               value="{{ $barber->nama }}">
                                        <input type="text" name="no_hp"
                                               class="form-control custom-input"
                                               placeholder="No Telp"
                                               value="{{ $barber->no_hp }}">
                                        <input type="text" name="alamat"
                                               class="form-control custom-input"
                                               placeholder="Alamat"
                                               value="{{ $barber->alamat }}">
                                        <input type="file" name="image"
                                               class="form-control custom-input">
                                        {{-- Preview foto saat ini --}}
                                        <img src="{{ asset('storage/'.$barber->image) }}"
                                             width="60" height="80"
                                             style="border-radius:6px; object-fit:cover;">
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
                    Tambah Barber
                </span>
            </div>
            <form method="POST" enctype="multipart/form-data" action="{{ route('barbers.store') }}">
                @csrf
                <div class="modal-body d-flex flex-column gap-3">
                    <input type="text" name="nama"   class="form-control custom-input" placeholder="Nama">
                    <input type="text" name="no_hp"  class="form-control custom-input" placeholder="No Telp">
                    <input type="text" name="alamat" class="form-control custom-input" placeholder="Alamat">
                    <input type="file" name="image"  class="form-control custom-input">
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