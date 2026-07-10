<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Supplier;
use App\Models\StokHistory;

class GudangController extends Controller
{
    public function index()
    {
        $totalProduk = Produk::count();
        $totalSupplier = Supplier::count();

        $barangMasuk = StokHistory::sum('stok_masuk');
        $barangKeluar = StokHistory::sum('stok_keluar');

        $produkMenipis = Produk::where('stok', '<=', 10)->get();


        $aktivitas = StokHistory::with('produk')
                        ->latest()
                        ->take(5)
                        ->get();

        return view('gudang.dashboardGudang', compact(
            'totalProduk',
            'totalSupplier',
            'barangMasuk',
            'barangKeluar',
            'produkMenipis',
            'aktivitas'
        ));
    }
}