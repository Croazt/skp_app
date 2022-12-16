<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPenilaianPerilakuGuruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penilaian_perilaku_guru', function (Blueprint $table) {
            $table->foreign(['skp_id'], 'penilaian_perilaku_guru_ibfk_2')->references(['id'])->on('skp')->cascadeOnDelete();
            $table->foreign(['user_nip'], 'penilaian_perilaku_guru_ibfk_1')->references(['nip'])->on('users')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penilaian_perilaku_guru', function (Blueprint $table) {
            $table->dropForeign('penilaian_perilaku_guru_ibfk_2');
            $table->dropForeign('penilaian_perilaku_guru_ibfk_1');
        });
    }
}
