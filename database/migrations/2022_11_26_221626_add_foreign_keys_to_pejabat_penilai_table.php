<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPejabatPenilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pejabat_penilai', function (Blueprint $table) {
            $table->foreign(['pangkat_id'], 'pejabat_penilai_ibfk_2')->references(['id'])->on('pangkat');
            $table->foreign(['atasan'], 'pejabat_penilai_ibfk_1')->references(['nip'])->on('pejabat_penilai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pejabat_penilai', function (Blueprint $table) {
            $table->dropForeign('pejabat_penilai_ibfk_2');
            $table->dropForeign('pejabat_penilai_ibfk_1');
        });
    }
}
