<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nis');
            $table->string('nama');
            $table->string('nisn');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('nik');
            $table->text('alamat');
            $table->string('jenis_tinggal');
            $table->string('telepon')->nullable();
            $table->string('handphone')->nullable();
            $table->string('email')->nullable();

            //data ibu
            $table->string('ibu');
            $table->string('tahun_lahir_ibu');
            $table->string('jenjang_pendidikan_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('skhun_ibu');
            $table->enum('kps_ibu', ['ya', 'tidak']);

            //data ayah
            $table->string('ayah');
            $table->string('tahun_lahir_ayah');
            $table->string('jenjang_pendidikan_ayah');
            $table->string('pekerjaan_ayah');
            $table->string('penghasilan_ayah');

            //data wali
            $table->string('wali')->nullable();
            $table->string('tahun_lahir_wali')->nullable();
            $table->string('jenjang_pendidikan_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('penghasilan_wali')->nullable();

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
        Schema::drop('students');
    }
}
