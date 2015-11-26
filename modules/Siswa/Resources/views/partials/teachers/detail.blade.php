@extends('siswa::layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/pages/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/webui-popover/webui-popover.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/toolbar/toolbar.css') }}">
    @endsection

    @section('content')
            <!-- Page -->
    <div class="page animsition page-profile">

        <div class="hidden" id="popMenu">
            <form class="form-inline " enctype="multipart/form-data" method="post" action="{{ url('/siswa/utility/upload-siswa') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <a href="{{ url('/tool/pdf-profile-stakeholder/'.$stakeholder->id) }}" class="btn btn-primary" type="button">Save PDF</a>
                </div>
            </form>
        </div>

        <div class="page-content container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Page Widget -->
                    <div class="widget widget-shadow text-center">
                        <div class="widget-header">
                            <div class="widget-header-content">
                                <a class="avatar avatar-lg" href="javascript:void(0)">
                                    @if($stakeholder->photo)
                                        <img src="{{ asset('/photos/'.$stakeholder->photo) }}" alt="...">
                                    @else
                                        <img src="{{ asset('/photos/5.jpg') }}" alt="...">
                                    @endif
                                </a>
                                <div class="profile-user">{{ @$stakeholder->nama }}, <small>{{ (@$stakeholder->jenis_kelamin == 'l') ? 'Laki - laki' : 'Perempuan' }}</small></div>
                                <div class="profile-job">
                                    <ul class="list-unstyled">
                                        <li>
                                            <i class="icon wb-envelope"></i> {{ @$stakeholder->email }}
                                        </li>
                                        <li>
                                            <i class="icon wb-mobile"></i> {{ @$stakeholder->kontak }}
                                        </li>
                                    </ul>
                                </div>
                                <table class="table" style="font-size: 12px">
                                    <tr>
                                        <td>KTP</td>
                                        <td>{{ $stakeholder->ktp }}</td>
                                    </tr>
                                    <tr>
                                        <td>NRP</td>
                                        <td>{{ $stakeholder->nrp }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kelahiran</td>
                                        <td>{{ $stakeholder->tempat_lahir }}, {{ $stakeholder->tanggal_lahir }}</td>
                                    </tr>
                                </table>
                                <p>
                                    {{ $stakeholder->alamat }}
                                </p>

                            </div>
                        </div>
                    </div>
                    <!-- End Page Widget -->
                </div>

                <div class="col-md-9">
                    <!-- Panel -->
                    <div class="panel">
                        <div class="panel-body">

                            <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                                <li class="active" role="presentation">
                                    <a data-toggle="tab" href="#profile" aria-controls="profile" role="tab">Profil</a>
                                </li>
                                <li role="presentation">
                                    <a data-toggle="tab" href="#sekolah" aria-controls="sekolah" role="tab">Sekolah</a>
                                </li>
                                <li role="presentation">
                                    <a data-toggle="tab" href="#status" aria-controls="status" role="tab">Status</a>
                                </li>
                                <li role="presentation">
                                    <a data-toggle="tab" href="#etc" aria-controls="etc" role="tab">Lain - lain</a>
                                </li>
                                <li class="pull-right">
                                    <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round"
                                            data-toggle="tooltip" data-original-title="Menu" id="btnPopMenu" href="javascript:void(0)">
                                        <i class="icon wb-menu" aria-hidden="true"></i>
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="profile" role="tabpanel">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="media media-lg">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Alamat Rumah</h4>
                                                    <p>
                                                        {{ $stakeholder->alamat_rumah }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media media-lg">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Alamat Sekarang</h4>
                                                    <p>
                                                        {{ $stakeholder->alamat_sekarang }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media media-lg">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Marital</h4>
                                                    <p>
                                                        {{ $stakeholder->status_marital }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media media-lg">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Nama Suami / Istri</h4>
                                                    <p>
                                                        {{ $stakeholder->alamat_rumah }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media media-lg">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Pekerjaan Keluarga</h4>
                                                    <p>
                                                        {{ $stakeholder->pekerjaan_keluarga }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane" id="sekolah" role="tabpanel">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="media">
                                                <h4 class="media-heading">TK</h4>
                                                <p>
                                                    {{ $stakeholder->tk }}
                                                </p>
                                            </div>
                                            <div class="media">
                                                <h4 class="media-heading">SD</h4>
                                                <p>
                                                    {{ $stakeholder->sd }}
                                                </p>
                                            </div>
                                            <div class="media">
                                                <h4 class="media-heading">SMP</h4>
                                                <p>
                                                    {{ $stakeholder->smp }}
                                                </p>
                                            </div>
                                            <div class="media">
                                                <h4 class="media-heading">SMA</h4>
                                                <p>
                                                    {{ $stakeholder->sma }}
                                                </p>
                                            </div>
                                            <div class="media">
                                                <h4 class="media-heading">Diploma</h4>
                                                <p>
                                                    {{ $stakeholder->universitas_diploma }}
                                                </p>
                                            </div>
                                            <div class="media">
                                                <h4 class="media-heading">S1</h4>
                                                <p>
                                                    {{ $stakeholder->universitas_s1 }}
                                                </p>
                                            </div>
                                            <div class="media">
                                                <h4 class="media-heading">S2</h4>
                                                <p>
                                                    {{ $stakeholder->universitas_s2 }}
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane" id="status" role="tabpanel">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="media media-lg">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Status Kepegawaian</h4>
                                                    <p>
                                                        {{ $stakeholder->status_kepegawaian }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media media-lg">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Divisi/Bagian</h4>
                                                    <p>
                                                        {{ @$stakeholder->division->division }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media media-lg">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Jabatan</h4>
                                                    <p>
                                                        @foreach($positions as $pos)
                                                            {{ $pos->position }}
                                                        @endforeach
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media media-lg">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Mulai Kerja</h4>
                                                    <p>
                                                        {{ $stakeholder->mulai_kerja }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media media-lg">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Golongan</h4>
                                                    <p>
                                                        {{ $stakeholder->golongan }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                                </div>

                                <div class="tab-pane" id="etc" role="tabpanel">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="media media-lg">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Pendidikan Non Formal</h4>
                                                    <ul class="list-unstyled">
                                                        <li>{{ $stakeholder->nama_lembaga_1 }} {{ $stakeholder->pendidikan_lembaga_1 }}</li>
                                                        <li>{{ $stakeholder->nama_lembaga_2 }} {{ $stakeholder->pendidikan_lembaga_2 }}</li>
                                                        <li>{{ $stakeholder->nama_lembaga_3 }} {{ $stakeholder->pendidikan_lembaga_3 }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media media-lg">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Pengalaman Kerja</h4>
                                                    <ul class="list-unstyled">
                                                        <li>{{ $stakeholder->lembaga_pengalaman_kerja_1 }} {{ $stakeholder->alamat_pengalaman_kerja_1 }} {{ $stakeholder->jabatan_pengalaman_kerja_1 }} {{ $stakeholder->awal_kerja_1 }} {{ $stakeholder->akhir_kerja_1 }}</li>
                                                        <li>{{ $stakeholder->lembaga_pengalaman_kerja_2 }} {{ $stakeholder->alamat_pengalaman_kerja_2 }} {{ $stakeholder->jabatan_pengalaman_kerja_1 }} {{ $stakeholder->awal_kerja_2 }} {{ $stakeholder->akhir_kerja_2 }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media media-lg">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Pengalaman Organisasi</h4>
                                                    <ul class="list-unstyled">
                                                        <li>{{ $stakeholder->lembaga_organisasi_1 }} {{ $stakeholder->jabatan_organisasi_1 }}</li>
                                                        <li>{{ $stakeholder->lembaga_organisasi_2 }} {{ $stakeholder->jabatan_organisasi_2 }}</li>
                                                        <li>{{ $stakeholder->lembaga_organisasi_3 }} {{ $stakeholder->jabatan_organisasi_3 }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media media-lg">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Keahlian</h4>
                                                    <ul class="list-unstyled">
                                                        <li>{{ $stakeholder->keahlian_1 }} </li>
                                                        <li>{{ $stakeholder->keahlian_2 }} </li>
                                                        <li>{{ $stakeholder->keahlian_3 }} </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media media-lg">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Anak</h4>
                                                    <ul class="list-unstyled">
                                                        <li>{{ $stakeholder->child_1 }} </li>
                                                        <li>{{ $stakeholder->child_2 }} </li>
                                                        <li>{{ $stakeholder->child_3 }} </li>
                                                        <li>{{ $stakeholder->child_4 }} </li>
                                                        <li>{{ $stakeholder->child_5 }} </li>
                                                        <li>{{ $stakeholder->child_6 }} </li>
                                                        <li>{{ $stakeholder->child_7 }} </li>
                                                        <li>{{ $stakeholder->child_8 }} </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Panel -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Page -->
@stop

@section('js')
    <script src="{{ asset('/vendor/webui-popover/jquery.webui-popover.min.js') }}"></script>
    <script src="{{ asset('/vendor/toolbar/jquery.toolbar.min.js') }}"></script>
    <script src="{{ asset('/js/components/webui-popover.js') }}"></script>
    <script src="{{ asset('/js/components/toolbar.js') }}"></script>

    <script>
        $(function(){
            $(document).ready(function() {

                var defaults = $.components.getDefaults("webuiPopover");

                var tableContent = $('#popMenu').html(),
                        tableSettings = {
                            title: 'Import data siswa',
                            content: tableContent,
                            width: 500,
                            animation: 'pop'
                        };

                $('#btnPopMenu').webuiPopover($.extend({}, defaults,
                        tableSettings));
            });

        })
    </script>
@stop