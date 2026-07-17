<?php

namespace App\Http\Controllers;

use App\Models\StokHistory;

class LaporanStokController extends Controller
{
    public function index()
    {
        $stok = StokHistory::with(['produk','supplier'])
                    ->latest()
                    ->get();

        return view('laporanstok.index', compact('stok'));
    }
}