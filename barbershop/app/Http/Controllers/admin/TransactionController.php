<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Transaction;
use App\Models\Kasir;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with([
            'customer.user',
            'kasir.user',
            'booking',
            'barber'
        ])->latest()->get();

        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($bookingId)
    {
        $booking = Booking::with([
            'customer.user',
            'barber',
            'details.service'
        ])->findOrFail($bookingId);

        return view('admin.transactions.create', compact('booking'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $bookingId)
    {
        $request->validate([
            'metode_bayar' => 'required|in:tunai,qris',
        ]);

        $booking = Booking::with('details')->findOrFail($bookingId);

        if (Transaction::where('id_booking', $booking->id)->exists()) {
            return back()->with('error', 'Booking sudah memiliki transaksi');
        }

        $kasir = Auth::user()->kasir;

        if (!$kasir) {
            return back()->with('error', 'User ini bukan kasir');
        }

        $total = $booking->details->sum('harga');


        $transaction = Transaction::create([
            'id_customer' => $booking->id_customer,
            'id_barber' => $booking->id_barber,
            'id_kasir' => $kasir->id,
            'id_booking' => $booking->id,
            'tanggal' => now(),
            'metode_bayar' => $request->metode_bayar,
            'total' => $total,
            'status_layanan' => 'proses',
            'status_pembayaran' => 'pending'
        ]);

        foreach ($booking->details as $detail) {
            TransactionDetail::create([
                'id_transaction' => $transaction->id,
                'id_service' => $detail->id_service,
                'harga' => $detail->harga
            ]);
        }

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diproses');
    }


    public function complete($transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);

        $transaction->update([
            'status_layanan' => 'selesai',
            'status_pembayaran' => 'lunas'
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi diselesaikan');
    }
}
