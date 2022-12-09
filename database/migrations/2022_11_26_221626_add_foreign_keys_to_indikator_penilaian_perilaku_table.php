<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToIndikatorPenilaianPerilakuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indikator_penilaian_perilaku', function (Blueprint $table) {
            $table->foreign(['skp_id'], 'indikator_penilaian_perilaku_ibfk_2')->references(['id'])->on('skp');
            $table->foreign(['situasi_kerja_id'], 'indikator_penilaian_perilaku_ibfk_4')->references(['id'])->on('situasi_kerja');
            $table->foreign(['user_nip'], 'indikator_penilaian_perilaku_ibfk_1')->references(['nip'])->on('users');
            $table->foreign(['indikator_kerja_id'], 'indikator_penilaian_perilaku_ibfk_3')->references(['id'])->on('indikator_kerja');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('indikator_penilaian_perilaku', function (Blueprint $table) {
            $table->dropForeign('indikator_penilaian_perilaku_ibfk_2');
            $table->dropForeign('indikator_penilaian_perilaku_ibfk_4');
            $table->dropForeign('indikator_penilaian_perilaku_ibfk_1');
            $table->dropForeign('indikator_penilaian_perilaku_ibfk_3');
        });
    }
}
