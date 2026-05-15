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

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}
