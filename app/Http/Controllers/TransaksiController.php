<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Pesanan;
use App\Models\Pelanggan;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();

        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $pesanan = Pesanan::all();
        $pelanggan = Pelanggan::all();

        return view('transaksi.create',
        compact('pesanan', 'pelanggan'));
    }

    public function store(Request $request)
    {
        $total_bayar = $request->total_bayar;
        $uang_dibayar = $request->uang_dibayar; 
        $kembalian = $uang_dibayar - $total_bayar;
        Transaksi::create([
            'pesanan_id' => $request->pesanan_id,
            'kode_transaksi' => $request->kode_transaksi,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total_bayar' => $total_bayar,
            'uang_dibayar' => $uang_dibayar,
            'kembalian' => $kembalian,
            'status' => $request->status,
            'tanggal_transaksi' => $request->tanggal_transaksi,
        ]);

        return redirect('/transaksi');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $pesanan = Pesanan::all();
        return view('transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $total_bayar = $request->total_bayar;
        $uang_dibayar = $request->uang_dibayar;
        $kembalian = $uang_dibayar - $total_bayar;
        $transaksi->update([
            'pesanan_id' => $request->pesanan_id,
            'metode_pembayaran' => $request->metode_pembayaran,
            'kode_transaksi' => $request->kode_transaksi,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total_bayar' => $total_bayar,
            'uang_dibayar' => $uang_dibayar,
            'kembalian' => $kembalian,
            'status' => $request->status,
            'tanggal_transaksi' => $request->tanggal_transaksi,
        ]);

        return redirect('/transaksi');
    }

    public function destroy($id)
    {
        //$transaksi = Transaksi::findOrFail($id);

        $transaksi->delete();

        return redirect('/transaksi');
    }
}