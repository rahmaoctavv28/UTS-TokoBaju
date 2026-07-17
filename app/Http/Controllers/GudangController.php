<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Produk;
use App\Models\Supplier;
use App\Models\StokHistory;
use App\Models\BarangMasuk;

class GudangController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard Gudang
    |--------------------------------------------------------------------------
    */
    public function index()
{
    $totalProduk = Produk::count();

    $totalSupplier = Supplier::count();

    $barangMasuk = BarangMasuk::count();

    $barangKeluar = StokHistory::sum('stok_keluar');

    $produkMenipis = Produk::where('stok', '<=', 5)->get();

    $aktivitas = StokHistory::with('produk')
                    ->latest()
                    ->take(10)
                    ->get();

    return view('gudang.dashboardGudang', compact(
        'totalProduk',
        'totalSupplier',
        'barangMasuk',
        'barangKeluar',
        'produkMenipis',
        'aktivitas'
    ));
}

        public function createBarangMasuk()
        {
            $produks = Produk::all();

            $suppliers = Supplier::all();

            return view(
                'gudang.barang-masuk.create',
                compact('produks', 'suppliers')
            );
        }

    /*
    |--------------------------------------------------------------------------
    | Simpan Barang Masuk
    |--------------------------------------------------------------------------
    */
    public function storeBarangMasuk(Request $request)
    {
        $request->validate([
            'produk_id'      => 'required',
            'supplier_id'    => 'required',
            'stok_masuk'     => 'required|integer|min:1',
            'tanggal_masuk'  => 'required',
        ]);

        DB::transaction(function () use ($request) {

            $produk = Produk::findOrFail($request->produk_id);

            $stokAwal = $produk->stok;

            $barangRusak = $request->barang_rusak ?? 0;

            $stokAkhir = $stokAwal + $request->stok_masuk - $barangRusak;

            BarangMasuk::create([
                'produk_id'      => $request->produk_id,
                'supplier_id'    => $request->supplier_id,
                'jumlah'         => $request->stok_masuk,
                'barang_rusak'   => $barangRusak,
                'tanggal_masuk'  => $request->tanggal_masuk,
                'keterangan'     => $request->keterangan,
            ]);

            $produk->stok = $stokAkhir;
            $produk->save();

            StokHistory::create([
                'produk_id'    => $produk->id,
                'stok_awal'    => $stokAwal,
                'stok_masuk'   => $request->stok_masuk,
                'stok_keluar'  => 0,
                'stok_akhir'   => $stokAkhir,
                'keterangan'   => $request->keterangan,
            ]);
        });

        return redirect()
            ->route('gudang.index')
            ->with('success', 'Barang masuk berhasil disimpan');
    }

    /*
    |--------------------------------------------------------------------------
    | Data Stok
    |--------------------------------------------------------------------------
    */
    public function stokIndex()
    {
        $stok = StokHistory::with('produk')
            ->latest()
            ->get();

        return view('gudang.stok.index', compact('stok'));
    }

    /*
    |--------------------------------------------------------------------------
    | Notifikasi Stok Menipis
    |--------------------------------------------------------------------------
    */
    public function notifikasi()
    {
        $produkMenipis = Produk::where('stok', '<=', 5)->get();

        return view('gudang.notifikasi', compact(
            'produkMenipis'
        ));
    }
}