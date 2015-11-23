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
                    <form autocomplete="off" id="new_form" method="post" action="{{ url('/siswa/siswa') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <h4>Umum</h4>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nis" />
                                <label class="floating-label">Nis<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nama" />
                                <label class="floating-label">Nama</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nisn" />
                                <label class="floating-label">NISN<span class="required">*</span></label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tempat_lahir" />
                                <label class="floating-label">Tempat Lahir<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tanggal_lahir" id="tanggal_lahir"/>
                                <label class="floating-label">Tanggal Lahir</label>
                            </div>
                            <div class="col-sm-4">
                                <select name="jenis_kelamin" id="" class="form-control">
                                    <option value="null"></option>
                                    <option value="l">Laki-laki</option>
                                    <option value="p">Perempuan</option>
                                </select>
                                <label class="floating-label">Jenis Kelamin</label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nik" />
                                <label class="floating-label">Nik<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="alamat" />
                                <label class="floating-label">Alamat</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="jenis_tinggal" />
                                <label class="floating-label">Jenis Tinggal<span class="required">*</span></label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="telepon" />
                                <label class="floating-label">Telepon<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="handphone" />
                                <label class="floating-label">Hand Phone</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="email" />
                                <label class="floating-label">Email<span class="required">*</span></label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <select name="classroom" id="" class="form-control">
                                    <option>&nbsp;</option>
                                    @if($classrooms)
                                        @foreach($classrooms as $cls)
                                            <option value="{{ $cls->id }}">{{ $cls->classroom    }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <label class="floating-label">Kelas<span class="required">*</span></label>
                            </div>
                        </div>

                        <br>
                        <h4>Data Ayah</h4>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="ayah" />
                                <label class="floating-label">Nama Ayah<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tahun_lahir_ayah" />
                                <label class="floating-label">Tahun Lahir</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="jenjang_pendidikan_ayah" />
                                <label class="floating-label">Jenjang Pendidikan <span class="required">*</span></label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="pekerjaan_ayah" />
                                <label class="floating-label">Pekerjaan Ayah<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="penghasilan_ayah" />
                                <label class="floating-label">Penghasilan Ayah</label>
                            </div>
                        </div>

                        <br>
                        <h4>Data Ibu</h4>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="ibu" />
                                <label class="floating-label">Nama Ibu<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tahun_lahir_ibu" />
                                <label class="floating-label">Tahun Lahir</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="jenjang_pendidikan_ibu" />
                                <label class="floating-label">Jenjang Pendidikan <span class="required">*</span></label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="pekerjaan_ibu" />
                                <label class="floating-label">Pekerjaan Ibu<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="skhun_ibu" />
                                <label class="floating-label">SKHUN (Nomor)</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="radio" name="kps_ibu" id="kps_ibu" value="ya"> Menerima KPS &nbsp;&nbsp;
                                <input type="radio" name="kps_ibu" id="kps_ibu" value="tidak"> Tidak Menerima KPS
                            </div>
                        </div>

                        <br>
                        <h4>Data Wali</h4>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="wali" />
                                <label class="floating-label">Nama Wali<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tahun_lahir_wali" />
                                <label class="floating-label">Tahun Lahir</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="jenjang_pendidikan_wali" />
                                <label class="floating-label">Jenjang Pendidikan <span class="required">*</span></label>
                            </div>
                        </div>
                        <div class="form-group form-material floating row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="pekerjaan_wali" />
                                <label class="floating-label">Pekerjaan Wali<span class="required">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="penghasilan_wali" />
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

            {{--var notif = "{{ Session::has('info') or '' }}";--}}
            {{--console.log(notif);--}}
            {{--if(notif != ''){--}}
                {{--toastr.success("{{ Session::get('info') }}", 'Info',{--}}
                    {{--positionClass : 'toast-top-full-width',--}}
                {{--});--}}
            {{--};--}}

            $('#tanggal_lahir').datepicker({
                format : 'yyyy-mm-dd',
            })
        });
    </script>
@stop