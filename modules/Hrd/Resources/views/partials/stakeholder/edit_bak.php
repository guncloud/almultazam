@extends('hrd::layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('/vendor/formvalidation/formValidation.css') }}">
<link rel="stylesheet" href="{{ asset('/vendor/toastr/toastr.css') }}">
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
                <form autocomplete="off" id="form_new_stakeholder" method="post" action="{{ url('/hrd/stakeholder/'.$stakeholder->id) }}">
                    <input type="hidden" name="_method" value="patch">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                    <div class="form-group form-material floating row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="nama" value="{{ $stakeholder->nama }}"/>
                            <label class="floating-label">Nama<span class="required">*</span></label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="ktp" value="{{ $stakeholder->ktp }}"/>
                            <label class="floating-label">KTP</label>
                        </div>
                    </div>
                    <div class="form-group form-material floating row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="tempat_lahir" value="{{ $stakeholder->tempat_lahir }}"/>
                            <label class="floating-label">Tempat Lahir<span class="required">*</span></label>
                        </div>
                        <div class="col-sm-6">
                            <input value="{{ $stakeholder->tanggal_lahir }}" type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" data-plugin="formatter" data-pattern="[[9999]]-[[99]]-[[99]]"/>
                            <label class="floating-label">Tanggal Lahir<span class="required">*</span></label>
                            <small class="help-block">2015-01-01</small>
                        </div>
                    </div>
                    <div class="form-group form-material floating row">
                        <div class="col-sm-6">
                            <input {{ ($stakeholder->jenis_kelamin == 'l') ? 'checked' : '' }} value="l" type="radio" class="icheckbox-primary" id="inputRadiosUnchecked" name="jenis_kelamin" data-plugin="iCheck" data-radio-class="iradio_flat-blue" />
                            <label for="inputRadiosUnchecked">Laki - laki</label>
                            <input {{ ($stakeholder->jenis_kelamin == 'p') ? 'checked' : ''}} value="p" type="radio" class="icheckbox-primary" id="inputRadiosUnchecked" name="jenis_kelamin" data-plugin="iCheck" data-radio-class="iradio_flat-blue" />
                            <label for="inputRadiosUnchecked">Perempuan</label>
                        </div>
                        <div class="col-sm-6">
                            <select name="status" id="status" class="form-control">
                                <option></option>
                                <option value="aktif" {{ ($stakeholder->status == 'aktif') ? 'selected' : '' }}>Aktif</option>
                                <option value="non-aktif" {{ ($stakeholder->status == 'non-aktif') ? 'selected' : '' }}>Non Aktif</option>
                            </select>
                            <label class="floating-label">Status<span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="form-group form-material floating row">
                        <div class="col-sm-6">
                            <select name="division_id" id="" class="form-control">
                                <option>&nbsp;</option>
                                @foreach($divisions as $div)
                                <option value="{{ $div->id }}" {{ ($stakeholder->division_id == $div->id) ? 'selected' : '' }}>{{ $div->division }}</option>
                                @endforeach
                            </select>
                            <label class="floating-label">Divisi<span class="required">*</span></label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="photo" />
                            <label class="floating-label">Poto</label>
                        </div>
                    </div>
                    <div class="form-group form-material floating row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="nrp" value="{{ $stakeholder->nrp }}"/>
                            <label class="floating-label">NRP<span class="required">*</span></label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="asal_sekolah" value="{{ $stakeholder->asal_sekolah }}"/>
                            <label class="floating-label">Asal Sekolah<span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="form-group form-material floating row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="fakultas" value="{{ $stakeholder->fakultas }}"/>
                            <label class="floating-label">Fakultas</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="jurusan" value="{{ $stakeholder->jurusan }}"/>
                            <label class="floating-label">Jurusan</label>
                        </div>
                    </div>
                    <div class="form-group form-material floating row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="program_studi" value="{{ $stakeholder->program_studi }}"/>
                            <label class="floating-label">Program Studi</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="tahun_lulus" value="{{ $stakeholder->tahun_lulus }}"/>
                            <label class="floating-label">Tahun Lulus<span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="form-group form-material floating row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="status_kepegawaian" value="{{ $stakeholder->status_kepegawaian }}"/>
                            <label class="floating-label">Status Kepegawaian<span class="required">*</span></label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="jabatan" value="{{ $stakeholder->jabatan }}"/>
                            <label class="floating-label">Jabatan</label>
                        </div>
                    </div>
                    <div class="form-group form-material floating row">
                        <div class="col-sm-6">
                            <input value="{{ $stakeholder->mulai_kerja }}" type="text" class="form-control" name="mulai_kerja" id="mulai_kerja" data-plugin="formatter" data-pattern="[[9999]]-[[99]]-[[99]]"/>
                            <label class="floating-label">Mulai Kerja<span class="required">*</span></label>
                            <small class="help-block">2015-01-01</small>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="golongan" value="{{ $stakeholder->golongan }}"/>
                            <label class="floating-label">Golongan<span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="form-group form-material floating row">
                        <div class="col-sm-6">
                            <select name="status_marital" id="status_marital" class="form-control">
                                <option></option>
                                <option value="belum" {{ ($stakeholder->status_marital == 'belum') ? 'selected' : '' }}>Belum Menikah</option>
                                <option value="menikah" {{ ($stakeholder->status_marital == 'menikah') ? 'selected' : '' }}>Menikah</option>
                            </select>
                            <label class="floating-label">Status Marital<span class="required">*</span></label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="nama_istri_suami" value="{{ $stakeholder->nama_istri_suami }}"/>
                            <label class="floating-label">Nama Suami/Istri</label>
                        </div>
                    </div>
                    <div class="form-group form-material floating row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="jumlah_anak" value="{{ $stakeholder->jumlah_anak }}"/>
                            <label class="floating-label">Jumlah Anak</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="alamat_rumah" value="{{ $stakeholder->alamat_rumah }}"/>
                            <label class="floating-label">Alamat Rumah<span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="form-group form-material floating row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="alamat_sekarang" value="{{ $stakeholder->alamat_sekarang }}"/>
                            <label class="floating-label">Alamat Sekarang<span class="required">*</span></label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="kontak" value="{{ $stakeholder->kontak }}"/>
                            <label class="floating-label">Kontak</label>
                        </div>
                    </div>
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

<script src="{{ asset('/js/components/formatter-js.js') }}"></script>

<script>
    $(function(){

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