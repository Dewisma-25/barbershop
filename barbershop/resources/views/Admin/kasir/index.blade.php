<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel · Data Customers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{asset('css/admin/users/index.css')}}">
</head>

<body>
    <div class="admin-wrapper">
        <!-- SIDEBAR KIRI (navbar posisi kiri) -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h3><i style="color: white;" class="bi bi-layout-text-sidebar-reverse"></i> Laporan<span style="font-weight:300; margin-left:4px;">admin</span></h3>
            </div>
            <div class="sidebar-nav">
                <div class="nav-item">
                    <i class="bi bi-file-earmark-bar-graph"></i></i> <span>Report</span>
                </div>
                <div class="nav-item">
                    <i class="bi bi-person"></i> <span>User data</span>
                </div>
                <div class="nav-item">
                    <i class="bi bi-receipt"></i> <span>Cashier Data</span>
                </div>
                <div class="nav-item">
                    <i class="bi bi-calendar-check"></i> <span>Booking Data</span>
                </div>
                <div class="nav-item">
                    <i class="bi bi-shop"></i> <span>Service Data</span>
                </div>
                <div class="nav-item">
                    <i class="bi bi-person-fill-lock"></i></i> <span>Data Customer</span>
                </div>
                <div class="nav-item">
                    <i class="bi bi-scissors"></i> <span>Data Barber</span>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class=" ms-4 btn btn-danger">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- MAIN CONTENT (persis laporan) -->
        <div class="main-content">
            <!-- panel atas breadcrumb -->
            <div class="breadcrumb-panel">
                <i style="color: black;" class="bi bi-house-door"></i> Panel / data Kasir <span style="font-weight:500; color:black;">User data</span>
            </div>
            <div class="page-title">Data Kasir</div>

            <!-- CARD UTAMA -->
            <div class="container mt-4">

                <div class="user-card">

                    <div class="user-header">
                        <h5>👤 Data Kasir</h5>
                    </div>

                    <table class="table table-borderless user-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id User</th>
                                <th>Alamat</th>
                                <th>No Telp</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($kasirs as $kasir)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$kasir->id_user}}</td>
                                <td>{{$kasir->alamat}}</td>
                                <td>{{$kasir->no_hp}}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a class="btn-edit text-decoration-none" href="{{route('kasir.edit', $kasir->id)}}">Edit</a>

                                        <form action="{{route('kasir.destroy', $kasir->id)}}" method="POST">
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
        </div>
    </div>

    <!-- opsional bootstrap js (untuk interaksi kecil tidak diperlukan)  -->
</body>

</html>