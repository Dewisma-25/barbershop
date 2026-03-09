<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit User</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            background: #f5f5f5;
        }

        /* container utama */
        .container-box {
            background: linear-gradient(180deg, #1c1c1c, #151515);
            padding: 40px;
            border-radius: 10px;
            width: 750px;
            position: relative;
        }

        /* badge title */
        .title-badge {
            width: 15%;
            margin-bottom: 3rem;
            background: #2b2b2b;
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 600;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        }

        /* input style */
        .custom-input {
            background: #e9e9e9;
            border: none;
            height: 45px;
            border-radius: 6px;
        }

        /* role dropdown */
        .role-select {
            width: 140px;
        }

        /* cancel button */
        .btn-cancel {
            background: #dc3545;
            color: white;
            font-weight: 600;
            border: none;
            height: 45px;
        }

        .btn-cancel:hover {
            background: #bb2d3b;
        }

        /* save button */
        .btn-save {
            background: #a7b27a;
            color: white;
            font-weight: 600;
            border: none;
            height: 45px;
        }

        .btn-save:hover {
            background: #8e9a63;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="container-box">

        <div style="width: 20%;" class="title-badge">Tambah User</div>

        <form method="POST" action="{{route('users.store')}}">
            @csrf

            <div class="mb-3">
                <input type="text" name="nama" class="form-control custom-input" placeholder="nama">
            </div>

            <div class="mb-3">
                <input type="text" name="username" class="form-control custom-input" placeholder="Username">
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control custom-input" placeholder="Password">
            </div>

            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control custom-input" placeholder="Konfirmasi Password">
            </div>

            <div class="mb-3">
                <input type="email" name="email" class="form-control custom-input" placeholder="Email">
            </div>

            <div class="mb-4">
                <select id="role" name="role" class="form-select custom-input role-select">
                    <option selected disabled>Role</option>
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                    <option value="customer">Customer</option>
                </select>
            </div>

            <div id="customerForm" style="display:none;">

                <div class="mb-3">
                    <label>No HP</label>
                    <input class="form-control custom-input" type="text" name="no_hp" placeholder="Nomor HP">
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <input class="form-control custom-input" type="text" name="alamat" placeholder="Alamat">
                </div>

            </div>



            <div class="row">
                <div class="col-md-6">
                    <a class="btn btn-cancel w-100" href="{{route('users.index')}}">Cancel</a>
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-save w-100">Save</button>
                </div>
            </div>

        </form>

    </div>

</body>

<script>
    document.getElementById('role').addEventListener('change', function() {

        let role = this.value
        let customerForm = document.getElementById('customerForm')

        if (role === 'customer') {
            customerForm.style.display = 'block'
        } else {
            customerForm.style.display = 'none'
        }

    });
</script>

</html>