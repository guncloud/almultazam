<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiplomaToStakeholders extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stakeholders', function(Blueprint $table)
        {
            $table->string('universitas_diploma')->nullabel();
            $table->string('fakultas_diploma')->nullable();
            $table->string('jurusan_diploma')->nullable();
            $table->string('program_pendidikan_diploma')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stakeholders', function(Blueprint $table)
        {
            $table->dropColumn('diploma');
        });
    }

}
