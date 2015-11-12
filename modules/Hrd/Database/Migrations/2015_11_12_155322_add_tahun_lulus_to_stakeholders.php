<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTahunLulusToStakeholders extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stakeholders', function(Blueprint $table)
        {
            $table->string('tahun_lulus_tk')->nullable();
            $table->string('tahun_lulus_sd')->nullable();
            $table->string('tahun_lulus_smp')->nullable();
            $table->string('tahun_lulus_sma')->nullable();
            $table->string('tahun_lulus_diploma')->nullable();
            $table->string('tahun_lulus_s1')->nullable();
            $table->string('tahun_lulus_s2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('', function(Blueprint $table)
        {

        });
    }

}
