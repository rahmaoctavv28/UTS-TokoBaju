<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'transaksis';
    protected $fillable = [

        'nama_produk',
        'harga',
        'stok',
        'pesanan_id',
        'kode_transaksi',
        'metode_pembayaran',
        'total_bayar',
        'uang_dibayar',
        'kembalian',
        'status',
        'tanggal_transaksi'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}