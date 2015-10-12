<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('contract_id')->unsigned();
            $table->double('uh_1')->nullable();
            $table->double('uh_2')->nullable();
            $table->double('uh_3')->nullable();
            $table->double('uh_4')->nullable();
            $table->double('uts')->nullable();
            $table->double('uas')->nullable();
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
        Schema::drop('scores');
    }

}
