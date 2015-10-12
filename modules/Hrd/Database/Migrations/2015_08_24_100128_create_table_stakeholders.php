<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStakeholders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stakeholders', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nama');
            $table->string('ktp')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['l','p']);
            $table->enum('status', ['aktif', 'non-aktif']);
            $table->integer('division_id')->unsigned();

            $table->string('photo')->nullable();
            $table->string('nrp');
//            $table->string('asal_sekolah');
//            $table->string('fakultas')->nullable();
//            $table->string('jurusan')->nullable();
//            $table->string('program_studi')->nullable();
//            $table->string('tahun_lulus');
            $table->string('status_kepegawaian');
            $table->string('jabatan')->nullable();
            $table->date('mulai_kerja');
            $table->string('golongan');
            $table->enum('status_marital', ['belum', 'menikah']);
            $table->string('nama_istri_suami')->nullable();
            $table->text('alamat_rumah');
            $table->text('alamat_sekarang');
            $table->string('kontak')->nullable();

            $table->softDeletes();
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
        Schema::drop('stakeholders');
    }
}
