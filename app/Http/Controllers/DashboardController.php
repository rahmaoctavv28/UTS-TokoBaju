<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboardadmin',[
            'totalProduk'=>0,
            'totalStok'=>0,
            'totalPesanan'=>0,
            'totalPendapatan'=>0,
            'produkTerlaris'=>[],
            'stokMenipis'=>[]
        ]);
    }
}