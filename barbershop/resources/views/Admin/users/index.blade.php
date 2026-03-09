<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel · persis laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            background-color: #f4f6f9;
            /* warna latar netral seperti banyak admin panel */
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
        }

        /* wrapper flex untuk sidebar kiri + konten */
        .admin-wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* SIDEBAR KIRI — warna gelap seperti contoh (biru dongker/kehitaman) */
        .sidebar {
            width: 260px;
            background: #000000D9;
            color: #e0e7ff;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 24px 20px 16px;
            border-bottom: 1px solid #f5f5f5;
        }

        .sidebar-header h3 {
            font-size: 1.25rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin: 0;
            color: white;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sidebar-header h3 i {
            font-size: 1.6rem;
            color: white;
        }

        .sidebar-nav {
            flex: 1;
            padding: 20px 0 0 0;
        }

        .sidebar-nav .nav-item {
            padding: 12px 20px;
            margin: 4px 8px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 14px;
            color: #cdddec;
            font-weight: 450;
            transition: all 0.15s;
        }

        .sidebar-nav .nav-item i {
            font-size: 1.3rem;
            min-width: 28px;
            color: white;
        }

        .sidebar-nav .nav-item.active {
            color: white;
        }

        .sidebar-nav .nav-item.active i {
            color: white;
        }

        .sidebar-nav .nav-item:not(.active):hover {
            background: gray;
            color: white;
            cursor: pointer;
        }

        .sidebar-footer {
            padding: 20px 18px 30px;
            font-size: 0.8rem;
            border-top: 1px solid #f5f5f5;
            color: white;
        }

        /* KONTEN UTAMA */
        .main-content {
            flex: 1;
            overflow-y: auto;
            background-color: #f2f5fa;
            padding: 24px 28px;
        }

        /* judul ala laporan */
        .page-title {
            font-size: 2rem;
            font-weight: 600;
            color: #0b1e33;
            margin-bottom: 0.2rem;
        }

        .breadcrumb-panel {
            color: #5f6c80;
            font-size: 0.9rem;
            margin-bottom: 28px;
            letter-spacing: 0.3px;
        }

        .breadcrumb-panel i {
            margin-right: 6px;
            color: #3f6bb0;
        }

        /* card panel putih */
        .panel-card {
            border-radius: 20px;
            box-shadow: 0 10px 25px -8px rgba(0, 0, 0, 0.06);
            padding: 1.5rem 1.8rem;
            border: 1px solid #eef2f6;
        }

        .section-label {
            font-size: 1.3rem;
            font-weight: 600;
            color: #11223b;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-label i {
            font-size: 1.7rem;
            color: #2f5aa0;
        }

        /* tabel dengan gaya persis — tanpa border berlebihan, warna baris abu-abu */
        .table-user-data {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        .table-user-data th {
            text-align: left;
            padding: 15px 10px 8px 10px;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .table-user-data td {
            padding: 14px 10px;
            vertical-align: middle;
        }

        /* untuk grouping data nomor, username, email, history dan action */
        .user-badge {
            font-weight: 600;
            color: #0b2a4a;
        }

        .history-block {
            display: inline-flex;
            flex-direction: column;
            gap: 2px;
            font-size: 0.88rem;
        }

        .history-line {
            color: #304d6e;
        }

        .history-line i {
            font-size: 0.75rem;
            margin-right: 4px;
            color: #4f7eb3;
        }

        .action-btns {
            display: flex;
            gap: 12px;
            color: #4070b0;
            font-weight: 500;
        }

        .action-btns span {
            cursor: default;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #f0f4fe;
            padding: 5px 12px;
            border-radius: 30px;
            font-size: 0.85rem;
            color: #20487a;
            transition: 0.1s;
        }

        .action-btns span i {
            font-size: 0.9rem;
        }

        .action-btns .edit-btn {
            background: #e7efff;
            color: #1f5090;
        }

        .action-btns .delete-btn {
            background: #ffe8e8;
            color: #b13e3e;
        }

        /* tampilan untuk data service, customer, barber (sedikit menjorok) */
        .sub-table {
            margin-top: 30px;
        }


        /* supaya persis seperti "No / Username / Email / History / Action" di th */
        th i {
            margin-right: 6px;
            opacity: 0.6;
        }





        /* khusus table */
        .user-card {
            background: #8f7a73;
            border-radius: 12px;
            padding: 0;
            overflow: hidden;
        }

        .user-table thead th {
            background: #b79a87 !important;
            color: white !important;
        }

        .user-table tbody tr:nth-child(odd) td {
            background: #8f7a73;
            color: white;
        }

        .user-table tbody tr:nth-child(even) td {
            background: #b79a87;
            color: white;
        }

        .user-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding: 15px;
            color: white;
        }

        .btn-add {
            background: #bca49a;
            padding: 5px 14px;
            border-radius: 20px;
            text-decoration: none;
            color: white;
            font-size: 14px;
        }

        .user-table thead {
            background: #b79a87;
            color: white;
        }

        .user-table td {
            color: white;
            vertical-align: middle;
        }

        .history {
            font-size: 12px;
            opacity: 0.9;
        }

        .btn-edit {
            background: #d1b2a1;
            border: none;
            padding: 4px 12px;
            border-radius: 15px;
            color: white;
        }

        .btn-delete {
            background: #c9b3a7;
            border: none;
            padding: 4px 12px;
            border-radius: 15px;
            color: white;
        }

        .user-table td,
        .user-table th {
            border: none !important;
        }
    </style>
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
                <i style="color: black;" class="bi bi-house-door"></i> Panel / <span style="font-weight:500; color:black;">User data</span>
            </div>
            <div class="page-title">Data User</div>

            <!-- CARD UTAMA -->
            <div class="container mt-4">

                <div class="user-card">

                    <div class="user-header">
                        <h5>👤 Data User</h5>
                        <a href="{{route('users.create')}}" class="btn-add">add account +</a>
                    </div>

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
                                <td class="history">
                                    update : {{$user->updated_at->format('d/m/Y')}} <br>
                                    dibuat : {{$user->created_at->format('d/m/Y')}}
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a class="btn-edit text-decoration-none" href="{{route('users.edit', $user->id)}}">Edit</a>

                                        <form action="{{ route('users.destroy',$user->id) }}" method="POST">
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