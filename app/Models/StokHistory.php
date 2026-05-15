<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokHistory extends Model
{
    protected $table = 'stok_histories';

    protected $fillable = [
        'produk_id',
        'stok_awal',
        'stok_masuk',
        'stok_keluar',
        'stok_akhir',
        'keterangan',
        'user_id'
    ];

    // Relasi ke Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}