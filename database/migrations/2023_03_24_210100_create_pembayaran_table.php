<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tagihan_id')->index();
            $table->foreign('tagihan_id')->references('id')->on('tagihan');
            $table->unsignedBigInteger('wali_id')->index();
            $table->foreign('wali_id')->references('wali_id')->on('siswa');
            $table->enum('status_konfirmasi', ['belum', 'sudah']);
            $table->bigInteger('jumlah_dibayar');
            $table->dateTime('tanggal_bayar');
            $table->string('bukti_bayar')->nullable();
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
};
