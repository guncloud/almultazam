@extends('siswa::layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-bootstrap/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-fixedheader/dataTables.fixedHeader.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-responsive/dataTables.responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/webui-popover/webui-popover.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/toolbar/toolbar.css') }}">
@endsection

@section('content')

    <div class="page animsition">

       <div class="page-header">
            <h4 class="page-title">{{ $title or 'Judul' }},
                <small>
                    @if(isset($_GET['byClassroom']))
                        {{ $students[0]->classroom }}
                    @else
                        All
                    @endif
                </small>
            </h4>
            <div class="page-header-actions">
                <form action="{{ url('/siswa/attendance') }}" method="get" class="form-inline">
                    @if($classrooms)
                        <div class="form-group">
                            <input type="text" class="form-control" id="date" name="date" value="{{ $_GET['date'] or '' }}">
                        </div>
                        <div class="form-group">
                            <select name="kelas" id="kelas" class="form-control" placeholder="Pilih Kelas">
                                <option >Pilih Kelas</option>
                                @foreach($classrooms as $cls)
                                    <option value="{{ $cls->id }}">{{ $cls->classroom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    @else
                        <p>Data kelas tidak ada</p>
                    @endif
                </form>
            </div>
        </div>

        <div class="toolbar-icons hidden" id="user-options">
            <a id="user-status" href="#"><i class="icon wb-user" aria-hidden="true"></i></a>
            <a id="user-edit" href="#"><i class="icon wb-edit" aria-hidden="true"></i></a>
            <a href="#"><i class="icon wb-trash" aria-hidden="true"></i></a>
        </div>

        <div class="page-content">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $sub_title or null }}</h3>
                </div>
                <div class="panel-body">
                    @if($students)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Siswa</th>
                                    <th>Status Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                            <form action="{{ url('/siswa/attendance') }}" method="post">
                                <input type="hidden" name="date" id="date" class="form-control" value="{{ $_GET['date'] or '' }}"/>
                                <input type="hidden" name="classroom" id="classroom" class="form-control" value="{{ $_GET['kelas'] or '' }}"/>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                @foreach($students as $std)
                                    <tr>
                                        <td>{{ $std->nama }}</td>
                                        <td>
                                            <input type="radio" value="hadir" @if(@$attendances[$std->student_id] == 'hadir') checked @else(@$attendances[$std->student_id] == '') checked @endif name="ket[{{ $std->student_id }}]"/> Hadir
                                            <input type="radio" value="sakit" @if(@$attendances[$std->student_id] == 'sakit') checked @endif name="ket[{{ $std->student_id }}]"/> Sakit
                                            <input type="radio" value="izin" @if(@$attendances[$std->student_id] == 'izin') checked @endif name="ket[{{ $std->student_id }}]"/> Izin
                                            <input type="radio" value="alpa" @if(@$attendances[$std->student_id] == 'alpa') checked @endif name="ket[{{ $std->student_id }}]"/> Alpa
                                        </td>
                                    </tr>
                                @endforeach
                                <button class="btn btn-primary btn-fixed btn-floating" type="submit">Save</button>
                            </form>
                            </tbody>
                        </table>
                    @else
                        Please pick a date and class
                    @endif
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="{{ asset('/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/vendor/datatables-fixedheader/dataTables.fixedHeader.js') }}"></script>
    <script src="{{ asset('/vendor/datatables-bootstrap/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('/vendor/datatables-responsive/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('/vendor/datatables-tabletools/dataTables.tableTools.js') }}"></script>
    <script src="{{ asset('/vendor/webui-popover/jquery.webui-popover.min.js') }}"></script>
    <script src="{{ asset('/vendor/toolbar/jquery.toolbar.min.js') }}"></script>
    <script src="{{ asset('/js/components/datatables.js') }}"></script>
    <script src="{{ asset('/js/components/webui-popover.js') }}"></script>
    <script src="{{ asset('/js/components/toolbar.js') }}"></script>

    <script>
        $(function(){

            $('#date').datepicker({
                format : 'yyyy-mm-dd',
                orionttation : 'bottom',
                autoclose : true
            });

            $(document).ready(function() {

                var tableContent = $('#popFormExcel').html(),
                        tableSettings = {
                            title: 'Import data siswa',
                            content: tableContent,
                            width: 500,
                            animation : 'pop'
                        };

                $('#btnPopFormExcel').webuiPopover($.extend({}, defaults,
                        tableSettings));

                var tableContentKelas = $('#popFormKelasTanggal').html(),
                        tableSettings = {
                            title: 'Filter per kelas',
                            content: tableContentKelas,
                            width: 500,
                            animation : 'pop'
                        };

                $('#btnPopFormKelasTanggal').webuiPopover($.extend({}, defaults,
                        tableSettings));

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

                $('#tableStakeholder').dataTable(options);
            });
        })
    </script>
@endsection