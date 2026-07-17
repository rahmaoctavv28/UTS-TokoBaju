<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Transaksi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.pelanggan', function ($view) {
            $view->with('kategoris', Kategori::all());
        });
        View::composer('layouts.app', function ($view) {

            $notifikasi = [];

            // Stok Menipis
            $stokMenipis = Produk::where('stok', '<=', 5)->get();

            foreach ($stokMenipis as $produk) {
                $notifikasi[] =[
                    'icon' => 'bi-exclamation-triangle-fill text-danger',
                    'judul' => 'Stok Menipis',
                    'pesan' => $produk->nama_baju.' tersisa '.$produk->stok.' pcs',
                    'raw_time'  => $produk->updated_at,
                    'waktu' => $produk->updated_at->diffForHumans(),
                    'link' => route('produk.index')
                ];
            }

            // Pesanan Baru
            $pesananBaru = Pesanan::latest()->take(3)->get();

            foreach ($pesananBaru as $pesanan) {
                $notifikasi[] = [
                    'icon' => 'bi-cart-fill text-primary',
                    'judul' => 'Pesanan Baru',
                    'pesan' => $pesanan->kode_pesanan,
                    'raw_time'  => $pesanan->created_at,
                    'waktu' => $pesanan->created_at->diffForHumans(),
                    'link' => route('pesanan.index')
                ];
            }

            // Transaksi Baru
            $transaksiBaru = Transaksi::latest()->take(3)->get();

            foreach ($transaksiBaru as $trx) {
                $notifikasi[] = [
                    'icon' => 'bi-cash-coin text-success',
                    'judul' => 'Transaksi Berhasil',
                    'pesan' => $trx->kode_transaksi,
                    'raw_time'  => $trx->created_at,
                    'waktu' => $trx->created_at->diffForHumans(),
                    'link' => route('transaksi.laporan')
                ];
            }

            usort($notifikasi, function ($a, $b) {
                return $b['raw_time']->timestamp <=> $a['raw_time']->timestamp;
            });
            $view->with([
                'notifikasi' => $notifikasi,
                'jumlahNotifikasi' => count($notifikasi),
            ]);
        });
    }
}
