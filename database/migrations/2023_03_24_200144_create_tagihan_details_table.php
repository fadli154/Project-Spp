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
        Schema::create('tagihan_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tagihan_id')->index();
            $table->foreign('tagihan_id')->references('id')->on('tagihan');
            // $table->unsignedBigInteger('biaya_id')->index();
            // $table->foreign('biaya_id')->references('id')->on('biaya');
            $table->string('nama_biaya', 20);
            $table->bigInteger('nominal_biaya');
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
        Schema::dropIfExists('tagihan_details');
    }
};
