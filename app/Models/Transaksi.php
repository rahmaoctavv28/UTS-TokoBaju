<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailTransaksiKasir;

class Transaksi extends Model
{
    protected $table = 'transaksis';
    protected $fillable = [
        'nama_kasir',
        'kode_transaksi',
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

    public function detailKasir()
    {
        return $this->hasMany(DetailTransaksiKasir::class);
    }
}