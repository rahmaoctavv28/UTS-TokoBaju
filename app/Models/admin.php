<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    protected $table = 'admins';

    protected $fillable = [
        'nama',
        'email',
        'password'
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}
