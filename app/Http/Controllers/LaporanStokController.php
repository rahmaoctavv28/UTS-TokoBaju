<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class LaporanStokController extends Controller
{
    public function index()
    {
        $produk = Produk::all();

        return view('laporanstok.index', compact('produk'));
    }
}