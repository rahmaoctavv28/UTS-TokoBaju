<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    protected $table = 'pelanggans';

    protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'no_hp'
    ];

    public function pesanan(){
        return $this->hasMany(Pesanan::class);
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class);
    }

    public function pesanans(){
        return $this->hasMany(Pesanan::class, 'pelanggan_id');
    }
}
