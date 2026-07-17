<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang_masuks', function (Blueprint $table) {

            $table->id();

            $table->foreignId('produk_id')
                  ->constrained('produks')
                  ->cascadeOnDelete();


            $table->foreignId('supplier_id')
                  ->constrained('suppliers')
                  ->cascadeOnDelete();


            $table->integer('jumlah');

            $table->integer('barang_rusak')
                  ->default(0);


            $table->date('tanggal_masuk');


            $table->text('keterangan')
                  ->nullable();


            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('barang_masuks');
    }
};