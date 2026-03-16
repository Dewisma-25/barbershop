<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Proses Transaksi</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/users/create.css') }}">

</head>

<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="container-box">

        <div style="width: 23%;" class="title-badge">Proses Transaksi</div>

        @if($errors->any())
        <div class="alert alert-danger user-header">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="card mb-3 p-3">

            <p><strong>Customer :</strong> {{ $booking->customer->user->nama }}</p>

            <p><strong>Barber :</strong> {{ $booking->barber->nama }}</p>

            <p><strong>Services :</strong></p>

            <ul>
                @foreach($booking->details as $detail)
                <li>
                    {{ $detail->service->nama_service }} -
                    Rp {{ number_format($detail->harga) }}
                </li>
                @endforeach
            </ul>

        </div>

        <form method="POST" action="{{ route('transactions.store', $booking->id) }}">
            @csrf

            <div class="mb-4">
                <select id="metode_bayar" name="metode_bayar" class="form-select custom-input role-select">
                    <option value="" selected disabled>Pilih metode bayar</option>
                    <option value="tunai">tunai</option>
                    <option value="qris">qris</option>
                </select>
            </div>

            <div class="col-md-6">
                <button type="submit" class="btn btn-save w-100">Proses</button>
            </div>
    </div>

    </form>

</body>

</html>