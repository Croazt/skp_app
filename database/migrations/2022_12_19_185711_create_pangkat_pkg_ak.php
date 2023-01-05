<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pangkat_pkg_ak', function (Blueprint $table) {
            $table->id();
            $table->integer('pangkat_id')->index();
            $table->double('125')->index();
            $table->double('100')->index();
            $table->double('75')->index();
            $table->double('50')->index();
            $table->double('25')->index();
            $table->foreign(['pangkat_id'], 'pangkat_pkg_ak_ibfk_1')->references(['id'])->on('pangkat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pangkat_pkg_ak');
    }
};
