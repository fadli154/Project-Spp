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
        Schema::create('konsentrasi_keahlian', function (Blueprint $table) {
            $table->string('id_kk', 7)->primary()->unique()->required()->onUpdate('cascade');
            $table->string('konsentrasi_keahlian', 50)->required();
            $table->enum('tahun_program', ['3', '4']);
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
        Schema::dropIfExists('konsentrasi_keahlian');
    }
};
