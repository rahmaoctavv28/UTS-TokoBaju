<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Pesanan;
use App\Models\Pelanggan;

class TransaksiController extends Controller
{
    public function index()
{
    return view('kasir');
}

    public function create()
    {
        $pesanan = Pesanan::all();
        $pelanggan = Pelanggan::all();
        $kode_transaksi = 'TRX' . date('YmdHis');
        return view('kasir.create', compact('pesanan', 'pelanggan', 'kode_transaksi'));
    }

    public function store(Request $request)
    {
        $total_bayar = $request->total_bayar;
        $uang_dibayar = $request->uang_dibayar; 
        $kembalian = $uang_dibayar - $total_bayar;
        Transaksi::create([
            'pesanan_id' => $request->pesanan_id,
            'nama_kasir' => auth()->user()->name,
            'kode_transaksi' => $request->kode_transaksi,
            'produk_id' => $request->produk_id,
            'nama_produk' => $request->nama_produk,
            'jumlah_produk' => $request->jumlah_produk,
            'harga_satuan' => $request->harga_satuan,
            'subtotal' => $request->jumlah_produk * $request->harga_satuan,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total_bayar' => $total_bayar,
            'uang_dibayar' => $uang_dibayar,
            'kembalian' => $request->uang_dibayar
                ? $request->uang_dibayar - ($request->jumlah_produk * $request->harga_satuan)
                : null,
            'status' => $request->status,
            'tanggal_transaksi' => $request->tanggal_transaksi,
        ]);

        return redirect()->route('transaksi.index')
                        ->with('success', 'Transaksi berhasil ditambahkan.');
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
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->delete();

        return redirect('/transaksi');
    }
}