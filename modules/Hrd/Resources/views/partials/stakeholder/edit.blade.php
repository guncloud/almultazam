@extends('hrd::layouts_2.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/formvalidation/formValidation.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/select2/select2.css') }}">
@stop

@section('content')

    <section class="content-header">
        <h1>{{ $title or 'Judul' }}</h1>
    </section>

    <div class="content">
        <form autocomplete="off" id="form_new_stakeholder" method="post" enctype="multipart/form-data" action="{{ url('/hrd/stakeholder/'.$stakeholder->id) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
            <input type="hidden" name="_method" value="patch">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h1 class="box-title">Umum</h1>
                        </div>
                        <div class="box-body">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label class="floating-label">Nama<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="nama" value="{{ $stakeholder->nama }}"/>

                                </div>
                                <div class="col-sm-4">
                                    <label class="floating-label">KTP</label>
                                    <input type="text" class="form-control" name="ktp" value="{{ $stakeholder->ktp }}"/>

                                </div>
                                <div class="col-sm-4">
                                    <label class="floating-label">Tempat Lahir<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="tempat_lahir" value="{{ $stakeholder->tempat_lahir }}"/>

                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col-sm-4">
                                    <label class="floating-label">Tanggal Lahir<span class="required">*</span></label>
                                    <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" data-plugin="formatter" value="{{ $stakeholder->tanggal_lahir }}" data-pattern="[[9999]]-[[99]]-[[99]]"/>
                                    <small class="help-block">Tanggal-Bulan-Tahun</small>
                                </div>

                                <div class="col-sm-4">
                                    <input {{ ($stakeholder->jenis_kelamin == 'l') ? 'checked' : '' }} value="l" type="radio" class="" id="inputRadiosUnchecked" name="jenis_kelamin" data-plugin="iCheck" data-radio-class="iradio_flat-blue" />
                                    <label for="inputRadiosUnchecked">Laki - laki</label>
                                    <input {{ ($stakeholder->jenis_kelamin == 'p') ? 'checked' : ''}} value="p" type="radio" class="" id="inputRadiosUnchecked" name="jenis_kelamin" data-plugin="iCheck" data-radio-class="iradio_flat-blue" />
                                    <label for="inputRadiosUnchecked">Perempuan</label>
                                </div>
                                <div class="col-sm-4">
                                    <label class="floating-label">Foto</label>
                                    <input type="text" class="form-control" readonly="" />
                                    <input type="file" name="photo" value="{{ $stakeholder->photo }}" placeholder="{{ $stakeholder->photo }}"/>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label class="floating-label">Alamat Rumah<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="alamat_rumah" value="{{ $stakeholder->alamat_rumah }}"/>

                                </div>
                                <div class="col-sm-4">
                                    <label class="floating-label">Alamat Sekarang<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="alamat_sekarang" value="{{ $stakeholder->alamat_sekarang }}"/>

                                </div>
                                <div class="col-sm-4">
                                    <label class="floating-label">Kontak</label>
                                    <input type="text" class="form-control" name="kontak" value="{{ $stakeholder->kontak }}"/>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label class="floating-label">Status Marital<span class="required">*</span></label>
                                    <select name="status_marital" id="status_marital" class="form-control">
                                        <option></option>
                                        <option value="belum" {{ ($stakeholder->status_marital == 'belum') ? 'selected' : '' }}>Belum Menikah</option>
                                        <option value="menikah" {{ ($stakeholder->status_marital == 'menikah') ? 'selected' : '' }}>Menikah</option>
                                        <option value="cerai" {{ ($stakeholder->status_marital == 'cerai') ? 'selected' : '' }}>Cerai Hidup/Mati</option>
                                    </select>

                                </div>
                                <div class="col-sm-4">
                                    <label class="floating-label">Nama Suami/Istri</label>
                                    <input type="text" class="form-control" name="nama_istri_suami" value="{{ $stakeholder->nama_istri_suami }}"/>

                                </div>
                                <div class="col-sm-4">
                                    <label class="floating-label">Pekerjaan Suami/Istri</label>
                                    <input type="text" class="form-control" name="pekerjaan_keluarga" value="{{ $stakeholder->pekerjaan_keluarga }}"/>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h1 class="box-title">
                                Kepegawaian
                            </h1>
                        </div>
                        <div class="box-body">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="floating-label">Divisi/Bagian<span class="required">*</span></label>
                                    <select name="division_id" id="" class="form-control">
                                        <option>&nbsp;</option>
                                        @foreach($divisions as $div)
                                            <option value="{{ $div->id }}" {{ ($stakeholder->division_id == $div->id) ? 'selected' : '' }}>{{ $div->division }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Status<span class="required">*</span></label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="aktif" {{ ($stakeholder->status == 'aktif') ? 'selected' : '' }}>Aktif</option>
                                        <option value="non-aktif" {{ ($stakeholder->status == 'non-aktif') ? 'selected' : '' }}>Non Aktif</option>
                                    </select>

                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">NRP<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="nrp" value="{{ $stakeholder->nrp }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Status Kepegawaian<span class="required">*</span></label>
                                    <select class="form-control" name="status_kepegawaian" id="">
                                        <option>&nbsp;</option>
                                        <option value="boarding" {{ ($stakeholder->status_kepegawaian == 'boarding') ? 'selected' : '' }}>Boarding</option>
                                        <option value="fullday" {{ ($stakeholder->status_kepegawaian == 'fullday') ? 'selected' : '' }}>Fullday</option>
                                    </select>
                                </div>
                            </div>

                    </div>
                        </div>

                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h1 class="box-title">Pendidikan</h1>
                        </div>
                        <div class="box-body">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="floating-label">TK</label>
                                    <input type="text" class="form-control" name="tk" value="{{ $stakeholder->tk }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">SD</label>
                                    <input type="text" class="form-control" name="sd" value="{{ $stakeholder->sd }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">SMP</label>
                                    <input type="text" class="form-control" name="smp" value="{{ $stakeholder->smp }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">SMA</label>
                                    <input type="text" class="form-control" name="sma" value="{{ $stakeholder->sma }}"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="floating-label">Diploma</label>
                                    <input type="text" class="form-control" name="universitas_diploma" value="{{ $stakeholder->universitas_diploma }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Fakultas</label>
                                    <input type="text" class="form-control" name="fakultas_diploma" value="{{ $stakeholder->universitas_diploma }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Jurusan</label>
                                    <input type="text" class="form-control" name="jurusan_diploma" value="{{ $stakeholder->universitas_diploma }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Program Studi</label>
                                    <input type="text" class="form-control" name="program_pendidikan_diploma" value="{{ $stakeholder->universitas_diploma }}"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="floating-label">Universitas S1</label>
                                    <input type="text" class="form-control" name="universitas_s1" value="{{ $stakeholder->universitas_s1 }}">
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Fakultas S1</label>
                                    <input type="text" class="form-control" name="fakultas_s1" value="{{ $stakeholder->fakultas_s1 }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Jurusan S1</label>
                                    <input type="text" class="form-control" name="jurusan_s1" value="{{ $stakeholder->jurusan_s1 }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Program Studi S1</label>
                                    <input type="text" class="form-control" name="program_pendidikan_s1" value="{{ $stakeholder->program_pendidikan_s1 }}"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="floating-label">Universitas S2</label>
                                    <input type="text" class="form-control" name="universitas_s2" value="{{ $stakeholder->universitas_s2 }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Fakultas S2</label>
                                    <input type="text" class="form-control" name="fakultas_s2" value="{{ $stakeholder->fakultas_s2 }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Jurusan S2</label>
                                    <input type="text" class="form-control" name="jurusan_s2" value="{{ $stakeholder->jurusan_s2 }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Program Studi S2</label>
                                    <input type="text" class="form-control" name="program_pendidikan_s2" value="{{ $stakeholder->program_pendidikan_s2 }}"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h1 class="box-title">Pendidikan Non-Formal</h1>
                        </div>
                        <div class="box-body">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="floating-label">Nama Lembaga 1</label>
                                    <input type="text" class="form-control" name="nama_lembaga_1" value="{{ $stakeholder->nama_lembaga_1 }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Jenis Pendidikan </label>
                                    <input type="text" class="form-control" name="jenis_pendidikan_1" value="{{ $stakeholder->jenis_pendidikan_1 }}"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="floating-label">Nama Lembaga 2</label>
                                    <input type="text" class="form-control" name="nama_lembaga_2" value="{{ $stakeholder->nama_lembaga_2 }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Jenis Pendidikan</label>
                                    <input type="text" class="form-control" name="jenis_pendidikan_2" value="{{ $stakeholder->jenis_pendidikan_2 }}"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="floating-label">Nama Lembaga 3</label>
                                    <input type="text" class="form-control" name="nama_lembaga_3" value="{{ $stakeholder->nama_lembaga_3 }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Jenis Pendidikan</label>
                                    <input type="text" class="form-control" name="jenis_pendidikan_3" value="{{ $stakeholder->jenis_pendidikan_3 }}"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h1 class="box-title">
                                Pengalaman Kerja
                            </h1>
                        </div>
                        <div class="box-body">
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label class="floating-label">Pengalaman Kerja 1</label>
                                    <input type="text" class="form-control" name="lembaga_pengalaman_kerja_1" value="{{ $stakeholder->lembaga_pengalaman_kerja_1 }}"/>
                                </div>
                                <div class="col-md-2">
                                    <label class="floating-label">Alamat</label>
                                    <input type="text" class="form-control" name="alamat_pengalaman_kerja_1" /value="{{ $stakeholder->alamat_pengalaman_kerja_1 }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="floating-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan_pengalaman_kerja_1" value="{{ $stakeholder->jabatan_pengalaman_kerja_1 }}"/>
                                </div>
                                <div class="col-md-2">
                                    <label class="floating-label">Awal Kerja</label>
                                    <input type="text" class="form-control" name="awal_kerja_1" value="{{ $stakeholder->awal_kerja_1 }}"/>
                                </div>
                                <div class="col-md-2">
                                    <label class="floating-label">Akhir Kerja</label>
                                    <input type="text" class="form-control" name="akhir_kerja_1" value="{{ $stakeholder->akhir_kerja_1 }}"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label class="floating-label">Pengalaman Kerja 2</label>
                                    <input type="text" class="form-control" name="lembaga_pengalaman_kerja_2" value="{{ $stakeholder->lembaga_pengalaman_kerja_2 }}"/>
                                </div>
                                <div class="col-md-2">
                                    <label class="floating-label">Alamat</label>
                                    <input type="text" class="form-control" name="alamat_pengalaman_kerja_2" value="{{ $stakeholder->alamat_pengalaman_kerja_2 }}"/>
                                </div>
                                <div class="col-md-2">
                                    <label class="floating-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan_pengalaman_kerja_2" value="{{ $stakeholder->jabatan_pengalaman_kerja_2 }}"/>
                                </div>
                                <div class="col-md-2">
                                    <label class="floating-label">Awal Kerja</label>
                                    <input type="text" class="form-control" name="awal_kerja_2" value="{{ $stakeholder->awal_kerja_2 }}"/>
                                </div>
                                <div class="col-md-2">
                                    <label class="floating-label">Akhir Kerja</label>
                                    <input type="text" class="form-control" name="akhir_kerja_2" value="{{ $stakeholder->akhir_kerja_2 }}"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h1 class="box-title">
                                Pengalaman Organisasi
                            </h1>
                        </div>
                        <div class="box-body">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label class="floating-label">Lembaga 1</label>
                                    <input type="text" class="form-control" name="lembaga_organisasi_1" value="{{ $stakeholder->lembaga_organisasi_1 }}"/>
                                </div>
                                <div class="col-sm-6">
                                    <label class="floating-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan_organisasi_1" value="{{ $stakeholder->jabatan_organisasi_1 }}"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label class="floating-label">Lembaga 2</label>
                                    <input type="text" class="form-control" name="lembaga_organisasi_2" value="{{ $stakeholder->lembaga_organisasi_2 }}"/>
                                </div>
                                <div class="col-sm-6">
                                    <label class="floating-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan_organisasi_2" value="{{ $stakeholder->jabatan_organisasi_2 }}"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label class="floating-label">Lembaga 3</label>
                                    <input type="text" class="form-control" name="lembaga_organisasi_3" value="{{ $stakeholder->lembaga_organisasi_3 }}"/>
                                </div>
                                <div class="col-sm-6">
                                    <label class="floating-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan_organisasi_3" value="{{ $stakeholder->jabatan_organisasi_3 }}"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h1 class="box-title">
                                Keahlian
                            </h1>
                        </div>
                        <div class="box-body">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label class="floating-label">Keahlian 1</label>
                                    <input type="text" class="form-control" name="keahlian_1" value="{{ $stakeholder->keahlian_1 }}"/>
                                </div>
                                <div class="col-sm-4">
                                    <label class="floating-label">Keahlian 2</label>
                                    <input type="text" class="form-control" name="keahlian_2" value="{{ $stakeholder->keahlian_2 }}"/>
                                </div>
                                <div class="col-sm-4">
                                    <label class="floating-label">Keahlian 3</label>
                                    <input type="text" class="form-control" name="keahlian_3" value="{{ $stakeholder->keahlian_3 }}"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h1 class="box-title">
                                Anak
                            </h1>
                        </div>
                        <div class="box-body">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="floating-label">Anak 1</label>
                                    <input type="text" class="form-control" name="child_1" value="{{ $stakeholder->child_1 }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Lahir Anak 1</label>
                                    <input value="{{ $stakeholder->lahir_child_1 }}" type="text" class="form-control" name="lahir_child_1" data-plugin="formatter" data-pattern="[[99]]-[[99]]-[[9999]]"/>
                                    <small class="help-block">Tanggal-Bulan-Tahun</small>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Anak 2</label>
                                    <input type="text" class="form-control" name="child_2" value="{{ $stakeholder->child_2 }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Lahir Anak 2</label>
                                    <input value="{{ $stakeholder->lahir_child_2 }}" type="text" class="form-control" name="lahir_child_2" data-plugin="formatter" data-pattern="[[99]]-[[99]]-[[9999]]"/>
                                    <small class="help-block">Tanggal-Bulan-Tahun</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="floating-label">Anak 5</label>
                                    <input type="text" class="form-control" name="child_5" value="{{ $stakeholder->child_5 }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Lahir Anak 5</label>
                                    <input value="{{ $stakeholder->lahir_child_5 }}" type="text" class="form-control" name="lahir_child_5" data-plugin="formatter" data-pattern="[[99]]-[[99]]-[[9999]]"/>
                                    <small class="help-block">Tanggal-Bulan-Tahun</small>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Anak 6</label>
                                    <input type="text" class="form-control" name="child_6" value="{{ $stakeholder->child_6 }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Lahir Anak 6</label>
                                    <input value="{{ $stakeholder->lahir_child_6 }}" type="text" class="form-control" name="lahir_child_6" data-plugin="formatter" data-pattern="[[99]]-[[99]]-[[9999]]"/>
                                    <small class="help-block">Tanggal-Bulan-Tahun</small>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Anak 7</label>
                                    <input type="text" class="form-control" name="child_7" value="{{ $stakeholder->child_7 }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Lahir Anak 7</label>
                                    <input value="{{ $stakeholder->lahir_child_7 }}" type="text" class="form-control" name="lahir_child_7" data-plugin="formatter" data-pattern="[[99]]-[[99]]-[[9999]]"/>
                                    <small class="help-block">Tanggal-Bulan-Tahun</small>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Anak 8</label>
                                    <input type="text" class="form-control" name="child_8" value="{{ $stakeholder->child_8 }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Lahir Anak 8</label>
                                    <input value="{{ $stakeholder->lahir_child_8 }}" type="text" class="form-control" name="lahir_child_8" data-plugin="formatter" data-pattern="[[99]]-[[99]]-[[9999]]"/>
                                    <small class="help-block">Tanggal-Bulan-Tahun</small>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary pull-right" type="submit" id="submit_new_stakeholder">
                        <i class="fa fa-check" aria-hidden="true"> Simpan</i>
                    </button>
                </div>
            </div>
        </form>
    </div>

@stop

@section('js')
    <script src="{{ asset('/vendor/formvalidation/formValidation.min.js') }}"></script>
    <script src="{{ asset('/vendor/formvalidation/framework/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/vendor/formatter-js/jquery.formatter.js') }}"></script>
    <script src="{{ asset('/vendor/select2/select2.min.js') }}"></script>

    <script src="{{ asset('/js/components/formatter-js.js') }}"></script>

    <script>
        $(function(){

            $('#position').select2().select2("data",
                    [{"id":"2127","text":"Henry Ford"},{"id":"2199","text":"Tom Phillips"}]
            );

            $('#form_new_stakeholder').formValidation({
                framework: "bootstrap",
                button: {
                    selector: '#submit_new_stakeholder',
                    disabled: 'disabled'
                },
                icon: null,
                fields: {
                    nama: {
                        validators: {
                            notEmpty: {
                                message: 'The full name is required and cannot be empty'
                            }
                        }
                    },
                    tempat_lahir: {
                        validators: {
                            notEmpty: {
                                message: 'The content address is required and cannot be empty'
                            }
                        }
                    },
                    tanggal_lahir: {
                        validators: {
                            notEmpty: {
                                message: 'The content address is required and cannot be empty'
                            }
                        }
                    },
                    mulai_kerja: {
                        validators: {
                            notEmpty: {
                                message: 'The content address is required and cannot be empty'
                            }
                        }
                    },
                    jenis_kelamin: {
                        validators: {
                            notEmpty: {
                                message: 'The content is required and cannot be empty'
                            }
                        }
                    },
                    status: {
                        validators: {
                            notEmpty: {
                                message: 'The content is required and cannot be empty'
                            }
                        }
                    },
                    nrp: {
                        validators: {
                            notEmpty: {
                                message: 'The content is required and cannot be empty'
                            }
                        }
                    },
                    asal_sekolah: {
                        validators: {
                            notEmpty: {
                                message: 'The content is required and cannot be empty'
                            }
                        }
                    },
                    tahun_lulus: {
                        validators: {
                            notEmpty: {
                                message: 'The content is required and cannot be empty'
                            }
                        }
                    },
                    jenis_kelamin: {
                        validators: {
                            notEmpty: {
                                message: 'The content is required and cannot be empty'
                            }
                        }
                    },
                    status_kepegawaian: {
                        validators: {
                            notEmpty: {
                                message: 'The content is required and cannot be empty'
                            }
                        }
                    },
                    status_marital: {
                        validators: {
                            notEmpty: {
                                message: 'The content is required and cannot be empty'
                            }
                        }
                    },
                    golongan: {
                        validators: {
                            notEmpty: {
                                message: 'The content is required and cannot be empty'
                            }
                        }
                    },
                    alamat_rumah: {
                        validators: {
                            notEmpty: {
                                message: 'The content is required and cannot be empty'
                            }
                        }
                    },
                    alamat_sekarang: {
                        validators: {
                            notEmpty: {
                                message: 'The content is required and cannot be empty'
                            }
                        }
                    }
                }
            });

        })
    </script>
@stop