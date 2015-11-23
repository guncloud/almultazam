@extends('siswa::layouts.master')

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
                <div class="panel-body">
                    <form autocomplete="off" id="new_form" method="post" action="{{ url('/siswa/siswa/'.$student->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <input type="hidden" name="_method" value="PATCH">
                        <h4>Umum</h4>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nis" value="{{ $student->nis }}"/>
                                <label class="floating-label">Nis<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nama" value="{{ $student->nama }}"/>
                                <label class="floating-label">Nama</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nisn" value="{{ $student->nisn }}"/>
                                <label class="floating-label">NISN<span class="required">*</span></label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tempat_lahir" value="{{ $student->tempat_lahir }}"/>
                                <label class="floating-label">Tempat Lahir<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ $student->tanggal_lahir }}"/>
                                <label class="floating-label">Tanggal Lahir</label>
                            </div>
                            <div class="col-sm-4">
                                <select name="jenis_kelamin" id="" class="form-control">
                                    <option value="null"></option>
                                    <option value="l" {{ ($student->jenis_kelamin == 'l' ? 'selected' : '') }}>Laki-laki</option>
                                    <option value="p" {{ ($student->jenis_kelamin == 'p' ? 'selected' : '') }}>Perempuan</option>
                                </select>
                                <label class="floating-label">Jenis Kelamin</label>
                            </div>
                            <div class="col-sm-4">
                                <select name="classroom" id="" class="form-control">
                                    <option>&nbsp;</option>
                                    @if($classrooms)
                                        @foreach($classrooms as $cls)
                                            <option value="{{ $cls->id }}" {{ ($studentClass->classroom_id == $cls->id) ? 'selected' : '' }} >{{ $cls->classroom}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <label class="floating-label">Kelas<span class="required">*</span></label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nik" value="{{ $student->nik }}"/>
                                <label class="floating-label">Nik<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="alamat" value="{{ $student->alamat }}"/>
                                <label class="floating-label">Alamat</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="jenis_tinggal" value="{{ $student->jenis_tinggal }}"/>
                                <label class="floating-label">Jenis Tinggal<span class="required">*</span></label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="telepon" value="{{ $student->telepon }}"/>
                                <label class="floating-label">Telepon<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="handphone" value="{{ $student->handphone }}"/>
                                <label class="floating-label">Hand Phone</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="email" value="{{ $student->email }}"/>
                                <label class="floating-label">Email<span class="required">*</span></label>
                            </div>
                        </div>

                        <br>
                        <h4>Data Ayah</h4>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="ayah" value="{{ $student->ayah }}"/>
                                <label class="floating-label">Nama Ayah<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tahun_lahir_ayah" value="{{ $student->tahun_lahir_ayah }}"/>
                                <label class="floating-label">Tahun Lahir</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="jenjang_pendidikan_ayah" value="{{ $student->jenjang_pendidikan_ayah }}"/>
                                <label class="floating-label">Jenjang Pendidikan <span class="required">*</span></label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="pekerjaan_ayah" value="{{ $student->pekerjaan_ayah }}"/>
                                <label class="floating-label">Pekerjaan Ayah<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="penghasilan_ayah" value="{{ $student->penghasilan_ayah }}"/>
                                <label class="floating-label">Penghasilan Ayah</label>
                            </div>
                        </div>

                        <br>
                        <h4>Data Ibu</h4>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="ibu" value="{{ $student->ibu }}"/>
                                <label class="floating-label">Nama Ibu<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tahun_lahir_ibu" value="{{ $student->tahun_lahir_ibu }}"/>
                                <label class="floating-label">Tahun Lahir</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="jenjang_pendidikan_ibu" value="{{ $student->jenjang_pendidikan_ibu }}"/>
                                <label class="floating-label">Jenjang Pendidikan <span class="required">*</span></label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="pekerjaan_ibu" value="{{ $student->pekerjaan_ibu }}"/>
                                <label class="floating-label">Pekerjaan Ibu<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="skhun_ibu" value="{{ $student->skhun_ibu }}"/>
                                <label class="floating-label">SKHUN (Nomor)</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="radio" name="kps_ibu" id="kps_ibu" value="ya" {{  ($student->kps_ibu == 'ya') ? 'checked' : '' }}> Menerima KPS &nbsp;&nbsp;
                                <input type="radio" name="kps_ibu" id="kps_ibu" value="tidak" {{  ($student->kps_ibu == 'tidak') ? 'checked' : '' }}> Tidak Menerima KPS
                            </div>
                        </div>

                        <br>
                        <h4>Data Wali</h4>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="wali" value="{{ $student->wali }}"/>
                                <label class="floating-label">Nama Wali<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tahun_lahir_wali" value="{{ $student->tahun_lahir_wali }}"/>
                                <label class="floating-label">Tahun Lahir</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="jenjang_pendidikan_wali" value="{{ $student->jenjang_pendidikan_wali }}"/>
                                <label class="floating-label">Jenjang Pendidikan <span class="required">*</span></label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="pekerjaan_wali" value="{{ $student->pekerjaan_wali }}"/>
                                <label class="floating-label">Pekerjaan Wali<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="penghasilan_wali" value="{{ $student->penghasilan_wali }}"/>
                                <label class="floating-label">Penghasilan Wali</label>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-floating btn-fixed" type="submit">
                            <span class="icon wb-check"></span>
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
    <script src="{{ asset('/js/components/datatables.js') }}"></script>
    <script src="{{ asset('/vendor/toastr/toastr.js') }}"></script>
    <script src="{{ asset('/js/components/toastr.js') }}"></script>

    <script>
        $(function(){

            $('#tanggal_lahir').datepicker({
                format : 'yyyy-mm-dd',
            })
        });
    </script>
@stop