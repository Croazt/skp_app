<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkpGuruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skp_guru', function (Blueprint $table) {
            $table->string('user_nip', 19);
            $table->integer('id', true);
            $table->integer('skp_id')->index('skp_id');
            $table->string('status', 20)->default('draft');
            $table->date('tanggal_konfirmasi', 0)->nullable();
            $table->date('tanggal_verifikasi', 0)->nullable();
            $table->date('tanggal_reviu', 0)->nullable();
            $table->date('tanggal_realisasi', 0)->nullable();
            $table->integer('jam_pelajaran')->nullable()->default(24);
            $table->integer('target_pkg')->nullable()->default(125);
            $table->integer('target_pkg_tambahan')->nullable()->default(125);
            $table->integer('capaian_jam_pelajaran')->nullable()->default(24);
            $table->integer('capaian_pkg')->nullable()->default(125);
            $table->integer('capaian_pkg_tambahan')->nullable()->default(125);
            $table->string('verifikasi_oleh', 19)->index('verifikasi_oleh')->nullable();
            $table->string('reviu_oleh', 19)->index('reviu_oleh')->nullable();
            $table->string('pejabat_rencana', 19)->index('pejabat_rencana')->nullable();
            $table->string('pejabat_nilai', 19)->index('pejabat_nilai')->nullable();
            $table->integer('pangkat_rencana')->index('pangkat_rencana')->nullable();
            $table->integer('pangkat_nilai')->index('pangkat_nilai')->nullable();

            $table->index(array('id'));
            $table->dropPrimary();

            $table->primary(['user_nip', 'skp_id']);

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
        Schema::dropIfExists('skp_guru');
    }
}
