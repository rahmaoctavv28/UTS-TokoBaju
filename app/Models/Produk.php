<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks';

    protected $fillable = [
        'nama_baju',
        'harga',
        'ukuran',
        'stok',
        'kategori_id',
        'upload_foto',   
        'deskripsi'    
    ];


    public function kategori()
    {

        return $this->belongsTo(Kategori::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
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
    
    public function stok(){
        return $this->hasOne(Stok::class, 'produk_id');
        }

    public function stokTerakhir(){
        return $this->hasOne(StokHistory::class, 'produk_id')->latestOfMany();
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class);
    }

    public function detailPesanan(){
        return $this->hasMany(PesananDetail::class, 'produk_id');
    }
}