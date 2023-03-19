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
        Schema::create('kelas', function (Blueprint $table) {
            $table->string('kelas_id', 14)->primary()->unique();
            $table->string('kelas', 50)->required();
            $table->integer('angkatan')->required();
            $table->string('nip_wali_kelas', 18)->unique()->nullable();
            $table->foreign('nip_wali_kelas')->references('nip_wali_kelas')->on('pegawai');
            $table->string('id_kk', 7)->required();
            $table->foreign('id_kk')->references('id_kk', 7)->on('konsentrasi_keahlian')->onUpdate('cascade');
            $table->string('foto', 255)->nullable();
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
        Schema::dropIfExists('kelas');
    }
};
