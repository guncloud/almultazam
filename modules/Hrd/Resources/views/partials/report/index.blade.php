@extends('hrd::layouts_2.master')

@section('content')

    <section class="content-header">
        <h1>
            {{ $title or 'Kepegawaian' }}
            <small> {{ $stakeholder->nama or '' }} </small>
        </h1>
        <ul class="breadcrumb">
            <li>
                <form action="{{ url('/hrd/report') }}" method="get" class="form-inline" autocomplete="off">
                    <div class="form-group">
                        <input type="text" class="form-control input-sm" id="stakeholder" name="stakeholder" placeholder="Pengurus / Pegawai">
                        <input type="hidden" name="stakeholder_id" id="stakeholder_id">
                    </div>
                    <div class="form-group">
                        <select name="semester" id="semester" class="form-control input-sm">
                            <option selected >Pilih Semester</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-sm" href="{{ url('/tool/export-report-pegawai') }}">Download Excel</a>
                    </div>
                    <button type="button" class="btn btn-sm btn-icon btn-default"
                            data-toggle="tooltip" data-original-title="Upload" id="btnPopFormExcel" href="javascript:void(0)">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                    </button>

                </form>
            </li>
        </ul>
    </section>

    <div class="hidden" id="popFormExcel">
        <form class=" " enctype="multipart/form-data" method="post" action="{{ url('/tool/upload-raport-pegawai') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <input type="file" name="upload_pegawai"  class="form-control">
            </div>
            <br>
            <br>

            <div class="form-group">
                <select name="semester" id="semester" class="form-control">
                    <option value="">Semester</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-info">Import</button>
            </div>
            <hr>
            <a class="btn btn-xs btn-info btn-block" href="{{ url('/tool/download-format-report-pegawai') }}">
                <i class="fa fa-download" aria-hidden="true"></i>
                Download Format Excel
            </a>
        </form>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-md-12">

                @if($showall)
                    @if($stakeholder)

                        <div class="box">
                            <div class="box-body">
                                <table class="table table-hover dataTable table-striped table-bordered width-full" id="tableStakeholder">
                                            <thead>
                                            <tr>
                                                <th class="no-sort">No</th>
                                                <th>Name</th>
                                                <th>Report</th>
                                                <th>Print</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($stakeholder as $i => $v)
                                                <tr>
                                                    <td class="no-sort">{{ $i+1 }}</td>
                                                    <td>{{ $v->nama }}</td>
                                                    <td class="col-md-2">
                                                        <a href="{{ url('/hrd/report?semester=1&stakeholder_id='.$v->id) }}" class="btn btn-success btn-sm" type="button">
                                                            Semester 1
                                                        </a>
                                                        <a href="{{ url('/hrd/report?semester=2&stakeholder_id='.$v->id) }}" class="btn btn-success btn-sm" type="button">
                                                            Semester 2
                                                        </a>
                                                    </td>
                                                    <td class="col-md-2">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <form action="{{ url('/tool/save-pdf-report-stakeholder') }}" method="post">
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                                                    <input type="hidden" name="semester" value="1">
                                                                    <input type="hidden" name="stakeholder" value="{{ $v->id }}">
                                                                    <div class="form-group">
                                                                        <button class="btn btn-info btn-sm" type="submit">
                                                                            <i class="icon wb-print"></i>
                                                                            Semester 1</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <form action="{{ url('/tool/save-pdf-report-stakeholder') }}" method="post">
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                                                    <input type="hidden" name="semester" value="2">
                                                                    <input type="hidden" name="stakeholder" value="{{ $v->id }}">
                                                                    <div class="form-group">
                                                                        <button class="btn btn-info btn-sm" type="submit">
                                                                            <i class="icon wb-print"></i>
                                                                            Semester 2</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                            </div>
                        </div>
                    @endif
                    @else
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">
                                    NRP : {{ $stakeholder->nrp }},
                                    Bagian : {{ @$stakeholder->division->division }},
                                    Jabatan :
                                    @if($stakeholder->positions)
                                        @foreach($stakeholder->positions as $pos)
                                            {{ $pos->position }},
                                        @endforeach
                                    @endif
                                </h3>
                                @if($stakeholder)
                                <div class="box-tools pull-left" style="top: 5px">
                                    <form class="form-inline" action="{{ url('/tool/save-pdf-report-stakeholder') }}" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                        <input type="hidden" name="semester" value="{{ $_GET['semester'] or '' }}">
                                        <input type="hidden" name="stakeholder" value="{{ $_GET['stakeholder_id'] or '' }}">
                                        <div class="form-group">
                                            <button class="btn btn-sm" type="submit">
                                                Save Pdf</button>
                                        </div>
                                    </form>
                                </div>
                                @endif
                            </div>
                            <div class="box-body">
                                @if($stakeholder)
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
                                                        <i class="fa fa-check"> Simpan</i>
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
                    @endif
            </div>
        </div>
    </div>

@stop


@section('js')
    <script src="{{ asset('/js/jquery.autocomplete.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(function(){
// var defaults = $.components.getDefaults("webuiPopover");

// var tableContent = $('#popFormExcel').html(),
//         tableSettings = {
//             title: 'Import data siswa',
//             content: tableContent,
//             width: 500,
//             animation : 'pop'
//         };

// $('#btnPopFormExcel').webuiPopover($.extend({}, defaults,
//         tableSettings));

            $('#btnPopFormExcel').popover({
                html :true,
                content : function(){
                    return $('#popFormExcel').html();
                },
                placement : 'bottom'
            });

            $('#stakeholder').autocomplete({
                serviceUrl: "{{ url('/hrd/stakeholder/search') }}",
                onSelect: function (suggestion) {
                    {{--window.location.href = "{{ url('/siswa') }}/"+suggestion.data;--}}
                    $('#stakeholder_id').val(suggestion.data);
                }
            });

            myTable = $('#tableStakeholder').dataTable({
                "columnDefs": [
                    {
                        "targets": "hide-column",
                        "visible": false,
                    },
                ],
                "order": [[ 1, 'asc' ]],
// "sDom": '<"dt-panelmenu clearfix">fr - lt<"dt-panelfooter clearfix"ip>',
// "oTableTools": {
//     "sSwfPath": "{{ asset('/vendor/datatables-tabletools/swf/copy_csv_xls_pdf.swf') }}"
// }
            });

            myTable.api().on('order.dt', function () {
                myTable.api().column(0, {order:'applied'}).nodes().each(function (cell, i) {
                    cell.innerHTML = i+1;
                });
            }).draw();

        })
    </script>
@stop