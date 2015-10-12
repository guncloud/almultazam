@extends('hrd::layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/toastr/toastr.css') }}">
@stop

@section('content')

    <div class="page animsition">
        <div class="page-header">
            <h4 class="page-title">{{ $title or 'Judul' }}</h4>
            <div class="page-header-actions">
                <form action="{{ url('/hrd/report') }}" method="get" class="form-inline" autocomplete="off">
                    <div class="form-group">
                        <input type="text" class="form-control" id="stakeholder" name="stakeholder" placeholder="Pengurus / Pegawai">
                        <input type="hidden" name="stakeholder_id" id="stakeholder_id">
                    </div>
                    <div class="form-group">
                        <select name="semester" id="semester" class="form-control">
                            <option selected >Pilih Semester</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="page-content">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $stakeholder->nama or '' }}</h3>
                    @if($stakeholder)
                        <div class="page-header-actions"><br>
                            <form action="{{ url('/tool/save-pdf-report-stakeholder') }}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                <input type="hidden" name="semester" value="{{ $_GET['semester'] or '' }}">
                                <input type="hidden" name="stakeholder" value="{{ $_GET['stakeholder_id'] or '' }}">
                                <div class="form-group">
                                    <button class="btn btn-info btn-rounded" type="submit">
                                        <i class="icon wb-print"></i>
                                        Save Pdf</button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="panel-body">
                    @if($stakeholder)
                        <div class="row">
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                NRP : {{ $stakeholder->nrp }} <br>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                Bagian : {{ $stakeholder->division->division }} <br >
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                Jabatan : {{ $stakeholder->jabatan }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            	@if($report)
                                <form action="{{ url('/hrd/report') }}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                    <input type="hidden" name="semester" value="{{ $_GET['semester'] or '' }}">
                                    <input type="hidden" name="stakeholder" value="{{ $_GET['stakeholder_id'] or '' }}">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Kriteria</th>
                                                <th>Indikator</th>
                                                <th>Skor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($report as $rpt)
                                                <tr>
                                                    <td>{{ $rpt->indicator }}</td>
                                                    <td>
                                                        @foreach($rpt->performances as $v)
                                                            <div class="form-group form-material">
                                                                <input type="text" class="form-control input-sm" id="inputDisabled" value="{{ $v->performance }}" disabled>
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach($rpt->performances as $v)
                                                            <div class="form-group form-material">
                                                                <input type="text" class="form-control input-sm" name="score[{{ $v->id }}]" value="{{ @$reportScores[$v->id]->score }}"/>
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <button class="btn btn-floating btn-primary btn-fixed">
                                        <i class="icon wb-check-circle"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    @else
                        Please, pick a person
                    @endif
                </div>
            </div>
        </div>
    </div>

@stop


@section('js')
    <script src="{{ asset('/js/jquery.autocomplete.js') }}"></script>
    <script src="{{ asset('/vendor/toastr/toastr.js') }}"></script>
    <script src="{{ asset('/js/components/toastr.js') }}"></script>

    <script>
        $(function(){
            var notif = "{{ Session::has('info') or '' }}";
            console.log(notif);
            if(notif != ''){
                toastr.success("{{ Session::get('info') }}", 'Info',{
                    positionClass : 'toast-top-full-width',
                });
            }

            $('#stakeholder').autocomplete({
                serviceUrl: "{{ url('/hrd/stakeholder/search') }}",
                onSelect: function (suggestion) {
                    {{--window.location.href = "{{ url('/siswa') }}/"+suggestion.data;--}}
                    $('#stakeholder_id').val(suggestion.data);
                }
            });

        })
    </script>
@stop