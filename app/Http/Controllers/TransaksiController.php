<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $nama_kasir = "Kasir";

        $kode_transaksi = 'TRX' . date('YmdHis');

        $produks = Produk::with('stokTerakhir')->get();

        return view('kasir.create', compact(
            'nama_kasir',
            'kode_transaksi',
            'produks'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|array|min:1',
            'qty' => 'required|array|min:1',
            'metode_pembayaran' => 'required'
        ]);

        DB::beginTransaction();
        try{
            $total = 0;
            foreach($request->produk_id as $i => $produkId){
                $produk = Produk::findOrFail($produkId);
                $total += $produk->harga * $request->qty[$i];
            }
            $transaksi = Transaksi::create([
                'nama_kasir' => $request->nama_kasir,
                'kode_transaksi' => $request->kode_transaksi,
                'jenis_transaksi' => 'Kasir',
                'metode_pembayaran' => $request->metode_pembayaran,
                'total_bayar' => $total,
                'uang_dibayar' => $request->uang_dibayar ?? $total,
                'kembalian' => $request->uang_dibayar
                    ? $request->uang_dibayar - $total
                    : 0,
                'status' => 'Selesai',
                'tanggal_transaksi' => now()
            ]);
            foreach($request->produk_id as $i => $produkId){
                $produk = Produk::findOrFail($produkId);

                DetailTransaksi::create([
                    'transaksi_id'=>$transaksi->id,
                    'produk_id'=>$produk->id,
                    'qty'=>$request->qty[$i],
                    'harga'=>$produk->harga,
                    'subtotal'=>$produk->harga * $request->qty[$i]
                ]);
                // Kurangi stok
                if ($produk->stokTerakhir) {
                    $produk->stokTerakhir->decrement(
                        'stok_akhir',
                        $request->qty[$i]
                    );
                }
            }
            DB::commit();
            return redirect()
                ->route('transaksi.index')
                ->with('success','✅Transaksi berhasil disimpan.');

        }catch(\Exception $e){

            DB::rollBack();
            return back()->with(
                'error',
                $e->getMessage()
            );
        }
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