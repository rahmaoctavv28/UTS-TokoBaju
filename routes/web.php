<?php

use Illuminate\Support\Facades\Route;

/* CONTROLLERS */
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\DetailPesananController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\LaporanStokController;

/* MODELS */
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Pesanan;

/*
| RESOURCE ROUTES*/

Route::get('/DashboardAdmin', [DashboardController::class, 'index'])
->name('dashboardadmin');

Route::resource('produk', ProdukController::class);

Route::resource('pelanggan', PelangganController::class);

Route::resource('pesanan', PesananController::class);

Route::resource('admin', AdminController::class);

Route::resource('kategori', KategoriController::class);

Route::resource('supplier', SupplierController::class);

Route::resource('transaksi', TransaksiController::class);

Route::resource('stok', StokController::class);

Route::resource('detailpesanan', DetailPesananController::class);

/*
| DASHBOARD ADMIN GUDANG
*/

Route::get('/gudang', [GudangController::class, 'index']);

/*
| LAPORAN STOK
*/

Route::get('/laporanstok', [LaporanStokController::class, 'index']);

/*
| HOME
*/

Route::get('/', function () {

    $produk = Produk::all();

    $pelanggan = Pelanggan::all();

    $pesanan = Pesanan::all();

    return view('home', compact(
        'produk',
        'pelanggan',
        'pesanan'
    ));

});