<?php

namespace App\Http\Controllers;

use App\Models\Produk; 
use App\Models\Kategori;
use App\Models\Pesanan;
use App\Models\Transaksi;
use App\Models\StokHistory;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Card Dashboard
        $totalProduk = Produk::count();

        $totalStok = StokHistory::sum('stok_akhir');

        $totalPesanan = Pesanan::count();

        $jumlahPesanan = Pesanan::count();

        $jumlahTransaksi = Transaksi::count();

        $jumlahStokMenipis = Produk::where('stok', '<=', 5)->count();

        $totalPendapatan = Transaksi::sum('total_bayar');

        $stokMenipis = Produk::where('stok', '<=', 5)->get();

        // Produk terlaris
        $produkTerlaris = DB::table('detail_transaksi_kasir')
            ->join('produks', 'detail_transaksi_kasir.produk_id', '=', 'produks.id')
            ->select(
                'produks.nama_baju',
                DB::raw('SUM(detail_transaksi_kasir.qty) as total_terjual')
            )
            ->groupBy('produks.id', 'produks.nama_baju')
            ->orderByDesc('total_terjual')
            ->take(5)
            ->get();

        return view('dashboardadmin', compact(
            'totalProduk',
            'totalStok',
            'totalPesanan',
            'jumlahPesanan',
            'jumlahTransaksi',
            'jumlahStokMenipis',
            'totalPendapatan',
            'stokMenipis',
            'produkTerlaris'
        ));
    }
}