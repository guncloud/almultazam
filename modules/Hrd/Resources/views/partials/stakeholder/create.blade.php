@extends('hrd::layouts_2.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/formvalidation/formValidation.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/select2/select2.css') }}">
@stop

@section('content')

    <section class="content-header">
        <h1>
            {{ $title or 'Kepegawaian' }}
            <small> {{ $subtitle or '' }} </small>
        </h1>
    </section>

    <div class="content">
        <form autocomplete="off" id="form_new_stakeholder" method="post" action="{{ url('/hrd/stakeholder') }}" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control" name="nama" value=""/>

                                </div>
                                <div class="col-sm-4">
                                    <label class="floating-label">KTP</label>
                                    <input type="text" class="form-control" name="ktp" value=""/>

                                </div>
                                <div class="col-sm-4">
                                    <label class="floating-label">Tempat Lahir<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="tempat_lahir" value=""/>

                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col-sm-4">
                                    <label class="floating-label">Tanggal Lahir<span class="required">*</span></label>
                                    <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" data-plugin="formatter" value="" data-pattern="[[9999]]-[[99]]-[[99]]"/>
                                    <small class="help-block">Tanggal-Bulan-Tahun</small>
                                </div>

                                <div class="col-sm-4">
                                    <input value="l" type="radio" class="" id="inputRadiosUnchecked" name="jenis_kelamin" data-plugin="iCheck" data-radio-class="iradio_flat-blue" />
                                    <label for="inputRadiosUnchecked">Laki - laki</label>
                                    <input value="p" type="radio" class="" id="inputRadiosUnchecked" name="jenis_kelamin" data-plugin="iCheck" data-radio-class="iradio_flat-blue" />
                                    <label for="inputRadiosUnchecked">Perempuan</label>
                                </div>
                                <div class="col-sm-4">
                                    <label class="floating-label">Foto</label>
                                    <input type="text" class="form-control" readonly="" />
                                    <input type="file" name="photo" value="" placeholder=""/>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label class="floating-label">Alamat Rumah<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="alamat_rumah" value=""/>

                                </div>
                                <div class="col-sm-4">
                                    <label class="floating-label">Alamat Sekarang<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="alamat_sekarang" value=""/>

                                </div>
                                <div class="col-sm-4">
                                    <label class="floating-label">Kontak</label>
                                    <input type="text" class="form-control" name="kontak" value=""/>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label class="floating-label">Status Marital<span class="required">*</span></label>
                                    <select name="status_marital" id="status_marital" class="form-control">
                                        <option></option>
                                        <option value="belum" >Belum Menikah</option>
                                        <option value="menikah" >Menikah</option>
                                        <option value="cerai" >Cerai Hidup/Mati</option>
                                    </select>

                                </div>
                                <div class="col-sm-4">
                                    <label class="floating-label">Nama Suami/Istri</label>
                                    <input type="text" class="form-control" name="nama_istri_suami" value=""/>

                                </div>
                                <div class="col-sm-4">
                                    <label class="floating-label">Pekerjaan Suami/Istri</label>
                                    <input type="text" class="form-control" name="pekerjaan_keluarga" value=""/>

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
                                            <option value="" {{ $div->id }}>{{ $div->division }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Status<span class="required">*</span></label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="aktif" >Aktif</option>
                                        <option value="non-aktif" >Non Aktif</option>
                                    </select>

                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">NRP<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="nrp" value=""/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Status Kepegawaian<span class="required">*</span></label>
                                    <select class="form-control" name="status_kepegawaian" id="">
                                        <option>&nbsp;</option>
                                        <option value="boarding">Boarding</option>
                                        <option value="fullday">Fullday</option>
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
                                    <input type="text" class="form-control" name="tk" value=""/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">SD</label>
                                    <input type="text" class="form-control" name="sd" value=""/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">SMP</label>
                                    <input type="text" class="form-control" name="smp" value=""/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">SMA</label>
                                    <input type="text" class="form-control" name="sma" value=""/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="floating-label">Diploma</label>
                                    <input type="text" class="form-control" name="universitas_diploma" value=""/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Fakultas</label>
                                    <input type="text" class="form-control" name="fakultas_diploma" value=""/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Jurusan</label>
                                    <input type="text" class="form-control" name="jurusan_diploma" value=""/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Program Studi</label>
                                    <input type="text" class="form-control" name="program_pendidikan_diploma" value=""/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="floating-label">Universitas S1</label>
                                    <input type="text" class="form-control" name="universitas_s1" value="">
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Fakultas S1</label>
                                    <input type="text" class="form-control" name="fakultas_s1" value=""/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Jurusan S1</label>
                                    <input type="text" class="form-control" name="jurusan_s1" value=""/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Program Studi S1</label>
                                    <input type="text" class="form-control" name="program_pendidikan_s1" value=""/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="floating-label">Universitas S2</label>
                                    <input type="text" class="form-control" name="universitas_s2" value=""/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Fakultas S2</label>
                                    <input type="text" class="form-control" name="fakultas_s2" value=""/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Jurusan S2</label>
                                    <input type="text" class="form-control" name="jurusan_s2" value=""/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Program Studi S2</label>
                                    <input type="text" class="form-control" name="program_pendidikan_s2" value=""/>
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
                                    <input type="text" class="form-control" name="nama_lembaga_1" value=""/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Jenis Pendidikan </label>
                                    <input type="text" class="form-control" name="jenis_pendidikan_1" value=""/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="floating-label">Nama Lembaga 2</label>
                                    <input type="text" class="form-control" name="nama_lembaga_2" value=""/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Jenis Pendidikan</label>
                                    <input type="text" class="form-control" name="jenis_pendidikan_2" value=""/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="floating-label">Nama Lembaga 3</label>
                                    <input type="text" class="form-control" name="nama_lembaga_3" value=""/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Jenis Pendidikan</label>
                                    <input type="text" class="form-control" name="jenis_pendidikan_3" value=""/>
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
                                    <input type="text" class="form-control" name="lembaga_pengalaman_kerja_1" value=""/>
                                </div>
                                <div class="col-md-2">
                                    <label class="floating-label">Alamat</label>
                                    <input type="text" class="form-control" name="alamat_pengalaman_kerja_1" /value="">
                                </div>
                                <div class="col-md-2">
                                    <label class="floating-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan_pengalaman_kerja_1" value=""/>
                                </div>
                                <div class="col-md-2">
                                    <label class="floating-label">Awal Kerja</label>
                                    <input type="text" class="form-control" name="awal_kerja_1" value=""/>
                                </div>
                                <div class="col-md-2">
                                    <label class="floating-label">Akhir Kerja</label>
                                    <input type="text" class="form-control" name="akhir_kerja_1" value=""/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label class="floating-label">Pengalaman Kerja 2</label>
                                    <input type="text" class="form-control" name="lembaga_pengalaman_kerja_2" value=""/>
                                </div>
                                <div class="col-md-2">
                                    <label class="floating-label">Alamat</label>
                                    <input type="text" class="form-control" name="alamat_pengalaman_kerja_2" value=""/>
                                </div>
                                <div class="col-md-2">
                                    <label class="floating-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan_pengalaman_kerja_2" value=""/>
                                </div>
                                <div class="col-md-2">
                                    <label class="floating-label">Awal Kerja</label>
                                    <input type="text" class="form-control" name="awal_kerja_2" value=""/>
                                </div>
                                <div class="col-md-2">
                                    <label class="floating-label">Akhir Kerja</label>
                                    <input type="text" class="form-control" name="akhir_kerja_2" value=""/>
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
                                    <input type="text" class="form-control" name="lembaga_organisasi_1" value=""/>
                                </div>
                                <div class="col-sm-6">
                                    <label class="floating-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan_organisasi_1" value=""/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label class="floating-label">Lembaga 2</label>
                                    <input type="text" class="form-control" name="lembaga_organisasi_2" value=""/>
                                </div>
                                <div class="col-sm-6">
                                    <label class="floating-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan_organisasi_2" value=""/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label class="floating-label">Lembaga 3</label>
                                    <input type="text" class="form-control" name="lembaga_organisasi_3" value=""/>
                                </div>
                                <div class="col-sm-6">
                                    <label class="floating-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan_organisasi_3" value=""/>
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
                                    <input type="text" class="form-control" name="keahlian_1" value=""/>
                                </div>
                                <div class="col-sm-4">
                                    <label class="floating-label">Keahlian 2</label>
                                    <input type="text" class="form-control" name="keahlian_2" value=""/>
                                </div>
                                <div class="col-sm-4">
                                    <label class="floating-label">Keahlian 3</label>
                                    <input type="text" class="form-control" name="keahlian_3" value=""/>
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
                                    <input type="text" class="form-control" name="child_1" value=""/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Lahir Anak 1</label>
                                    <input value="" type="text" class="form-control" name="lahir_child_1" data-plugin="formatter" data-pattern="[[99]]-[[99]]-[[9999]]"/>
                                    <small class="help-block">Tanggal-Bulan-Tahun</small>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Anak 2</label>
                                    <input type="text" class="form-control" name="child_2" value=""/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Lahir Anak 2</label>
                                    <input value="" type="text" class="form-control" name="lahir_child_2" data-plugin="formatter" data-pattern="[[99]]-[[99]]-[[9999]]"/>
                                    <small class="help-block">Tanggal-Bulan-Tahun</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="floating-label">Anak 5</label>
                                    <input type="text" class="form-control" name="child_5" value=""/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Lahir Anak 5</label>
                                    <input value="" type="text" class="form-control" name="lahir_child_5" data-plugin="formatter" data-pattern="[[99]]-[[99]]-[[9999]]"/>
                                    <small class="help-block">Tanggal-Bulan-Tahun</small>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Anak 6</label>
                                    <input type="text" class="form-control" name="child_6" value=""/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Lahir Anak 6</label>
                                    <input value="" type="text" class="form-control" name="lahir_child_6" data-plugin="formatter" data-pattern="[[99]]-[[99]]-[[9999]]"/>
                                    <small class="help-block">Tanggal-Bulan-Tahun</small>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Anak 7</label>
                                    <input type="text" class="form-control" name="child_7" value=""/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Lahir Anak 7</label>
                                    <input value="" type="text" class="form-control" name="lahir_child_7" data-plugin="formatter" data-pattern="[[99]]-[[99]]-[[9999]]"/>
                                    <small class="help-block">Tanggal-Bulan-Tahun</small>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Anak 8</label>
                                    <input type="text" class="form-control" name="child_8" value=""/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="floating-label">Lahir Anak 8</label>
                                    <input value="" type="text" class="form-control" name="lahir_child_8" data-plugin="formatter" data-pattern="[[99]]-[[99]]-[[9999]]"/>
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

    <script src="{{ asset('/vendor/toastr/toastr.js') }}"></script>
    <script src="{{ asset('/js/components/toastr.js') }}"></script>
    <script src="{{ asset('/js/components/formatter-js.js') }}"></script>

    <script>
        $(function(){

            $('#nama_pegawai').focus();

            $('#position').select2();

            var notif = "{{ Session::has('info') or '' }}";

            if(notif != ''){
                toastr.success("{{ Session::get('info') }}", 'Info',{
                    positionClass : 'toast-top-full-width',
                });
            };


//            $('#form_new_stakeholder').formValidation({
//                framework: "bootstrap",
//                button: {
//                    selector: '#submit_new_stakeholder',
//                    disabled: 'disabled'
//                },
//                icon: null,
//                fields: {
//                    nama: {
//                        validators: {
//                            notEmpty: {
//                                message: 'The full name is required and cannot be empty'
//                            }
//                        }
//                    },
//                    tempat_lahir: {
//                        validators: {
//                            notEmpty: {
//                                message: 'The content address is required and cannot be empty'
//                            }
//                        }
//                    },
//                    tanggal_lahir: {
//                        validators: {
//                            notEmpty: {
//                                message: 'The content address is required and cannot be empty'
//                            }
//                        }
//                    },
//                    mulai_kerja: {
//                        validators: {
//                            notEmpty: {
//                                message: 'The content address is required and cannot be empty'
//                            }
//                        }
//                    },
//                    jenis_kelamin: {
//                        validators: {
//                            notEmpty: {
//                                message: 'The content is required and cannot be empty'
//                            }
//                        }
//                    },
//                    status: {
//                        validators: {
//                            notEmpty: {
//                                message: 'The content is required and cannot be empty'
//                            }
//                        }
//                    },
//                    nrp: {
//                        validators: {
//                            notEmpty: {
//                                message: 'The content is required and cannot be empty'
//                            }
//                        }
//                    },
//                    jenis_kelamin: {
//                        validators: {
//                            notEmpty: {
//                                message: 'The content is required and cannot be empty'
//                            }
//                        }
//                    },
//                    status_kepegawaian: {
//                        validators: {
//                            notEmpty: {
//                                message: 'The content is required and cannot be empty'
//                            }
//                        }
//                    },
//                    status_marital: {
//                        validators: {
//                            notEmpty: {
//                                message: 'The content is required and cannot be empty'
//                            }
//                        }
//                    },
//                    golongan: {
//                        validators: {
//                            notEmpty: {
//                                message: 'The content is required and cannot be empty'
//                            }
//                        }
//                    },
//                    alamat_rumah: {
//                        validators: {
//                            notEmpty: {
//                                message: 'The content is required and cannot be empty'
//                            }
//                        }
//                    },
//                    alamat_sekarang: {
//                        validators: {
//                            notEmpty: {
//                                message: 'The content is required and cannot be empty'
//                            }
//                        }
//                    },
//                    division_id: {
//                        validators: {
//                            notEmpty: {
//                                message: 'The content is required and cannot be empty'
//                            }
//                        }
//                    }
//                }
//            });

        })
    </script>
@stop