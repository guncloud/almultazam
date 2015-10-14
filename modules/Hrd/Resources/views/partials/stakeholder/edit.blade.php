@extends('hrd::layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/formvalidation/formValidation.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/select2/select2.css') }}">
@stop

@section('content')

    <div class="page animsition">
        <div class="page-header">
            <h4 class="page-title">{{ $title or 'Judul' }}</h4>
        </div>
        <div class="page-content">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $sub_title or null }}</h3>
                </div>
                <div class="panel-body container-fluid">
                    <form autocomplete="off" id="form_new_stakeholder" method="post" enctype="multipart/form-data" action="{{ url('/hrd/stakeholder/'.$stakeholder->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <input type="hidden" name="_method" value="patch">

                        <h4>Umum</h4>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nama" value="{{ $stakeholder->nama }}"/>
                                <label class="floating-label">Nama<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="ktp" value="{{ $stakeholder->ktp }}"/>
                                <label class="floating-label">KTP</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tempat_lahir" value="{{ $stakeholder->tempat_lahir }}"/>
                                <label class="floating-label">Tempat Lahir<span class="required">*</span></label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">

                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" data-plugin="formatter" value="{{ $stakeholder->tanggal_lahir }}" data-pattern="[[9999]]-[[99]]-[[99]]"/>
                                <label class="floating-label">Tanggal Lahir<span class="required">*</span></label>
                                <small class="help-block">Tahun-Bulan-Tanggal</small>
                            </div>

                            <div class="col-sm-4">
                                <input {{ ($stakeholder->jenis_kelamin == 'l') ? 'checked' : '' }} value="l" type="radio" class="icheckbox-primary" id="inputRadiosUnchecked" name="jenis_kelamin" data-plugin="iCheck" data-radio-class="iradio_flat-blue" />
                                <label for="inputRadiosUnchecked">Laki - laki</label>
                                <input {{ ($stakeholder->jenis_kelamin == 'p') ? 'checked' : ''}} value="p" type="radio" class="icheckbox-primary" id="inputRadiosUnchecked" name="jenis_kelamin" data-plugin="iCheck" data-radio-class="iradio_flat-blue" />
                                <label for="inputRadiosUnchecked">Perempuan</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" readonly="" />
                                <input type="file" name="photo" value="{{ $stakeholder->photo }}" placeholder="{{ $stakeholder->photo }}"/>
                                <label class="floating-label">Poto</label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="alamat_rumah" value="{{ $stakeholder->alamat_rumah }}"/>
                                <label class="floating-label">Alamat Rumah<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="alamat_sekarang" value="{{ $stakeholder->alamat_sekarang }}"/>
                                <label class="floating-label">Alamat Sekarang<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="kontak" value="{{ $stakeholder->kontak }}"/>
                                <label class="floating-label">Kontak</label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <select name="status_marital" id="status_marital" class="form-control">
                                    <option></option>
                                    <option value="belum" {{ ($stakeholder->status_marital == 'belum') ? 'selected' : '' }}>Belum Menikah</option>
                                    <option value="menikah" {{ ($stakeholder->status_marital == 'menikah') ? 'selected' : '' }}>Menikah</option>
                                </select>
                                <label class="floating-label">Status Marital<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nama_istri_suami" value="{{ $stakeholder->nama_istri_suami }}"/>
                                <label class="floating-label">Nama Suami/Istri</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="pekerjaan_keluarga" value="{{ $stakeholder->pekerjaan_keluarga }}"/>
                                <label class="floating-label">Pekerjaan Keluarga</label>
                            </div>
                        </div>
                        <br>

                        {{--Kepegawaian--}}
                        <h4>Kepegawain</h4>
                        <hr>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-3">
                                <select name="division_id" id="" class="form-control">
                                    <option>&nbsp;</option>
                                    @foreach($divisions as $div)
                                        <option value="{{ $div->id }}" {{ ($stakeholder->division_id == $div->id) ? 'selected' : '' }}>{{ $div->division }}</option>
                                    @endforeach
                                </select>
                                <label class="floating-label">Divisi<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="aktif" {{ ($stakeholder->status == 'aktif') ? 'selected' : '' }}>Aktif</option>
                                    <option value="non-aktif" {{ ($stakeholder->status == 'non-aktif') ? 'selected' : '' }}>Non Aktif</option>
                                </select>
                                <label class="floating-label">Status<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="nrp" value="{{ $stakeholder->nrp }}"/>
                                <label class="floating-label">NRP<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="status_kepegawaian" value="{{ $stakeholder->status_kepegawaian }}"/>
                                <label class="floating-label">Status Kepegawaian<span class="required">*</span></label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <label for="">Jabatan</label>
                                <select name="position[]" class="form-control" multiple data-plugin="select2" id="position" placeholder="Jabatan">

                                    @if($positions)
                                        @if($position)
                                            @foreach($position as $pos)
                                                <option value="{{ $pos->id }}" selected>{{ $pos->position }}</option>
                                            @endforeach
                                        @endif
                                        @foreach($positions as $pos)
                                            <option value="{{ $pos->id }}">{{ $pos->position }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Tidak ada data jabatan</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="mulai_kerja" id="mulai_kerja" data-plugin="formatter" value="{{ $stakeholder->mulai_kerja }}" data-pattern="[[9999]]-[[99]]-[[99]]"/>
                                <label class="floating-label">Mulai Kerja<span class="required">*</span></label>
                                <small class="help-block">Tahun-Bulan-Tanggal</small>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="golongan" value="{{ $stakeholder->golongan }}"/>
                                <label class="floating-label">Golongan<span class="required">*</span></label>
                            </div>
                        </div>
                        <br>

                        {{--Akademik--}}
                        <h4>Pendidikan</h4>
                        <hr>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="tk" value="{{ $stakeholder->tk }}"/>
                                <label class="floating-label">TK</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="sd" value="{{ $stakeholder->sd }}"/>
                                <label class="floating-label">SD</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="smp" value="{{ $stakeholder->smp }}"/>
                                <label class="floating-label">SMP</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="sma" value="{{ $stakeholder->sma }}"/>
                                <label class="floating-label">SMA</label>
                            </div>
                        </div>

                        <div class="form-group form-material floating row">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="universitas_diploma" value="{{ $stakeholder->universitas_diploma }}"/>
                                <label class="floating-label">Diploma</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="fakultas_diploma" value="{{ $stakeholder->universitas_diploma }}"/>
                                <label class="floating-label">Fakultas</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="jurusan_diploma" value="{{ $stakeholder->universitas_diploma }}"/>
                                <label class="floating-label">Jurusan</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="program_pendidikan_diploma" value="{{ $stakeholder->universitas_diploma }}"/>
                                <label class="floating-label">Program Studi</label>
                            </div>
                        </div>

                        <div class="form-group form-material floating row">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="universitas_s1" value="{{ $stakeholder->universitas_s1 }}">
                                <label class="floating-label">Universitas S1</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="fakultas_s1" value="{{ $stakeholder->fakultas_s1 }}"/>
                                <label class="floating-label">Fakultas S1</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="jurusan_s1" value="{{ $stakeholder->jurusan_s1 }}"/>
                                <label class="floating-label">Jurusan S1</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="program_pendidikan_s1" value="{{ $stakeholder->program_pendidikan_s1 }}"/>
                                <label class="floating-label">Program Studi S1</label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="universitas_s2" value="{{ $stakeholder->universitas_s2 }}"/>
                                <label class="floating-label">Universitas S2</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="fakultas_s2" value="{{ $stakeholder->fakultas_s2 }}"/>
                                <label class="floating-label">Fakultas S2</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="jurusan_s2" value="{{ $stakeholder->jurusan_s2 }}"/>
                                <label class="floating-label">Jurusan S2</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="program_pendidikan_s2" value="{{ $stakeholder->program_pendidikan_s2 }}"/>
                                <label class="floating-label">Program Studi S2</label>
                            </div>
                        </div>
                        <br>
                        {{--/Akademik--}}

                        {{--Lembaga--}}
                        <h4>Pendidikan Non Formal</h4>
                        <hr>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="nama_lembaga_1" value="{{ $stakeholder->nama_lembaga_1 }}"/>
                                <label class="floating-label">Nama Lembaga 1</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="jenis_pendidikan_1" value="{{ $stakeholder->jenis_pendidikan_1 }}"/>
                                <label class="floating-label">Jenis Pendidikan </label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="nama_lembaga_2" value="{{ $stakeholder->nama_lembaga_2 }}"/>
                                <label class="floating-label">Nama Lembaga 2</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="jenis_pendidikan_2" value="{{ $stakeholder->jenis_pendidikan_2 }}"/>
                                <label class="floating-label">Jenis Pendidikan</label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="nama_lembaga_3" value="{{ $stakeholder->nama_lembaga_3 }}"/>
                                <label class="floating-label">Nama Lembaga 3</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="jenis_pendidikan_3" value="{{ $stakeholder->jenis_pendidikan_3 }}"/>
                                <label class="floating-label">Jenis Pendidikan</label>
                            </div>
                        </div>
                        <br>
                        {{--/Lembaga--}}

                        {{--Pengalaman Kerja--}}
                        <h4>Pengalaman Kerja</h4>
                        <hr>
                        <div class="form-group form-material floating row">
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="lembaga_pengalaman_kerja_1" value="{{ $stakeholder->lembaga_pengalaman_kerja_1 }}"/>
                                <label class="floating-label">Pengalaman Kerja 1</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="alamat_pengalaman_kerja_1" /value="{{ $stakeholder->alamat_pengalaman_kerja_1 }}">
                                <label class="floating-label">Alamat</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="jabatan_pengalaman_kerja_1" value="{{ $stakeholder->jabatan_pengalaman_kerja_1 }}"/>
                                <label class="floating-label">Jabatan</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="awal_kerja_1" value="{{ $stakeholder->awal_kerja_1 }}"/>
                                <label class="floating-label">Awal Kerja</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="akhir_kerja_1" value="{{ $stakeholder->akhir_kerja_1 }}"/>
                                <label class="floating-label">Akhir Kerja</label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="lembaga_pengalaman_kerja_2" value="{{ $stakeholder->lembaga_pengalaman_kerja_2 }}"/>
                                <label class="floating-label">Pengalaman Kerja 2</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="alamat_pengalaman_kerja_2" value="{{ $stakeholder->alamat_pengalaman_kerja_2 }}"/>
                                <label class="floating-label">Alamat</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="jabatan_pengalaman_kerja_2" value="{{ $stakeholder->jabatan_pengalaman_kerja_2 }}"/>
                                <label class="floating-label">Jabatan</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="awal_kerja_2" value="{{ $stakeholder->awal_kerja_2 }}"/>
                                <label class="floating-label">Awal Kerja</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="akhir_kerja_2" value="{{ $stakeholder->akhir_kerja_2 }}"/>
                                <label class="floating-label">Akhir Kerja</label>
                            </div>
                        </div>
                        <br>
                        {{--/Pengalaman Kerja--}}

                        {{--Organisasi--}}
                        <h4>Pengalaman Organisasi</h4>
                        <hr>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lembaga_organisasi_1" value="{{ $stakeholder->lembaga_organisasi_1 }}"/>
                                <label class="floating-label">Lembaga 1</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="jabatan_organisasi_1" value="{{ $stakeholder->jabatan_organisasi_1 }}"/>
                                <label class="floating-label">Jabatan</label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lembaga_organisasi_2" value="{{ $stakeholder->lembaga_organisasi_2 }}"/>
                                <label class="floating-label">Lembaga 2</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="jabatan_organisasi_2" value="{{ $stakeholder->jabatan_organisasi_2 }}"/>
                                <label class="floating-label">Jabatan</label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lembaga_organisasi_3" value="{{ $stakeholder->lembaga_organisasi_3 }}"/>
                                <label class="floating-label">Lembaga 3</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="jabatan_organisasi_3" value="{{ $stakeholder->jabatan_organisasi_3 }}"/>
                                <label class="floating-label">Jabatan</label>
                            </div>
                        </div>
                        <br>
                        {{--/Organisasi--}}

                        {{--Keahlian--}}
                        <h4>Keahlian</h4>
                        <hr>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="keahlian_1" value="{{ $stakeholder->keahlian_1 }}"/>
                                <label class="floating-label">Keahlian 1</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="keahlian_2" value="{{ $stakeholder->keahlian_2 }}"/>
                                <label class="floating-label">Keahlian 2</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="keahlian_3" value="{{ $stakeholder->keahlian_3 }}"/>
                                <label class="floating-label">Keahlian 3</label>
                            </div>
                        </div>
                        <br>
                        {{--/Keahlian--}}

                        {{--Anak--}}
                        <h4>Anak</h4>
                        <hr>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="child_1" value="{{ $stakeholder->child_1 }}"/>
                                <label class="floating-label">Anak 1</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="child_2" value="{{ $stakeholder->child_2 }}"/>
                                <label class="floating-label">Anak 2</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="child_3" value="{{ $stakeholder->child_3 }}"/>
                                <label class="floating-label">Anak 3</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="child_4" value="{{ $stakeholder->child_4 }}"/>
                                <label class="floating-label">Anak 4</label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="child_5" value="{{ $stakeholder->child_5 }}"/>
                                <label class="floating-label">Anak 5</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="child_6" value="{{ $stakeholder->child_6 }}"/>
                                <label class="floating-label">Anak 6</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="child_7" value="{{ $stakeholder->child_7 }}"/>
                                <label class="floating-label">Anak 7</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="child_8" value="{{ $stakeholder->child_8 }}"/>
                                <label class="floating-label">Anak 8</label>
                            </div>
                        </div>
                        {{--/Anak--}}

                        <button class="btn btn-floating btn-fixed" type="submit" id="submit_new_stakeholder">
                            <i class="icon wb-check" aria-hidden="true"></i>
                        </button>

                    </form>
                </div>
            </div>
        </div>
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

            var notif = "{{ Session::has('info') or '' }}";

            if(notif != ''){
                toastr.success("{{ Session::get('info') }}", 'Info',{
                    positionClass : 'toast-top-full-width',
                });
            };

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