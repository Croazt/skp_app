<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePejabatPenilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pejabat_penilai', function (Blueprint $table) {
            $table->string('nama', 70);
            $table->string('nip', 19)->primary();
            $table->integer('pangkat_id')->index('pangkat_id');
            $table->string('pekerjaan', 50);
            $table->integer('unit_kerja');
            $table->string('atasan', 19)->nullable()->index('atasan');
            
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
        Schema::dropIfExists('pejabat_penilai');
    }
}
