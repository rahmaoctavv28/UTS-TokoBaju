<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade');
            $table->string('kode_transaksi')->unique();
            $table->string('metode_pembayaran');
            $table->decimal('total_bayar', 15, 2);
            $table->decimal('uang_dibayar', 15, 2)->nullable();
            $table->decimal('kembalian', 15, 2)->nullable();
            $table->string('status')->default('lunas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
};