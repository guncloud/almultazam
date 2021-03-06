@extends('siswa::layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-bootstrap/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-fixedheader/dataTables.fixedHeader.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-responsive/dataTables.responsive.css') }}">
@stop

@section('content')

    <div class="page animsition">

        <!-- Modal -->
        <div class="modal fade" id="modalAddEkskul" aria-hidden="true" aria-labelledby="AddSubject" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-sidebar modal-sm">
                <div class="modal-content">
                    <form action="{{ url('/siswa/achievement') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Tambah Data Asrama </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" id="student" placeholder="Nama Siswa">
                                <input type="hidden" name="student_id" id="student_id">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="achievement" placeholder="Prestasi">
                            </div>
                            <div class="form-group">
                                <textarea name="info" id="" cols="30" rows="10" class="form-control" placeholder="Info Prestasi"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" name="date" id="date" class="form-control" placeholder="Tanggal">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-block">Save changes</button>
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="page-header">
            <h4 class="page-title">{{ $title or 'Judul' }}</h4>
            <div class="page-header-actions">
                <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-target="#modalAddEkskul" data-toggle="modal"
                        data-toggle="tooltip" id="btnPopFormKelas">
                    <i class="icon wb-pencil" aria-hidden="true"></i> Tambah Prestasi
                </button>
            </div>
        </div>
        <div class="page-content">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $sub_title or null }}</h3>
                </div>
                <div class="panel-body">
                    @if($achievements)
                        <table class="table table-hover dataTable table-striped width-full" id="tableAchievement">
                            <thead>
                            <tr>
                                <th>Siswa</th>
                                <th>Prestasi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($achievements as $eks)
                                <tr>
                                    <td>{{ $eks->nama }}</td>
                                    <td>
                                        @foreach($eks->achievements as $ach)
                                            <b><i>{{ $ach->achievement }}</i></b>
                                            <p>{{ $ach->info }} <small><i>{{ $ach->date }}</i></small> </p>
                                        @endforeach
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No data</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('/js/jquery.autocomplete.js') }}"></script>
    <script src="{{ asset('/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/vendor/datatables-fixedheader/dataTables.fixedHeader.js') }}"></script>
    <script src="{{ asset('/vendor/datatables-bootstrap/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('/vendor/datatables-responsive/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('/vendor/datatables-tabletools/dataTables.tableTools.js') }}"></script>
    <script src="{{ asset('/js/components/datatables.js') }}"></script>

    <script>
        $(function(){

            var defaults = $.components.getDefaults("dataTable");

            var options = $.extend(true, {}, defaults, {
                "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [-1]
                }],
                "iDisplayLength": 5,
                "aLengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
                "oTableTools": {
                    "sSwfPath": "{{ asset('/vendor/datatables-tabletools/swf/copy_csv_xls_pdf.swf') }}"
                }
            });

            $('#tableAchievement').dataTable(options);

            $('#student').autocomplete({
                serviceUrl: "{{ url('/siswa/student/search') }}",
                onSelect: function (suggestion) {
                    {{--window.location.href = "{{ url('/siswa') }}/"+suggestion.data;--}}
                    $('#student_id').val(suggestion.data);
                }
            });

            $('#date').datepicker({
                format : 'yyyy-mm-dd',
                orionttation : 'bottom',
                autoclose : true
            });

        })
    </script>
@stop