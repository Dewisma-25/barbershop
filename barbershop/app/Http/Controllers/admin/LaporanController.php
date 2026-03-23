<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Html\CustomCssFile;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $tanggal = $request->tanggal ?? now()->toDateString();

        $data = Transaction::with('customer.user', 'details.service')->whereBetween('created_at', [
            $tanggal . ' 00:00:00',
            $tanggal . ' 23:59:59'
        ])->get();
        
        $totalCustomer = $data->count();


    $bulan = $request->bulan ?? now()->month;

    $dataIncome = Transaction::select(
            DB::raw('DAY(created_at) as hari'),
            DB::raw('SUM(total) as total_harian')
        )
        ->whereMonth('created_at', $bulan)
        ->groupBy('hari')
        ->orderBy('hari')
        ->get();

    // Siapkan array untuk chart
    $labels = $dataIncome->pluck('hari'); // tanggal (1,2,3,...)
    $totals = $dataIncome->pluck('total_harian'); // income per hari

    $total = $totals->sum();
        return view('admin.laporan.index', compact('data', 'totalCustomer', 'tanggal', 'bulan', 'labels', 'totals', 'dataIncome'));
    }


    public function print(Request $request)
    {
        
        $tanggal = $request->tanggal ?? now()->toDateString();

        $data = Transaction::with('customer.user', 'details.service')->whereBetween('created_at', [
            $tanggal . ' 00:00:00',
            $tanggal . ' 23:59:59'
        ])->get();
        

        $totalCustomer = $data->count();

        return view('admin.laporan.print', compact('data', 'totalCustomer', 'tanggal'));
    }




}
