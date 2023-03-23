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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->string('nip_wali_kelas', 18)->primary()->required()->onUpdate('cascade');
            $table->string('nama_wali_kelas', 60);
            $table->enum('jk', ['L', 'P']);
            $table->enum('jabatan', ['TP', 'TK']);
            $table->enum('status_pegawai', ['0', '1']);
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
        Schema::dropIfExists('wali_kelas');
    }
};
