<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skp', function (Blueprint $table) {
            $table->integer('id', true)->index('id');
            $table->date('perencanaan');
            $table->date('periode_awal');
            $table->date('periode_akhir');
            $table->date('penilaian');
            $table->string('pengelola_kinerja', 19)->index('pengelola_kinerja');
            $table->string('tim_angka_kredit', 19)->index('tim_angka_kredit');
            $table->string('pejabat_penilai', 19)->index('pejabat_penilai');

            // $table->primary(['id']);
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
        Schema::dropIfExists('skp');
    }
}
