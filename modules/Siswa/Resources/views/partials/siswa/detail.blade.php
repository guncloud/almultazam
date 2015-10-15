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
            <ul class="list-group list-group-bordered">
                <li class="list-group-item">
                    <a href="{{ url('/tool/save-pdf-detail-student/'.$student->id.'?q=biodata') }}"> <i class="icon wb-download"></i> Biodata</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ url('/tool/save-pdf-detail-student/'.$student->id.'?q=akademik' )}}"><i class="icon wb-download"></i> Nilai Akademik</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ url('/tool/save-pdf-detail-student/'.$student->id.'?q=ekskul')}}"><i class="icon wb-download"></i> Ekskul</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ url('/tool/save-pdf-detail-student/'.$student->id.'?q=pelanggaran' )}}"><i class="icon wb-download"></i> Pelanggaran</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ url('/tool/save-pdf-detail-student/'.$student->id.'?q=prestasi' )}}"><i class="icon wb-download"></i> Prestasi</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ url('/tool/save-pdf-detail-student/'.$student->id.'?q=full' )}}"><i class="icon wb-download"></i> Komplit</a>
                </li>
            </ul>
        </div>

         <div class="page-content container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Page Widget -->
                    <div class="widget widget-shadow text-center">
                        <div class="widget-header">
                            <div class="widget-header-content">
                                {{--<a class="avatar avatar-lg" href="javascript:void(0)">--}}
                                    {{--<img src="{{ asset('/portraits/5.jpg') }}" alt="...">--}}
                                {{--</a>--}}
                                <div class="profile-user">{{ $student->nama }}, <small>{{ ($student->jenis_kelamin == 'l') ? 'Laki - laki' : 'Perempuan' }}</small></div>
                                <div class="profile-job">
                                    <ul class="list-unstyled">
                                        @foreach($student->classrooms as $cls)
                                            <li>{{ $cls->classroom }}</li>
                                        @endforeach
                                            <li>
                                                <i class="icon fa-mobile" aria-hidden="true"></i> {{ $student->telepon }}
                                            </li>
                                            <li>
                                                <i class="icon fa-phone"></i> {{ $student->handphone }}
                                            </li>
                                            <li>
                                                <i class="icon wb-envelope"></i> {{ $student->email }}
                                            </li>
                                    </ul>
                                </div>
                                <table class="table" style="font-size: 12px">
                                    <tr>
                                        <td>NIS</td>
                                        <td>{{ $student->nis }}</td>
                                    </tr>
                                    <tr>
                                        <td>NISN</td>
                                        <td>{{ $student->nisn }}</td>
                                    </tr>
                                    <tr>
                                        <td>NIK</td>
                                        <td>{{ $student->nik }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kelahiran</td>
                                        <td>{{ $student->tempat_lahir }}, {{ $student->tanggal_lahir }}</td>
                                    </tr>
                                </table>
                                <p>
                                    {{ $student->alamat }}
                                </p>
                            </div>
                        </div>
                        <div class="widget-footer">
                            {{--<div class="row no-space">--}}
                                {{--<div class="col-xs-6">--}}
                                    {{--<strong class="profile-stat-count">260</strong>--}}
                                    {{--<span>Pelanggaran</span>--}}
                                {{--</div>--}}
                                {{--<div class="col-xs-6">--}}
                                    {{--<strong class="profile-stat-count">180</strong>--}}
                                    {{--<span>Prestasi</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
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
                                    <a data-toggle="tab" href="#akademik" aria-controls="akademik" role="tab">Akademik</a>
                                </li>
                                <li role="presentation">
                                    <a data-toggle="tab" href="#ekskul" aria-controls="ekskul" role="tab">Ekskul</a>
                                </li>
                                <li role="presentation">
                                    <a data-toggle="tab" href="#pelanggaran" aria-controls="pelanggaran" role="tab">Pelanggaran</a>
                                </li>
                                <li role="presentation">
                                    <a data-toggle="tab" href="#prestasi" aria-controls="prestasi" role="tab">Prestasi</a>
                                </li>
                                <li class="pull-right">
                                    <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round"
                                            data-toggle="tooltip" data-original-title="Menu" id="btnPopMenu" href="javascript:void(0)">
                                        <i class="icon wb-menu" aria-hidden="true"></i>
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="akademik" role="tabpanel">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            @if($contracts)
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>M. Pelajaran</th>
                                                            <th>UH 1</th>
                                                            <th>UH 2</th>
                                                            <th>UH 3</th>
                                                            <th>UH 4</th>
                                                            <th>UTS</th>
                                                            <th>UAS</th>
                                                            <th>Skor</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($contracts as $v)
                                                        <tr>
                                                            <td>{{ $v->subject }} SM : {{ $v->semester }}</td>
                                                            <td>{{ @$scores[$v->id]->uh_1 }}</td>
                                                            <td>{{ @$scores[$v->id]->uh_2 }}</td>
                                                            <td>{{ @$scores[$v->id]->uh_3 }}</td>
                                                            <td>{{ @$scores[$v->id]->uh_4 }}</td>
                                                            <td>{{ @$scores[$v->id]->uts }}</td>
                                                            <td>{{ @$scores[$v->id]->uas }}</td>
                                                            <td>
                                                                {{ @$scores[$v->id]->skor }}
                                                                @if(@$scores[$v->id]->skor < 50)
                                                                    <span class="badge badge-danger">E</span>
                                                                @elseif(@$scores[$v->id]->skor < 58)
                                                                    <span class="badge badge-warning">D</span>
                                                                @elseif(@$scores[$v->id]->skor < 66)
                                                                    <span class="badge badge-default">C</span>
                                                                @elseif(@$scores[$v->id]->skor <= 75)
                                                                    <span class="badge badge-primary">B</span>
                                                                @elseif(@$scores[$v->id]->skor > 76)
                                                                    <span class="badge badge-success">A</span>
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        </li>

                                    </ul>
                                </div>

                                <div class="tab-pane" id="ekskul" role="tabpanel">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            @if($ekskuls)
                                                @foreach($ekskuls as $eks)
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ $eks->ekskul }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <th>Tanggal</th>
                                                            <th>Kehadiran</th>
                                                            <th>Skor</th>
                                                        </tr>
                                                            @if($ekskulStudent)
                                                                @foreach($ekskulStudent as $eksStd)
                                                                    <tr>
                                                                        <td></td>
                                                                        <td>{{ $eksStd->date }}</td>
                                                                        <td>{{ $eksStd->attendance }}</td>
                                                                        <td>{{ $eksStd->score }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                @endforeach
                                            @endif
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane" id="pelanggaran" role="tabpanel">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <ul>
                                                @foreach($student->violations as $v)

                                                    <li>
                                                        {{ $v->violation }}
                                                        <p>{{ $v->point }} poin, tanggal {{ $v->date }}</p>
                                                    </li>

                                                @endforeach
                                            </ul>
                                        </li>

                                    </ul>
                                </div>

                                <div class="tab-pane" id="prestasi" role="tabpanel">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <ul>
                                                @foreach($student->achievements as $v)

                                                    <li>
                                                        {{ $v->achievement }}
                                                        <p>{{ $v->info }} poin, tanggal {{ $v->date }}</p>
                                                    </li>

                                                @endforeach
                                            </ul>
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

                var listContent = $('#popMenu').html(),
                        listSettings = {
                            content: listContent,
                            title: 'Save as pdf',
                            padding: false,
                            animation : 'pop'
                        };

                $('#btnPopMenu').webuiPopover($.extend({}, defaults,
                        listSettings));
            });

        })
    </script>
@stop