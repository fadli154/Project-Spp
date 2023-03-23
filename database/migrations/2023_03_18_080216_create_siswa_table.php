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
        Schema::create('siswa', function (Blueprint $table) {
            $table->string('nisn', 10)->primary()->required();
            $table->string('nik', 16)->unique()->required();
            $table->string('nama', 60)->required();
            $table->unsignedBigInteger('wali_id')->nullable();
            $table->foreign('wali_id')->references('id')->on('users')->onUpdate('cascade');
            $table->enum('jk', ['P', 'L']);
            $table->string('tempat_lahir', 100);
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
        Schema::dropIfExists('siswa');
    }
};
