<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $fillable = [
        'produk_id',
        'supplier_id',
        'jumlah',
        'barang_rusak',
        'tanggal_masuk',
        'keterangan'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}