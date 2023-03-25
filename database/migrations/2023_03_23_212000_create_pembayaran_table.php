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
            // $table->unsignedBigInteger('user_id')->index();
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->string('nisn', 10)->index();
            // $table->foreign('nisn')->references('nisn')->on('siswa');
            // $table->date('tgl_dibayar');
            // $table->unsignedBigInteger('biaya_id')->index();
            // $table->foreign('biaya_id')->references('id')->on('biaya');
            // $table->bigInteger('jumlah_bayar');
            // $table->enum('status', ['baru', 'angsur', 'lunas']);
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
