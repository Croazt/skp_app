<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSituasiKerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('situasi_kerja', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('situasi');
            $table->integer('aspek_perilaku_id')->index('aspek_perilaku_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('situasi_kerja');
    }
}
