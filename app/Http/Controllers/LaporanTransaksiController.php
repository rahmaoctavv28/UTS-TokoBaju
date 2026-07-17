<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanTransaksiController extends Controller
{
   public function index(Request $request)
    {
        $query = Transaksi::with('pesanan');

        // Filter tanggal
        if ($request->filled('tanggal_awal')) {
            $query->whereDate('created_at', '>=', $request->tanggal_awal);
        }

        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('created_at', '<=', $request->tanggal_akhir);
        }

        // Filter jenis transaksi
        if ($request->filled('jenis')) {
            $query->where('jenis_transaksi', $request->jenis);
        }

        $transaksi = $query->latest()->get();

        $onlineHariIni = Transaksi::whereDate('created_at', Carbon::today())
            ->where('jenis_transaksi', 'Online')
            ->count();

        $kasirHariIni = Transaksi::whereDate('created_at', Carbon::today())
            ->where('jenis_transaksi', 'Kasir')
            ->count();

        $totalHariIni = Transaksi::whereDate('created_at', Carbon::today())
            ->count();

        $pendapatanHariIni = Transaksi::whereDate('created_at', Carbon::today())
            ->sum('total_bayar');

        return view('laporantransaksi.index', compact(
            'transaksi',
            'onlineHariIni',
            'kasirHariIni',
            'totalHariIni',
            'pendapatanHariIni'
        ));
    }
}