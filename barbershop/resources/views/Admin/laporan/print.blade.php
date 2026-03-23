<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Print Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: Arial;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        p {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .garis {
            width: 60%;
            height: 5px;
            background: #000000;
            color: black;
        }

        th {
            background: #eee;
        }

        @media print {
            body {
                margin: 0;
            }
        }
    </style>
</head>

<body class="pt-5">
    <div class="d-flex flex-column text-center align-items-center mb-1">
        <h1 class="m-0"><strong>Barbershop Report</strong></h1>
        <p class="m-0"><strong>Laporan Booking Harian</strong></p>
    </div>
    <center>
        <div class="garis mb-5">
        </div>

    </center>



    <p class="mb-1">Tanggal: {{ \Carbon\Carbon::parse($tanggal)->format('d/m/Y') }}</p>
    <p>Total Customer: {{ $totalCustomer }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Customer</th>
                <th>Service</th>
                <th>Jam</th>
            </tr>
        </thead>
        <tbody>
            @if($data->isEmpty())
            <tr>
                <td colspan="4">Tidak ada data</td>
            </tr>
            @endif
            @foreach($data as $i => $item)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $item->customer->user->nama ?? '-' }}</td>
                <td>
                    @forelse($item->details as $d)
                    {{ $d->service->nama_service ?? '-' }}<br>
                    @empty
                    -
                    @endforelse
                </td>
                <td>{{ $item->created_at->format('H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>

</body>

</html>