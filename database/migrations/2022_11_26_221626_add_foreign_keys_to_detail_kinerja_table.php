<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDetailKinerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_kinerja', function (Blueprint $table) {
            $table->foreign(['skp_id'], 'detail_kinerja_ibfk_2')->references(['id'])->on('skp')->cascadeOnDelete();
            $table->foreign(['kinerja_id'], 'detail_kinerja_ibfk_1')->references(['id'])->on('kinerja')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_kinerja', function (Blueprint $table) {
            $table->dropForeign('detail_kinerja_ibfk_2');
            $table->dropForeign('detail_kinerja_ibfk_1');
        });
    }
}
