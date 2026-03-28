<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use App\Models\Kasir;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //menampilkan data dari tab;e users
    public function index()
    {
        $users = User::with('kasir')
            ->whereIn('role', ['admin', 'kasir'])
            ->get();

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

        try {
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
        } elseif ($request->role == 'kasir') {

            Kasir::create([
                'id_user' => $user->id,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat
            ]);
        }

            return redirect()->route('users.index')->with('success', 'Users account successfully added');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cannot added new data, try again later');
        }
    }



    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    //edit dan update data users
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Update data user
        $user->update([
            'email' => $request->email,
            'role'  => $request->role,
        ]);

        // Update atau buat data kasir jika ada no_hp / alamat
        if ($request->filled('no_hp') || $request->filled('alamat')) {
            $user->kasir()->updateOrCreate(
                ['id_user' => $user->id],
                [
                    'no_hp'  => $request->no_hp,
                    'alamat' => $request->alamat,
                ]
            );
        }

        return redirect()->route('users.index')->with('success', 'Users account successfully updated');
    }

    public function changePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Old password incorrect']);
        }

        $user->password = Hash::make($request->password_baru);
        $user->save();

        return back()->with('success', 'Password successfully changed');
    }


    //menghapus data users dan data customers serta kasir
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->customer) {
            $user->customer->delete();
        }

        if ($user->kasir) {
            $user->kasir->delete();
        }

        $user->delete();

        return redirect()->back()->with('success', 'Account succsessfully deleted');
    }
}
