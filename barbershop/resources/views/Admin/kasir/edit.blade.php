
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/users/create.css') }}">

</head>

<body class="d-flex justify-content-center align-items-center vh-100">

<div class="container-box">

    <div class="title-badge">Edit Kasir</div>

    <form method="POST" action="{{route('kasir.update', $kasir->id)}}">
            @csrf
            @method('PUT')

        <div class="mb-3">
            <input type="text" name="no_hp" value="{{$kasir->no_hp}}" class="form-control custom-input" placeholder="Nomor Hp">
        </div>

        <div class="mb-3">
            <input type="text" name="alamat" value="{{$kasir->alamat}}" class="form-control custom-input" placeholder="Alamat">
        </div>

        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-cancel w-100" href="{{route('kasir.index')}}">Cancel</a>
            </div>

            <div class="col-md-6">
                <button type="submit" class="btn btn-save w-100">Save</button>
            </div>
        </div>

    </form>

</div>

</body>
</html>