<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndikatorPenilaianPerilakuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indikator_penilaian_perilaku', function (Blueprint $table) {
            $table->integer('situasi_kerja_id');
            $table->integer('indikator_kerja_id')->index('indikator_kerja_id');
            $table->string('user_nip', 19)->index('user_nip');
            $table->integer('skp_id')->index('skp_id');

            $table->primary(['situasi_kerja_id', 'user_nip', 'skp_id'],'indikator_penilaian_perilaku_primary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indikator_penilaian_perilaku');
    }
}
