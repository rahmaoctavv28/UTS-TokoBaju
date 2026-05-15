<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanans';

    protected $fillable = [
        'admin_id',
        'pelanggan_id',
        'nama_barang',
        'jumlah',
        'total_harga'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }


    public function produk()
    {
        return $this->belongsTo(Produk::class, 'nama_barang', 'nama_baju');
    }

   
    public function kurangiStok()
    {
        $produk = Produk::where('nama_baju', $this->nama_barang)->first();

        if (!$produk) {
            return false; 
        }

        if ($produk->stok < $this->jumlah) {
            return false; 
        }

        
        $produk->decrement('stok', $this->jumlah);
        
        return true;
    }
    public function transaksi()
    {
    return $this->hasOne(Transaksi::class);
    }
}