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
use App\Http\Controllers\KasirController;
use App\Http\Controllers\LaporanTransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfilController;

/* MODELS */
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Pesanan;

/*
| RESOURCE ROUTES*/

Route::get('/DashboardAdmin', [DashboardController::class, 'index'])
->name('dashboardadmin');

Route::get('/profil-admin',[ProfilController::class,'index'])
    ->name('profil.index');

Route::post('/profil-admin/update',[ProfilController::class,'update'])
    ->name('profil.update');

Route::resource('produk', ProdukController::class);

// Route::resource('pelanggan', PelangganController::class);

Route::prefix('pelanggan')->name('pelanggan.')->group(function () {

    // Shop
    Route::get('/', [PelangganController::class, 'index'])
        ->name('index');

    // Detail Produk
    Route::get('/produk/{id}', [PelangganController::class, 'detail'])
        ->name('detail');

    // Kategori
    Route::get('/kategori/{id}', [PelangganController::class, 'kategori'])
        ->name('kategori');

    // Keranjang
    Route::get('/cart', [PelangganController::class, 'cart'])
        ->name('cart');

    Route::post('/cart/add/{id}', [PelangganController::class, 'addToCart'])
        ->name('cart.add');

    Route::post('/cart/update/{id}', [PelangganController::class, 'updateCart'])
        ->name('cart.update');

    Route::delete('/cart/remove/{id}', [PelangganController::class, 'removeCart'])
        ->name('cart.remove');
    
    Route::post('/cart/increase/{id}', [PelangganController::class,'increaseQty'])
        ->name('cart.increase');

    Route::post('/cart/decrease/{id}', [PelangganController::class,'decreaseQty'])
        ->name('cart.decrease');

    // Checkout
    Route::get('/checkout', [PelangganController::class, 'checkout'])
        ->name('checkout');

    Route::post('/checkout', [PelangganController::class, 'processCheckout'])
        ->name('checkout.process');

    // Payment
    Route::get('/payment/{id}', [PelangganController::class, 'payment'])
        ->name('payment');

    Route::post('/payment/{pesanan}', [PelangganController::class, 'processPayment'])
        ->name('payment.process');

    Route::get('/pesanan/{id}', [PelangganController::class, 'detailPesanan'])
        ->name('pesanan.detail');

    // Pesanan
    Route::get('/pesanan', [PelangganController::class, 'pesanan'])
        ->name('pesanan');
    
        // Wishlist
    Route::get('/wishlist', [PelangganController::class,'wishlist'])
        ->name('wishlist');

    Route::post('/wishlist/add/{id}', [PelangganController::class,'addWishlist'])
        ->name('wishlist.add');

    Route::delete('/wishlist/remove/{id}', [PelangganController::class,'removeWishlist'])
        ->name('wishlist.remove');

    // Profile
    Route::get('/profile', [PelangganController::class, 'profile'])
        ->name('profile');
    
    Route::get('/search', [PelangganController::class, 'search'])
        ->name('search');
});

Route::resource('pesanan', PesananController::class);

Route::get('/pesanan/{id}/cetak',
    [PesananController::class,'cetak'])
    ->name('pesanan.cetak');

Route::put('/pesanan/{id}/status',
    [PesananController::class,'updateStatus'])
    ->name('pesanan.status');

Route::get('/pesanan/{id}/cetak',
    [PesananController::class,'cetak'])
    ->name('pesanan.cetak');

Route::resource('admin', AdminController::class);

Route::resource('kategori', KategoriController::class);

Route::resource('supplier', SupplierController::class);

Route::resource('transaksi', TransaksiController::class);

Route::get('/laporan-transaksi', [LaporanTransaksiController::class, 'index'])
    ->name('transaksi.laporan');

Route::prefix('laporan')->name('laporan.')->group(function () {

    Route::get('/dashboard', [LaporanController::class,'dashboard'])->name('dashboard');

    Route::get('/statistik', [LaporanController::class,'statistik'])->name('statistik');

    Route::get('/transaksi', [LaporanController::class,'transaksi'])->name('transaksi');

    Route::get('/transaksi/{id}', [LaporanController::class,'show'])->name('show');

    Route::get('/pesanan', [LaporanController::class,'pesanan'])->name('pesanan');

    Route::get('/pendapatan', [LaporanController::class,'pendapatan'])->name('pendapatan');

    Route::get('/grafik', [LaporanController::class,'grafik'])->name('grafik');

    Route::get('/cetak', [LaporanController::class,'cetak'])->name('cetak');

    Route::get('/preview', [LaporanController::class,'preview'])->name('preview');

    Route::get('/pdf',[LaporanController::class,'pdf'])->name('pdf');
});

Route::resource('stok', StokController::class);

// Route::resource('stokadmin', StokController::class);

Route::get('/stokadmin', [StokController::class, 'admin'])
    ->name('stok.admin');

Route::resource('detailpesanan', DetailPesananController::class);



/*
| DASHBOARD ADMIN GUDANG 
*/
Route::prefix('gudang')
     ->name('gudang.')
     ->group(function () {

    Route::get('/', [GudangController::class, 'index'])
         ->name('index');

    // Barang Masuk
    Route::get('/barang-masuk/create', [GudangController::class, 'createBarangMasuk'])
         ->name('barang-masuk.create');

    Route::post('/barang-masuk', [GudangController::class, 'storeBarangMasuk'])
         ->name('barang-masuk.store');

    // Data Stok
    Route::get('/stok', [GudangController::class, 'stokIndex'])
         ->name('stok.index');

});

/*
| LAPORAN STOK
*/

Route::get('/laporanstok', [LaporanStokController::class, 'index']);

/*
| DASHBOARD KASIR
*/
Route::resource('transaksi', TransaksiController::class);
Route::get('/kasir', [TransaksiController::class, 'create'])->name('kasir');

/*
| HOME
*/

Route::redirect('/', '/kasir');

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