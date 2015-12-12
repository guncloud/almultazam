@extends('hrd::layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-bootstrap/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-fixedheader/dataTables.fixedHeader.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-responsive/dataTables.responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap-sweetalert/sweet-alert.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/webui-popover/webui-popover.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/toolbar/toolbar.css') }}">
@endsection

@section('content')

    <div class="page animsition">

        <div class="hidden" id="popFormExcel">
            <form class="form-inline " enctype="multipart/form-data" method="post" action="{{ url('/tool/upload-stakeholder') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Import Excel</span>
                        <input type="file" name="upload_pegawai"  class="form-control">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-info">Import</button>
                        </span>
                    </div><!-- /input-group -->
                    <br>
                    <br>
                    <a class="btn btn-xs btn-info btn-block" href="{{ url('/tool/download-format-pegawai') }}">
                        <i class="icon wb-download" aria-hidden="true"></i>
                        Download Format Excel
                    </a>
                </div>
            </form>
        </div>

        <div class="page-header">
            <h4 class="page-title">{{ $title or 'Judul' }}</h4>
            <div class="page-header-actions">
                @if($divisions)
                <form class="form-inline" method="get" action="{{ url('/hrd/stakeholder') }}">
                    <div class="form-group">

                            <select name="division" id="division" class="form-control">
                                <option selected disabled>Divisi/Bagian</option>
                                @foreach($divisions as $div)
                                    <option value="{{ $div->id }}">{{ $div->division }}</option>
                                @endforeach
                            </select>

                        <button class="btn btn-primary " type="submit">Pilih</button>
                    </div>
                    <div class="form-group">
                        <a type="button" href="{{ url('/hrd/stakeholder/create') }}" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-toggle="tooltip" data-original-title="Add">
                            <i class="icon wb-pencil" aria-hidden="true"></i> Add
                        </a>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round"
                                data-toggle="tooltip" data-original-title="Upload" id="btnPopFormExcel" href="javascript:void(0)">
                            <i class="icon wb-upload" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>
                @else
                    <div class="alert alert-danger">
                    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    	<strong>Perhatian </strong> Data <a href="{{ url('/hrd/division') }}">divisi/bagian</a> tidak ada
                    </div>
                @endif
            </div>
        </div>
        <div class="page-content">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $sub_title or null }}</h3>
                </div>
                <div class="panel-body">
                    @if($stakeholders)
                        <table class="table table-hover dataTable table-striped table-bordered width-full" id="tableStakeholder">
                            <thead>
                            <tr>
                                <th class="no-sort">No</th>
                                <th>Name</th>
                                <th>TTL</th>
                                <th>J. Kelamin</th>
                                <th>NRP</th>
                                <th>Jabatan</th>
                                <th>Handphone</th>
                                <th class="col-md-3">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($stakeholders as $i => $v)
                                <tr>
                                    <td class="no-sort">{{ $i+1 }}</td>
                                    <td>{{ $v->nama }}</td>
                                    <td>{{ $v->tempat_lahir }}, {{ date('d-m-Y', strtotime($v->tanggal_lahir)) }}</td>
                                    <td>{{ ($v->jenis_kelamin == 'l') ? 'Laki - laki' : 'Perempuan' }}</td>
                                    <td>{{ $v->nrp }}</td>
                                    <td>
                                        @if($v->positions)
                                            @foreach($v->positions as $post)
                                                {{ $post->position }},
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ $v->kontak }}</td>
                                    <td class="col-md-2">
                                        <form class="deleteForm" action="{{ url('/hrd/stakeholder/'.$v->id) }}" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button href="{{ url('/hrd/stakeholder/'.$v->id) }}" class="btn btn-warning btn-sm deleteStakeholder tooltip-danger tooltip-rotate" data-toggle="tooltip" data-original-title="Delete Pegawai !" type="submit" id="deleteStakeholder">
                                                <i class="icon wb-trash"></i>
                                            </button>
                                            <a href="{{ url('/hrd/stakeholder/'.$v->id.'/edit') }}" class="btn btn-info btn-sm tooltip-info tooltip-rotate" data-toggle="tooltip" data-original-title="Edit Pegawai" type="button">
                                                <i class="icon wb-pencil"></i>
                                            </a>
                                            <a href="{{ url('/hrd/stakeholder/'.$v->id) }}" class="btn btn-success btn-sm tooltip-success tooltip-rotate" data-toggle="tooltip" data-original-title="Detail Pegawai " type="button">
                                                <i class="icon wb-arrow-right"></i>
                                            </a>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        No data
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
    <script src="{{ asset('/vendor/bootstrap-sweetalert/sweet-alert.js') }}"></script>
    <script src="{{ asset('/js/components/datatables.js') }}"></script>
    <script src="{{ asset('/js/components/webui-popover.js') }}"></script>
    <script src="{{ asset('/js/components/toolbar.js') }}"></script>
    <script src="{{ asset('/js/components/bootstrap-sweetalert.js') }}"></script>

    <script>
        $(function(){

            var defaults = $.components.getDefaults("dataTable");

            var tableContent = $('#popFormExcel').html(),
                    tableSettings = {
                        title: 'Import data pegawai',
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

            myTable = $('#tableStakeholder').dataTable({
//                "columnDefs": [
//                    {
//                        "targets": "hide-column",
//                        "visible": false,
//                    },
//                ],
                "order": [[ 1, 'asc' ]],
//                "orderFixed": {
//                    "pre": [ 0, 'asc' ]
//                }
                "sDom": '<"link_excell"><"dt-panelmenu clearfix ">frlt<"dt-panelfooter clearfix"ip>',
                "oTableTools": {
                    "sSwfPath": "{{ asset('/vendor/datatables-tabletools/swf/copy_csv_xls_pdf.swf') }}"
                }
            });

            $( ".link_excell" ).html('<a href="{{ url('/tool/export-pegawai') }}">Download data excel</a>');

            myTable.api().on('order.dt', function () {
                myTable.api().column(0, {order:'applied'}).nodes().each(function (cell, i) {
                    cell.innerHTML = i+1;
                });
            }).draw();

            $('.deleteStakeholder').click(function(e) {
                var url = $(this).attr("href");
                e.preventDefault();
                swal ({
                    title: 'Yakin ?',
                    text: 'Data will not be shown!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel !',
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