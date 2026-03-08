<x-app-layout>

<h2>Tambah User</h2>

@if ($errors->any())
<div>
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif
<form action="{{ route('users.store') }}" method="POST">
    @csrf

    <div>
        <label>Nama</label>
        <input type="text" name="nama">
    </div>

    <div>
        <label>Username</label>
        <input type="text" name="username">
    </div>

    <div>
        <label>Email</label>
        <input type="email" name="email">
    </div>

    <div>
        <label>Password</label>
        <input type="password" name="password">
    </div>

    <div>
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation">
    </div>

    <div>
        <label>Role</label>
        <select name="role" id="role">
            <option value="">-- pilih role --</option>
            <option value="admin">Admin</option>
            <option value="kasir">Kasir</option>
            <option value="customer">Customer</option>
        </select>
    </div>

    <div id="customerForm" style="display:none;">
        <div>
            <label>No HP</label>
            <input type="text" name="no_hp">
        </div>

        <div>
            <label>Alamat</label>
            <textarea name="alamat"></textarea>
        </div>
    </div>

    <button type="submit">Simpan</button>

</form>

<script>
document.getElementById('role').addEventListener('change', function(){

    let role = this.value
    let customerForm = document.getElementById('customerForm')

    if(role === 'customer'){
        customerForm.style.display = 'block'
    }else{
        customerForm.style.display = 'none'
    }

});
</script>

</x-app-layout>