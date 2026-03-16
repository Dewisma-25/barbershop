@extends('layouts.appadmin')

@section('title', 'Admin Panel · Data Services')

@section('page-title', 'Data Services')

@push('styles')
    <link rel="stylesheet" href="{{asset('css/admin/users/index.css')}}">
@endpush

@section('content')

    <!-- panel atas breadcrumb -->
    <div class="breadcrumb-panel">
        <i style="color: black;" class="bi bi-house-door"></i> Panel / <span style="font-weight:500; color:black;">Service data</span>
    </div>
    <div class="page-title">Data Services</div>

    <!-- CARD UTAMA -->
    <div class="container mt-4">

        <div class="user-card">

            <div class="user-header">
                <h5>⚙️ Data Services</h5>
                <a href="{{route('services.create')}}" class="btn-add">add Services +</a>
            </div>

        @if(session('success'))
        <div class="user-header">
            <p class="alert alert-success">{{session('success')}}</p>
        </div>
        @endif

            <table class="table table-borderless user-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Service</th>
                        <th>Harga</th>
                        <th>Durasi</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$service->nama_service}}</td>
                        <td>{{number_format($service->harga, 0, ',' , '.')}}</td>
                        <td>{{$service->estimasi_menit}} menit</td>
                        <td>
                            @if($service->is_active == 1)
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a class="btn-edit text-decoration-none" href="{{route('services.edit', $service->id)}}">Edit</a>

                                <form action="{{ route('services.destroy',$service->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-delete" type="submit" onclick="return confirm('Yakin ingin menonaktifkan service ini?')">Inaktif</button>
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