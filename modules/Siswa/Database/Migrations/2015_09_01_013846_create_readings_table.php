<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadingsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('readings', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->enum('attendance', ['hadir', 'sakit', 'izin', 'alpa']);
            $table->double('score');
            $table->tinyInteger('semester');
            $table->string('year');
            $table->date('date');
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
        Schema::drop('readings');
    }

}
