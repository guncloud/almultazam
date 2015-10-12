<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionStakeholderTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('position_stakeholder', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('stakeholder_id')->unsigned();
            $table->integer('position_id')->unsigned();
            $table->string('detail');
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
        Schema::drop('position_stakeholder');
    }

}
