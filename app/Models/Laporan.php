<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaksi;

class Laporan extends Model
{
    protected $table = 'transaksis';

    protected $guarded = [];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}