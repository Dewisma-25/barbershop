<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminreportController extends Controller
{
    public function index()
    {
        $bulanIni  = Carbon::now()->month;
        $tahunIni  = Carbon::now()->year;

        // ===== LAPORAN CUSTOMER BULAN INI =====
        // Customer yang transaksi bulan ini
        $customerBulanIni = DB::table('transactions')
            ->whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->distinct('id_customer')
            ->pluck('id_customer');

        // Customer repeat = punya lebih dari 1 transaksi bulan ini
        $customerRepeat = DB::table('transactions')
            ->whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->select('id_customer', DB::raw('COUNT(*) as total'))
            ->groupBy('id_customer')
            ->having('total', '>', 1)
            ->count();

        // Customer baru = hanya 1 transaksi bulan ini
        $customerBaru = DB::table('transactions')
            ->whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->select('id_customer', DB::raw('COUNT(*) as total'))
            ->groupBy('id_customer')
            ->having('total', '=', 1)
            ->count();

        $totalCustomer = $customerRepeat + $customerBaru;

        // ===== PESANAN HARI INI =====
        $pesananSelesai = DB::table('transactions')
            ->whereDate('tanggal', Carbon::today())
            ->where('status_layanan', 'selesai')
            ->count();

        $pesananTidakSelesai = DB::table('transactions')
            ->whereDate('tanggal', Carbon::today())
            ->where('status_layanan', 'proses')
            ->count();

        // ===== INCOME =====
        $incomeBulanIni = DB::table('transactions')
            ->whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->where('status_pembayaran', 'lunas')
            ->sum('total');

        $incomeTahunIni = DB::table('transactions')
            ->whereYear('tanggal', $tahunIni)
            ->where('status_pembayaran', 'lunas')
            ->sum('total');

        // ===== CHART — data per bulan tahun ini =====
        $chartData = DB::table('transactions')
            ->whereYear('tanggal', $tahunIni)
            ->select(
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('COUNT(DISTINCT id_customer) as total_customer')
            )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->keyBy('bulan');

        $bulanNama = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

        $chartLabels  = [];
        $chartSelesai = [];
        $chartBaru    = [];
        $chartRepeat  = [];

        for ($i = 1; $i <= 12; $i++) {
            $chartLabels[] = $bulanNama[$i - 1] . ' ' . $tahunIni;

            // pesanan selesai per bulan
            $chartSelesai[] = DB::table('transactions')
                ->whereYear('tanggal', $tahunIni)
                ->whereMonth('tanggal', $i)
                ->where('status_layanan', 'selesai')
                ->count();

            // customer repeat per bulan
            $chartRepeat[] = DB::table('transactions')
                ->whereYear('tanggal', $tahunIni)
                ->whereMonth('tanggal', $i)
                ->select('id_customer', DB::raw('COUNT(*) as total'))
                ->groupBy('id_customer')
                ->having('total', '>', 1)
                ->get()->count();

            // customer baru per bulan
            $chartBaru[] = DB::table('transactions')
                ->whereYear('tanggal', $tahunIni)
                ->whereMonth('tanggal', $i)
                ->select('id_customer', DB::raw('COUNT(*) as total'))
                ->groupBy('id_customer')
                ->having('total', '=', 1)
                ->get()->count();
        }

        return view('admin.admindashboard', compact(
            'customerRepeat',
            'customerBaru',
            'totalCustomer',
            'pesananSelesai',
            'pesananTidakSelesai',
            'incomeBulanIni',
            'incomeTahunIni',
            'chartLabels',
            'chartSelesai',
            'chartBaru',
            'chartRepeat'
        ));
    }
}