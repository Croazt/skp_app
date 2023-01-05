<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailKinerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_kinerja', function (Blueprint $table) {
            $table->integer('id', true)->index('id');
            $table->integer('skp_id')->index('skp_id');
            $table->integer('kinerja_id')->index('kinerja_id');
            $table->text('deskripsi');
            $table->text('butir_kegiatan');
            $table->text('output_kegiatan');
            $table->integer('angka_kredit');
            $table->string('pekerjaan', 50)->nullable();
            $table->text('indikator_kualitas')->nullable();
            $table->text('indikator_kuantitas')->nullable();
            $table->text('indikator_waktu')->nullable();
            $table->text('detail_output_kualitas')->nullable();
            $table->text('detail_output_kuantitas')->nullable();
            $table->text('detail_output_waktu')->nullable();
            $table->string('tipe_angka_kredit');

            $table->timestamps();
            // $table->primary(['id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_kinerja');
    }
}
