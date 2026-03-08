<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //menampilkan data dari tab;e users
    public function index()
    {
        $users = User::with('customer')->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    //menambahkan data ke table users dan table customer jika role yang dipilih adalah customer
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required']
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        if ($request->role == 'customer') {
            Customer::create([
                'id_user' => $user->id,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat
            ]);
        }

        return redirect()->route('users.index');
    }



    //edit dan update data users
public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $data = [
        'username' => $request->username,
        'email' => $request->email,
        'role' => $request->role,
    ];

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect()->back();
}


    //menghapus data users dan data customers
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->customer) {
            $user->customer->delete();
        }

        $user->delete();

        return redirect()->back();
    }
}
