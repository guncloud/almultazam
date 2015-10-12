<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttendanceToStudentEkskulTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_ekskul', function(Blueprint $table)
        {
            $table->enum('attendance', ['hadir', 'sakit', 'izin', 'alpa']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_ekskul', function(Blueprint $table)
        {

        });
    }

}
