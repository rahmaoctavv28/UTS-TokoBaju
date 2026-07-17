<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Supplier;
use App\Models\StokHistory;
use App\Models\Notification;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        $stok = StokHistory::with([
            'produk',
            'supplier'
        ])->latest()->get();

        return view('stok.index', compact('stok'));
    }

    public function create()
    {
        $produk = Produk::all();
        $supplier = Supplier::all();

        return view('stok.create', compact(
            'produk',
            'supplier'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id'      => 'required|exists:produks,id',
            'supplier_id'    => 'required|exists:suppliers,id',
            'stok_masuk'     => 'required|integer|min:1',
            'barang_rusak'   => 'nullable|integer|min:0',
            'tanggal_masuk'  => 'required|date',
            'keterangan'     => 'nullable|string|max:255',
        ]);

    $produk = Produk::findOrFail($request->produk_id);
    $stokAwal = $produk->stok;
    $stokMasuk = $request->stok_masuk;
    $barangRusak = $request->barang_rusak ?? 0;
    $stokKeluar = 0;
    $stokAkhir = $stokAwal + $stokMasuk - $barangRusak;
    StokHistory::create([
        'produk_id'      => $request->produk_id,
        'supplier_id'    => $request->supplier_id,
        'stok_awal'      => $stokAwal,
        'stok_masuk'     => $stokMasuk,
        'stok_keluar'    => $stokKeluar,
        'barang_rusak'   => $barangRusak,
        'stok_akhir'     => $stokAkhir,
        'tanggal_masuk'  => $request->tanggal_masuk,
        'keterangan'     => $request->keterangan,
        'user_id'        => auth()->id(),
    ]);

    $produk->update([
        'stok' => $stokAkhir
    ]);

    Notification::create([
        'judul' => 'Barang Masuk',
        'pesan' => 'Produk '.$produk->nama_baju.
                   ' bertambah '.$stokMasuk.' pcs',
        'dibaca' => false
    ]);

    if ($stokAkhir <= 10) {

        Notification::create([
            'judul' => 'Stok Menipis',
            'pesan' => 'Produk '.$produk->nama_baju.
                       ' tersisa '.$stokAkhir.
                       ' pcs. Segera lakukan pembelian.',
            'dibaca' => false
        ]);
    }

    return redirect('/stok')
        ->with('success', 'Data barang masuk berhasil ditambahkan');
        }

        
        public function edit($id)
    {
        $stok = StokHistory::findOrFail($id);

        $produk = Produk::all();

        $supplier = Supplier::all();

        return view('stok.edit', compact(
            'stok',
            'produk',
            'supplier'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'produk_id'    => 'required|exists:produks,id',
            'supplier_id'  => 'required|exists:suppliers,id',
            'stok_masuk'   => 'required|integer|min:1',
            'barang_rusak' => 'nullable|integer|min:0',
            'keterangan'   => 'nullable|string|max:255',
        ]);

        $stok = StokHistory::findOrFail($id);

        $produk = Produk::findOrFail($request->produk_id);

        $stokAwal = $stok->stok_awal;

        $stokKeluar = $stok->stok_keluar;

        $barangRusak = $request->barang_rusak ?? 0;

        $stokAkhir = $stokAwal
                    + $request->stok_masuk
                    - $barangRusak
                    - $stokKeluar;

        $stok->update([
            'produk_id'     => $request->produk_id,
            'supplier_id'   => $request->supplier_id,
            'stok_awal'     => $stokAwal,
            'stok_masuk'    => $request->stok_masuk,
            'barang_rusak'  => $barangRusak,
            'stok_keluar'   => $stokKeluar,
            'stok_akhir'    => $stokAkhir,
            'keterangan'    => $request->keterangan,
        ]);

        $produk->update([
            'stok' => $stokAkhir
        ]);

        Notification::create([
            'judul'  => 'Perubahan Stok',
            'pesan'  => 'Admin Gudang mengubah data stok produk '
                        .$produk->nama_baju,
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
            'pesan'  => 'Admin Gudang menghapus riwayat stok produk '
                        .$produk->nama_baju,
            'dibaca' => false
        ]);

        $stok->delete();

        return redirect('/stok')
            ->with('success', 'Data stok berhasil dihapus');
    }

    public function admin()
    {
        $stok = StokHistory::with([
            'produk',
            'supplier'
        ])->latest()->get();

        return view('stokadmin.index', compact('stok'));
    }
}