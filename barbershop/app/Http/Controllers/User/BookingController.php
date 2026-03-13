<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $services = DB::table('services')->where('is_active', 1)->get();
        $barbers  = DB::table('barbers')->get();

        return view('user.booking', compact('services', 'barbers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_service' => 'required|exists:services,id',
            'id_barber'  => 'nullable|exists:barbers,id',
            'tanggal'    => 'required|date|after_or_equal:today',
        ]);

        // ambil id_customer dari tabel customers berdasarkan user login
        $customer = DB::table('customers')
            ->where('id_user', Auth::id())
            ->first();

        if (!$customer) {
            return back()->with('error', 'Data customer tidak ditemukan.');
        }

        $service = DB::table('services')->find($request->id_service);

        // simpan ke tabel bookings
        $bookingId = DB::table('bookings')->insertGetId([
            'id_customer' => $customer->id,
            'id_barber'   => $request->id_barber ?? null,
            'tanggal'     => $request->tanggal,
            'status'      => 'menunggu',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);

        // simpan ke tabel booking_details
        DB::table('booking_details')->insert([
            'id_booking'  => $bookingId,
            'id_service'  => $service->id,
            'harga'       => $service->harga,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);

        return redirect()->route('user.booking')
            ->with('success', 'Booking berhasil! Silakan tunggu konfirmasi.');
    }
}