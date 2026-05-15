<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pesanan;
use App\Models\Pelanggan;

class Transaksi extends Model
{
    protected $table = 'transaksis';
    protected $fillable = [
        'pesanan_id',
        'kode_transaksi',
        'metode_pembayaran',
        'total_bayar',
        'uang_dibayar',
        'kembalian',
        'status',
        'tanggal_transaksi'
    ];
}