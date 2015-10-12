<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChildrensToStakeholdersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stakeholders', function(Blueprint $table)
        {
            $table->string('tk')->nullable();
            $table->string('sd')->nullable();
            $table->string('smp')->nullable();
            $table->string('sma')->nullable();
            $table->string('diploma')->nullable();

            $table->string('universitas_s1')->nullable();
            $table->string('fakultas_s1')->nullable();
            $table->string('jurusan_s1')->nullable();
            $table->string('program_pendidikan_s1')->nullable();

            $table->string('universitas_s2')->nullable();
            $table->string('fakultas_s2')->nullable();
            $table->string('jurusan_s2')->nullable();
            $table->string('program_pendidikan_s2')->nullable();

            $table->string('nama_lembaga_1')->nullable();
            $table->string('jenis_pendidikan_1')->nullable();
            $table->string('nama_lembaga_2')->nullable();
            $table->string('jenis_pendidikan_2')->nullable();
            $table->string('nama_lembaga_3')->nullable();
            $table->string('jenis_pendidikan_3')->nullable();

            $table->string('lembaga_pengalaman_kerja_1')->nullable();
            $table->text('alamat_pengalaman_kerja_1')->nullable();
            $table->string('jabatan_pengalaman_kerja_1')->nullable();
            $table->string('awal_kerja_1')->nullable();
            $table->string('akhir_kerja_1')->nullable();

            $table->string('lembaga_pengalaman_kerja_2')->nullable();
            $table->text('alamat_pengalaman_kerja_2')->nullable();
            $table->string('jabatan_pengalaman_kerja_2')->nullable();
            $table->string('awal_kerja_2')->nullable();
            $table->string('akhir_kerja_2')->nullable();

            $table->string('lembaga_organisasi_1')->nullable();
            $table->string('jabatan_organisasi_1')->nullable();
            $table->string('lembaga_organisasi_2')->nullable();
            $table->string('jabatan_organisasi_2')->nullable();
            $table->string('lembaga_organisasi_3')->nullable();
            $table->string('jabatan_organisasi_3')->nullable();
            $table->string('lembaga_organisasi_4')->nullable();
            $table->string('jabatan_organisasi_4')->nullable();

            $table->string('keahlian_1')->nullable();
            $table->string('keahlian_2')->nullable();
            $table->string('keahlian_3')->nullable();

            $table->string('pekerjaan_keluarga')->nullable();

            $table->string('child_1')->nullable();
            $table->string('child_2')->nullable();
            $table->string('child_3')->nullable();
            $table->string('child_4')->nullable();
            $table->string('child_5')->nullable();
            $table->string('child_6')->nullable();
            $table->string('child_7')->nullable();
            $table->string('child_8')->nullable();

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

        });
    }

}
