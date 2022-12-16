<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRencanaKinerjaGuruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencana_kinerja_guru', function (Blueprint $table) {
            $table->string('user_nip', 19);
            $table->integer('skp_id')->index('skp_id');
            $table->integer('detail_kinerja_id')->index('detail_kinerja_id');
            $table->tinyInteger('terkait')->nullable();
            $table->integer('target_kualitas')->nullable();
            $table->integer('target_kuantitas')->nullable();
            $table->integer('target_waktu')->nullable();
            $table->integer('realisiasi_kualitas')->nullable();
            $table->integer('realisasi_kuantitas')->nullable();
            $table->integer('realisasi_waktu')->nullable();
            $table->string('tanggal_verifikasi', 0)->nullable();
            $table->string('lingkup', 25)->nullable();
            $table->string('dokumen_bukti')->nullable();

            $table->primary(['user_nip', 'skp_id', 'detail_kinerja_id']);
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
        Schema::dropIfExists('rencana_kinerja_guru');
    }
}
