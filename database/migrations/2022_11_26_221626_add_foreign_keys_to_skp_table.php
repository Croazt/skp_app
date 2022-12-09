<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSkpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skp', function (Blueprint $table) {
            $table->foreign(['pejabat_penilai1'], 'skp_ibfk_2')->references(['nip'])->on('pejabat_penilai');
            $table->foreign(['pengelola_kinerja'], 'skp_ibfk_4')->references(['nip'])->on('users');
            $table->foreign(['pejabat_penilai2'], 'skp_ibfk_1')->references(['nip'])->on('pejabat_penilai');
            $table->foreign(['tim_angka_kredit'], 'skp_ibfk_3')->references(['nip'])->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skp', function (Blueprint $table) {
            $table->dropForeign('skp_ibfk_2');
            $table->dropForeign('skp_ibfk_4');
            $table->dropForeign('skp_ibfk_1');
            $table->dropForeign('skp_ibfk_3');
        });
    }
}
