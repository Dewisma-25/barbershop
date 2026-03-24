@extends('layouts.appadmin')

@section('title', 'Admin Panel · Data Users')

@section('page-title', 'Data User')

@push('styles')
<link rel="stylesheet" href="{{asset('css/admin/users/index.css')}}">
@endpush

@section('content')

<!-- panel atas breadcrumb -->
<div class="breadcrumb-panel">
    <i style="color: black;" class="bi bi-house-door"></i> Panel / <span style="font-weight:500; color:black;">User data</span>
</div>

<!-- CARD UTAMA -->
<div class="container-fluid p-0 mt-4">


    <div class="user-card">

        <div class="user-header">
            <h5>👤 Data User</h5>
            <a href="{{route('users.create')}}" class="btn-add">add account +</a>
        </div>
        @if(session('success'))
        <div class="user-header">
            <p class="alert alert-success">{{session('success')}}</p>
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
                    <th>History</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role}}</td>
                    <td>
                        update : {{$user->updated_at->format('d/m/Y')}} <br>
                        dibuat : {{$user->created_at->format('d/m/Y')}}
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a class="btn-edit text-decoration-none" href="{{route('users.edit', $user->id)}}">Edit</a>

                            <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-delete" type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    </div>

</div>

@endsection