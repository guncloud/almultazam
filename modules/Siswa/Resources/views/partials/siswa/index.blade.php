@extends('siswa::layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-bootstrap/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-fixedheader/dataTables.fixedHeader.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-responsive/dataTables.responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/webui-popover/webui-popover.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/toolbar/toolbar.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap-sweetalert/sweet-alert.css') }}">
@endsection

@section('content')

    <div class="page animsition">

        <div class="hidden" id="popFormKelas">
            <form action="{{ url('/siswa/siswa') }}" method="get" class="pull-left">
                @if($classrooms)
                    <div class="form-group form-material floating">
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <div class="form-control-wrap">
                                <select name="byClassroom" id="byClassroom" class="form-control" placeholder="Pilih Kelas">
                                    <option value="">&nbsp;</option>
                                    @foreach($classrooms as $cls)
                                        <option value="{{ $cls->id }}">{{ $cls->classroom }}</option>
                                    @endforeach
                                </select>
                                <label class="floating-label">Kelas</label>
                            </div>
                            <span class="input-group-btn">
                              <button class="btn btn-outline btn-default" type="submit">Submit</button>
                            </span>
                        </div>
                    </div>
                @else
                    <p>Data kelas tidak ada</p>
                @endif
            </form>
        </div>

        <div class="hidden" id="popFormExcel">
            <form class="form-inline " enctype="multipart/form-data" method="post" action="{{ url('/tool/upload-siswa') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Import Excel</span>
                        <input type="file" name="upload_siswa"  class="form-control">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-info">Import</button>
                        </span>
                    </div><!-- /input-group -->
                    <br>
                    <br>
                    <a class="btn btn-xs btn-info btn-block" href="{{ url('/tool/download-format-siswa') }}">
                        <i class="icon wb-download" aria-hidden="true"></i>
                        Download Format Excel
                    </a>
                </div>
            </form>
        </div>
        <!-- End Pop with table -->


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
                <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round"
                        data-toggle="tooltip" data-original-title="Kelas" id="btnPopFormKelas" href="javascript:void(0)">
                    <i class="icon wb-wrench" aria-hidden="true"></i>
                </button>
                <a type="button" href="{{ url('/siswa/siswa/create') }}" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-toggle="tooltip" data-original-title="Add">
                    <i class="icon wb-pencil" aria-hidden="true"></i>
                </a>
                <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round"
                        data-toggle="tooltip" data-original-title="Upload" id="btnPopFormExcel" href="javascript:void(0)">
                    <i class="icon wb-upload" aria-hidden="true"></i>
                </button>
            </div>
        </div>

        <div class="page-content">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $sub_title or null }}</h3>
                </div>
                <div class="panel-body">
                    @if($students == false)
                        No data, You can import or add new data
                    @else
                        <table class="table table-hover dataTable table-striped width-full" id="tableStakeholder">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>NIS</th>
                                <th>NISN</th>
                                <th>NIK</th>
                                <th>J. Kelamin</th>
                                <th>Kontak</th>
                                <th class="col-md-2">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $i => $v)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $v->nama }}</td>
                                    <td>{{ $v->nis }}</td>
                                    <td>{{ $v->nisn }}</td>
                                    <td>{{ $v->nik }}</td>
                                    <td>{{ ($v->jenis_kelamin == 'l') ? 'Laki - laki' : 'Perempuan' }}</td>
                                    <td>{{ $v->telepon }} / {{ $v->handphone }}</td>
                                    <td>
                                        <form class="deleteForm" action="{{ url('/siswa/siswa/'.$v->student_id) }}" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                            <input type="hidden" name="_method" value="DELETE">
                                            @if(Auth::user()->is('admin') or Auth::user()->is('root'))

                                                <button href="{{ url('/siswa/siswa/'.$v->student_id) }}" class="btn btn-warning btn-sm deleteStudent tooltip-danger tooltip-rotate" data-toggle="tooltip" data-original-title="Delete Siswa !" title="" type="submit" id="deleteContract">
                                                    <i class="icon wb-trash"></i>
                                                </button>
                                                <a href="{{ url('/siswa/siswa/'.$v->student_id.'/edit') }}" class="btn btn-info btn-sm tooltip-info tooltip-rotate" data-toggle="tooltip" data-original-title="Update Siswa" title="" type="button">
                                                    <i class="icon wb-pencil"></i>
                                                </a>

                                            @endif
                                            <a href="{{ url('/siswa/siswa/'.$v->student_id) }}" class="btn btn-success btn-sm tooltip-success tooltip-rotate" data-toggle="tooltip" data-original-title="Detail Siswa" title="">
                                                <i class="icon wb-arrow-right"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
    <script src="{{ asset('/vendor/bootstrap-sweetalert/sweet-alert.js') }}"></script>
    <script src="{{ asset('/js/components/bootstrap-sweetalert.js') }}"></script>

    <script>
        $(function(){

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

                var tableContentKelas = $('#popFormKelas').html(),
                        tableSettings = {
                            title: 'Filter per kelas',
                            content: tableContentKelas,
                            width: 500,
                            animation : 'pop'
                        };

                $('#btnPopFormKelas').webuiPopover($.extend({}, defaults,
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

            $('.deleteStudent').click(function(e) {
                var url = $(this).attr("href");

                e.preventDefault();
                swal ({
                            title: 'Yakin ?',
                            text: 'Data akan di hapus!',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#DD6B55',
                            confirmButtonText: 'Delete',
                            cancelButtonText: 'Batal !',
                            closeOnConfirm: false,
                            closeOnCancel: false,
                        },function(isConfirm) {
                            if (isConfirm) {
                                $.ajax({
                                    url: url,
                                    dataType: "JSON",
                                    method: "DELETE",
                                    data : {
                                        _token : "{{ csrf_token() }}",
                                    },
                                    success: function () {
                                        swal("Deleted!", "Data telah dihapus.", "success");
                                        location.reload(true);
                                    }
                                });

                            } else {
                                swal("Cancelled", "Cancel :)", "error");
                            }
                        }
                )
            });
        })
    </script>
@endsection