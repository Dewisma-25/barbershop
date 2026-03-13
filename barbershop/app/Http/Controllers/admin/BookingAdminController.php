<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingAdminController extends Controller
{
    public function index()
    {
        $bookings = DB::table('bookings')
            ->join('customers', 'bookings.id_customer', '=', 'customers.id')
            ->join('users', 'customers.id_user', '=', 'users.id')
            ->leftJoin('barbers', 'bookings.id_barber', '=', 'barbers.id')
            ->select(
                'bookings.id',
                'bookings.tanggal',
                'bookings.status',
                'users.username',
                'users.email',
                'barbers.nama as nama_barber'
            )
            ->orderBy('bookings.tanggal', 'desc')
            ->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function accept($id)
    {
        DB::table('bookings')->where('id', $id)->update([
            'status'     => 'diterima',
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking diterima.');
    }

    public function reject($id)
    {
        DB::table('bookings')->where('id', $id)->update([
            'status'     => 'batal',
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking ditolak.');
    }
}