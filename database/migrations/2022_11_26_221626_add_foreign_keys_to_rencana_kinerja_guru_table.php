<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRencanaKinerjaGuruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rencana_kinerja_guru', function (Blueprint $table) {
            $table->foreign(['user_nip'], 'rencana_kinerja_guru_ibfk_2')->references(['nip'])->on('users');
            $table->foreign(['detail_kinerja_id'], 'rencana_kinerja_guru_ibfk_1')->references(['id'])->on('detail_kinerja');
            $table->foreign(['skp_id'], 'rencana_kinerja_guru_ibfk_3')->references(['id'])->on('skp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rencana_kinerja_guru', function (Blueprint $table) {
            $table->dropForeign('rencana_kinerja_guru_ibfk_2');
            $table->dropForeign('rencana_kinerja_guru_ibfk_1');
            $table->dropForeign('rencana_kinerja_guru_ibfk_3');
        });
    }
}
