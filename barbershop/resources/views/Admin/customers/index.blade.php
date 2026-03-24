@extends('layouts.appadmin')

@section('title', 'Admin Panel · Data Customers')

@section('page-title', 'Data Customers')

@push('styles')
    <link rel="stylesheet" href="{{asset('css/admin/users/index.css')}}">
@endpush

@section('content')
    <div class="breadcrumb-panel">
        <i style="color: black;" class="bi bi-house-door"></i> Panel / <span style="font-weight:500; color:black;">User data</span>
    </div>
    <div class="page-title">Data Customers</div>

    <div class="container-fluid p-0 mt-4">
        <div class="user-card">
            <div class="user-header">
                <h5>👤 Data Customers</h5>
            </div>
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
                        <td>{{$loop->iteration}}</td>
                        <td>{{$customer->user->username ?? '-'}}</td>
                        <td>{{$customer->alamat}}</td>
                        <td>{{$customer->no_hp}}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a class="btn-edit text-decoration-none" href="{{route('customers.edit', $customer->id)}}">Edit</a>

                                <form action="{{route('customers.destroy', $customer->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-delete" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection