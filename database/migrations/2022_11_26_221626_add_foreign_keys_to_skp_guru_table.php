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
            $table->foreign(['reviu_oleh'], 'skp_guru_ibfk_5')->references(['nip'])->on('users')->cascadeOnUpdate();
            $table->foreign(['pejabat_nilai'], 'skp_guru_ibfk_2')->references(['nip'])->on('pejabat_penilai')->cascadeOnUpdate();
            $table->foreign(['skp_id'], 'skp_guru_ibfk_4')->references(['id'])->on('skp')->cascadeOnDelete();
            $table->foreign(['verifikasi_oleh'], 'skp_guru_ibfk_6')->references(['nip'])->on('users')->cascadeOnUpdate();
            $table->foreign(['user_nip'], 'skp_guru_ibfk_1')->references(['nip'])->on('users')->cascadeOnUpdate();
            $table->foreign(['pejabat_rencana'], 'skp_guru_ibfk_3')->references(['nip'])->on('pejabat_penilai')->cascadeOnUpdate();
            $table->foreign(['pangkat_rencana'], 'skp_guru_ibfk_7')->references(['id'])->on('pangkat')->cascadeOnUpdate();
            $table->foreign(['pangkat_nilai'], 'skp_guru_ibfk_8')->references(['id'])->on('pangkat')->cascadeOnUpdate();
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
