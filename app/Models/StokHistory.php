<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokHistory extends Model
{
    protected $table = 'stok_histories';

    protected $fillable = [
        'produk_id',
        'supplier_id',
        'stok_awal',
        'stok_masuk',
        'stok_keluar',
        'barang_rusak',
        'stok_akhir',
        'tanggal_masuk',
        'keterangan',
        'user_id'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}