<?php

namespace App\Http\Controllers;

use App\Models\Produk; 
use App\Models\Kategori;
use App\Models\StokHistory;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Produk::count(); 
        $totalStok = StokHistory::count();

        return view('dashboardadmin',[
            'totalProduk' => $totalProduk,
            'totalStok' => $totalStok,
            'totalPesanan'=>0,
            'totalPendapatan'=>0,
            'produkTerlaris'=>[],
            'stokMenipis'=>[]
        ]);
    }
}