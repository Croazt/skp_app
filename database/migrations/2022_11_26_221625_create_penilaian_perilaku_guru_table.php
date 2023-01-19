<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianPerilakuGuruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_perilaku_guru', function (Blueprint $table) {
            $table->string('user_nip', 19);
            $table->integer('skp_id')->index('skp_id');
            $table->string('status', 20);
            $table->date('tanggal_konfirmasi');
            $table->string('konfirmasi_oleh', 20);

            $table->primary(['user_nip', 'skp_id']);
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
        Schema::dropIfExists('penilaian_perilaku_guru');
    }
}
