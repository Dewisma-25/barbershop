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

            <td>
                Di Buat Pada: {{$user->created_at->format('d/m/Y')}} <br>
                Di Update pada: {{$user->updated_at->format('d/m/Y')}}
            </td>


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