<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;

class StokHistory extends Model
{
    protected $table = 'stok_histories';

    protected $guarded = [];

    protected $fillable = [
        'produk_id',
        'stok_awal',
        'stok_masuk',
        'stok_keluar',
        'stok_akhir',
        'keterangan',
        'user_id'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}