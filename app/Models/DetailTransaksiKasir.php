<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksiKasir extends Model
{
    protected $table = 'detail_transaksi_kasir';

    protected $fillable = [
        'transaksi_id',
        'produk_id',
        'qty',
        'harga',
        'subtotal'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}