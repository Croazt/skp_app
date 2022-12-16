<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToIndikatorKerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indikator_kerja', function (Blueprint $table) {
            $table->foreign(['aspek_perilaku_id'], 'indikator_kerja_ibfk_1')->references(['id'])->on('aspek_perilaku')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('indikator_kerja', function (Blueprint $table) {
            $table->dropForeign('indikator_kerja_ibfk_1');
        });
    }
}
