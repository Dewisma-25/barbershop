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

        html, body {
            height: 100%;
            background-color: #f4f6f9; /* warna latar netral seperti banyak admin panel */
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
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
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
            box-shadow: 0 10px 25px -8px rgba(0,0,0,0.06);
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
            color: #3e4e64;
            border-bottom: 2px solid #cfddee;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .table-user-data td {
            padding: 14px 10px;
            vertical-align: middle;
            border-bottom: 1px solid #e6edf5;
            color: #1f2b3a;
        }

        /* baris abu-abu selang-seling seperti gambar */
        .table-user-data tbody tr:nth-child(even) {
            background-color: #f8fafd;   /* abu sangat terang */
        }
        .table-user-data tbody tr:nth-child(odd) {
            background-color: white;
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
                    <i class="bi bi-speedometer2"></i> <span>Panel / User data</span>
                </div>
                <div class="nav-item">
                    <i class="bi bi-people"></i> <span>Data User</span>
                </div>
                <div class="nav-item">
                    <i class="bi bi-scissors"></i> <span>Data barber</span>
                </div>
                <div class="nav-item">
                    <i class="bi bi-calendar-check"></i> <span>Data service</span>
                </div>
                <div class="nav-item">
                    <i class="bi bi-person-badge"></i> <span>Data customer</span>
                </div>
                <div class="nav-item">
                    <i class="bi bi-file-text"></i> <span>History</span>
                </div>
                <div class="nav-item">
                    <i class="bi bi-gear"></i> <span>Pengaturan</span>
                </div>
            </div>
            <div class="sidebar-footer">
                <i class="bi bi-dot"></i> online · v.2.31
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
            <div class="panel-card mt-4">
                <!-- tabel pertama (Data User) -->
                <table class="table-user-data">
                    <thead>
                        <tr>
                            <th><i class="bi bi-hash"></i> No</th>
                            <th><i class="bi bi-person-circle"></i> Username</th>
                            <th><i class="bi bi-envelope"></i> Email</th>
                            <th><i class="bi bi-clock-history"></i> History</th>
                            <th><i class="bi bi-lightning"></i> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- baris 1: farellaiyo persis -->
                        <tr>
                            <td class="user-badge">1</td>
                            <td><span style="font-weight:600;">farellaiyo</span></td>
                            <td>suprandi08@gmail.com</td>
                            <td>
                                <div class="history-block">
                                    <span class="history-line"><i class="bi bi-arrow-repeat"></i> update : 02 Mar 2026</span>
                                    <span class="history-line"><i class="bi bi-calendar-plus"></i> diubuat : 05 Mar 2026</span>
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <span class="edit-btn"><i class="bi bi-pencil-square"></i> edit</span>
                                    <span class="delete-btn"><i class="bi bi-trash3"></i> delete</span>
                                </div>
                            </td>
                        </tr>
                        <!-- data service masuk dalam tabel? sesuai deskripsi: setelah action, ada data service sebagai row terpisah. 
                             TAPI di contoh tertulis "Data service" seolah kategori baru. Kita ikuti persis urutan:
                             setelah baris pertama ada baris kosong? Tapi biar sama, kita letakkan sebagai bagian tbody dengan baris kedua mewakili "Data service"  -->
                        <tr>
                            <td class="user-badge">2</td>
                            <td><span style="font-weight:600;">wismanliyo</span></td>
                            <td>kusuma09@gmail.com</td>
                            <td>
                                <div class="history-block">
                                    <span class="history-line"><i class="bi bi-arrow-repeat"></i> update : 21 Jun 2026</span>
                                    <span class="history-line"><i class="bi bi-calendar-plus"></i> diubuat : 23 Jun 2026</span>
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <span class="edit-btn"><i class="bi bi-pencil-square"></i> edit</span>
                                    <span class="delete-btn"><i class="bi bi-trash3"></i> delete</span>
                                </div>
                            </td>
                        </tr>
                        <!-- Data customer (donilliyo) baris 3 -->
                        <tr>
                            <td class="user-badge">3</td>
                            <td><span style="font-weight:600;">donilliyo</span></td>
                            <td>putra08@gmail.com</td>
                            <td>
                                <div class="history-block">
                                    <span class="history-line"><i class="bi bi-arrow-repeat"></i> update : 01 Jul 2025</span>
                                    <span class="history-line"><i class="bi bi-calendar-plus"></i> diubuat : 07 Jul 2026</span>
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <span class="edit-btn"><i class="bi bi-pencil-square"></i> edit</span>
                                    <span class="delete-btn"><i class="bi bi-trash3"></i> delete</span>
                                </div>
                            </td>
                        </tr>
                        <!-- Data barber (wigunalliyo) baris 4 -->
                        <tr>
                            <td class="user-badge">4</td>
                            <td><span style="font-weight:600;">wigunalliyo</span></td>
                            <td> — </td>   <!-- tidak ada email di baris terakhir pada teks, tapi agar rapi, kita isi kosong atau strip -->
                            <td>
                                <div class="history-block">
                                    <span class="history-line"><i class="bi bi-arrow-repeat"></i> update : 01 Jul 2025</span>
                                    <span class="history-line"><i class="bi bi-calendar-plus"></i> diubuat : 07 Jul 2026</span>
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <span class="edit-btn"><i class="bi bi-pencil-square"></i> edit</span>
                                    <span class="delete-btn"><i class="bi bi-trash3"></i> delete</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- opsional bootstrap js (untuk interaksi kecil tidak diperlukan)  -->
</body>
</html>