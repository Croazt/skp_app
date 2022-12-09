<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSkpGuruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skp_guru', function (Blueprint $table) {
            $table->foreign(['reviu_oleh'], 'skp_guru_ibfk_5')->references(['nip'])->on('users');
            $table->foreign(['pejabat_nilai'], 'skp_guru_ibfk_2')->references(['nip'])->on('pejabat_penilai');
            $table->foreign(['skp_id'], 'skp_guru_ibfk_4')->references(['id'])->on('skp');
            $table->foreign(['verivikasi_oleh'], 'skp_guru_ibfk_6')->references(['nip'])->on('users');
            $table->foreign(['user_nip'], 'skp_guru_ibfk_1')->references(['nip'])->on('users');
            $table->foreign(['pejabat_rencana'], 'skp_guru_ibfk_3')->references(['nip'])->on('pejabat_penilai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skp_guru', function (Blueprint $table) {
            $table->dropForeign('skp_guru_ibfk_5');
            $table->dropForeign('skp_guru_ibfk_2');
            $table->dropForeign('skp_guru_ibfk_4');
            $table->dropForeign('skp_guru_ibfk_6');
            $table->dropForeign('skp_guru_ibfk_1');
            $table->dropForeign('skp_guru_ibfk_3');
        });
    }
}
