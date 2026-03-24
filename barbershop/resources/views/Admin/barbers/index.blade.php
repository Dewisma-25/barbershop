@extends('layouts.appadmin')

@section('title', 'Admin Panel · Data Users')

@section('page-title', 'Data User')

@push('styles')
    <link rel="stylesheet" href="{{asset('css/admin/users/index.css')}}">
@endpush

@section('content')

    <!-- panel atas breadcrumb -->
    <div class="breadcrumb-panel">
        <i style="color: black;" class="bi bi-house-door"></i> Panel / <span style="font-weight:500; color:black;">Barber data</span>
    </div>

    <!-- CARD UTAMA -->
    <div class="container-fluid p-0 mt-4">

        <div class="user-card">

            <div class="user-header">
                <h5>👤 Data Barber</h5>
                <a href="{{route('barbers.create')}}" class="btn-add">add account +</a>
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
                        <th>nama</th>
                        <th>No Telp</th>
                        <th>Alamat</th>
                        <th>Foto</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($barbers as $barber)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$barber->nama}}</td>
                        <td>{{$barber->no_hp}}</td>
                        <td>{{$barber->alamat}}</td>
                        <td><img width="80" height="110" src="{{asset('storage/'.$barber->image)}}" alt="Foto Barber"></td>
                        <td>
                            <div class="d-flex gap-2">
                                <a class="btn-edit text-decoration-none" href="{{route('barbers.edit', $barber->id)}}">Edit</a>

                                <form action="{{ route('barbers.destroy',$barber->id) }}" method="POST">
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