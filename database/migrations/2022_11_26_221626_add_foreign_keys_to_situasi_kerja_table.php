<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSituasiKerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('situasi_kerja', function (Blueprint $table) {
            $table->foreign(['aspek_perilaku_id'], 'situasi_kerja_ibfk_1')->references(['id'])->on('aspek_perilaku');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('situasi_kerja', function (Blueprint $table) {
            $table->dropForeign('situasi_kerja_ibfk_1');
        });
    }
}
