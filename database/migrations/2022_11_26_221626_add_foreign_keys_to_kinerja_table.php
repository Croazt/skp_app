<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToKinerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kinerja', function (Blueprint $table) {
            $table->foreign(['skp_id'], 'kinerja_ibfk_1')->references(['id'])->on('skp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kinerja', function (Blueprint $table) {
            $table->dropForeign('kinerja_ibfk_1');
        });
    }
}
