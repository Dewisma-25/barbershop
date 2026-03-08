<x-app-layout>

<h2>Data Users</h2>

<table border="1" cellpadding="10">
    <a href="/admin/crete"></a>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>No HP</th>
            <th>History</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->nama }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>

            <td>{{ optional($user->customer)->no_hp }}</td>


            <td>

                <!-- tombol edit -->
                <a href="{{ route('users.edit', $user->id) }}">Edit</a>

                <!-- tombol delete -->
                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>

</table>

</x-app-layout>