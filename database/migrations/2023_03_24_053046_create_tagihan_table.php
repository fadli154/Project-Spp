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
        Schema::create('tagihan', function (Blueprint $table) {
            $table->id()->onDelete('cascade');
            $table->string('nisn', 10)->index();
            $table->foreign('nisn')->references('nisn')->on('siswa')->onUpdate('cascade');
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->string('kelas_id', 14);
            $table->foreign('kelas_id')->references('kelas_id')->on('kelas')->onUpdate('cascade');
            $table->date('tanggal_tagihan');
            $table->date('tanggal_jatuh_tempo');
            $table->string('keterangan')->nullable();
            $table->bigInteger('sisa_tagihan')->nullable();
            $table->enum('status', ['baru', 'angsur', 'lunas']);
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
        Schema::dropIfExists('tagihan');
    }
};
