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
            $table->string('perencanaan', 0);
            $table->string('periode_awal', 0);
            $table->string('periode_akhir', 0);
            $table->string('penilaian', 0);
            $table->string('pengelola_kinerja', 19)->index('pengelola_kinerja');
            $table->string('tim_angka_kredit', 19)->index('tim_angka_kredit');
            $table->string('pejabat_penilai1', 19)->index('pejabat_penilai1');
            $table->string('pejabat_penilai2', 19)->index('pejabat_penilai2');

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
