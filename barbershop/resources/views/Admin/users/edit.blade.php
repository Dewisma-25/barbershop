<x-app-layout>

<h2>Edit User</h2>

<form action="{{ route('users.update', $user->id) }}" method="POST">
@csrf
@method('PUT')

<div>
<label>Nama</label>
<input type="text" name="nama" value="{{ $user->nama }}" readonly>
</div>

<div>
<label>Username</label>
<input type="text" name="username" value="{{ $user->username }}">
</div>

<div>
<label>Email</label>
<input type="email" name="email" value="{{ $user->email }}">
</div>

<div>
<label>Password (kosongkan jika tidak diganti)</label>
<input type="password" name="password">
</div>

<div>
<label>Role</label>
<select name="role">
<option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
<option value="kasir" {{ $user->role == 'kasir' ? 'selected' : '' }}>Kasir</option>
<option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
</select>
</div>

<button type="submit">Update</button>

</form>

</x-app-layout>