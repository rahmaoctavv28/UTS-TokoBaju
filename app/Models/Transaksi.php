<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';
    protected $fillable = [

        'pesanan_id',
        'kode_transaksi',
        'jenis_transaksi',
        'metode_pembayaran',
        'total_bayar',
        'uang_dibayar',
        'kembalian',
        'status'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function details()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}