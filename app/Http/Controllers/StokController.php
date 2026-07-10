<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\StokHistory;
use App\Models\Notification;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        $stok = StokHistory::with('produk')->get();

        return view('stok.index', compact('stok'));
    }

    public function create()
    {
        $produk = Produk::all();

        return view('stok.create', compact('produk'));
    }

    public function store(Request $request)
    {
        $stok = StokHistory::create([
            'produk_id'   => $request->produk_id,
            'stok_awal'   => $request->stok_awal,
            'stok_masuk'  => $request->stok_masuk,
            'stok_keluar' => $request->stok_keluar,
            'stok_akhir'  => $request->stok_akhir,
            'keterangan'  => $request->keterangan,
            'user_id'     => null
        ]);

        $produk = Produk::find($request->produk_id);

        Notification::create([
            'judul'  => 'Penambahan Stok',
            'pesan'  => 'Admin Gudang menambahkan stok produk ' .
                        $produk->nama_baju .
                        ' sebanyak ' .
                        $request->stok_masuk .
                        ' pcs',
            'dibaca' => false
        ]);

        return redirect('/stok')
            ->with('success', 'Data stok berhasil ditambahkan');
    }

    public function edit($id)
    {
        $stok = StokHistory::findOrFail($id);

        $produk = Produk::all();

        return view('stok.edit', compact(
            'stok',
            'produk'
        ));
    }

    public function update(Request $request, $id)
    {
        $stok = StokHistory::findOrFail($id);

        $stok->update([
            'produk_id'   => $request->produk_id,
            'stok_awal'   => $request->stok_awal,
            'stok_masuk'  => $request->stok_masuk,
            'stok_keluar' => $request->stok_keluar,
            'stok_akhir'  => $request->stok_akhir,
            'keterangan'  => $request->keterangan
        ]);

        $produk = Produk::find($request->produk_id);

        Notification::create([
            'judul'  => 'Perubahan Stok',
            'pesan'  => 'Admin Gudang mengubah data stok produk ' .
                        $produk->nama_baju,
            'dibaca' => false
        ]);

        return redirect('/stok')
            ->with('success', 'Data stok berhasil diubah');
    }

    public function destroy($id)
    {
        $stok = StokHistory::findOrFail($id);

        $produk = Produk::find($stok->produk_id);

        Notification::create([
            'judul'  => 'Penghapusan Stok',
            'pesan'  => 'Admin Gudang menghapus riwayat stok produk ' .
                        $produk->nama_baju,
            'dibaca' => false
        ]);

        $stok->delete();

        return redirect('/stok')
            ->with('success', 'Data stok berhasil dihapus');
    }
}