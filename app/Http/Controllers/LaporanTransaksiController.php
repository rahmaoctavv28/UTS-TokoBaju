<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;

class LaporanTransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with([
            'pesanan.pelanggan'
        ])->latest()->get();

        return view('laporantransaksi.index', compact('transaksi'));
    }
}