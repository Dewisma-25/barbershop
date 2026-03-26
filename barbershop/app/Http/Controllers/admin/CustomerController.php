<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('user')->get();

        return view('admin.customers.index', compact('customers'));
    }




    public function edit($id)
    {
        $customer = Customer::with('user')->findOrFail($id);

        return view('admin.customers.edit', compact('customer'));
    }

    //edit dan update data users
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $data = [
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ];


        $customer->update($data);

        return redirect()->route('customers.index')->with('success', 'Customers account successfully edited.');
    }






public function destroy($id)
{
    $customer = Customer::findOrFail($id);

    $user = $customer->user;

    $customer->delete();

    if ($user) {
        $user->delete();
    }

    return redirect()->back();
}
}
