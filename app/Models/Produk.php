<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks';

    protected $fillable = [
        'nama_baju',
        'ukuran',
        'harga',
        'stok',
        'kategori_id'        
    ];


    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }


    public function pesananDetails()
    {
        return $this->hasMany(PesananDetail::class);
    }


    public function stokHistories()
    {
        return $this->hasMany(StokHistory::class);
    }


    public function kurangiStok($jumlah, $keterangan = 'Penjualan')
    {
        if ($this->stok < $jumlah) {
            return false;
        }

        $stok_awal = $this->stok;

        $this->decrement('stok', $jumlah);

        StokHistory::create([
            'produk_id'  => $this->id,
            'stok_awal'  => $stok_awal,
            'stok_masuk' => 0,
            'stok_keluar'=> $jumlah,
            'stok_akhir' => $this->stok,
            'keterangan' => $keterangan,
            'user_id'    => auth()->id() ?? null,
        ]);

        return true;
    }
}