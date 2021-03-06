@extends('hrd::layouts_2.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('content')

    <section class="content-header">
        <h1>
            {{ $title or 'Kepegawaian' }}
            <small> {{ $subtitle or '' }} </small>
        </h1>
        <ul class="breadcrumb">
            <li>
                <a type="button" href="{{ url('/hrd/stakeholder/create') }}" class="btn btn-sm btn-primary" data-original-title="Add">
                    <i class="fa fa-pencil" aria-hidden="true"></i> Tambah data
                </a>
            </li>
        </ul>
    </section>

    <div class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    @if($divisions)
                        <form class="form-inline" method="get" action="{{ url('/hrd/stakeholder') }}">
                            <div class="form-group">

                                <select name="division" id="division" class="form-control input-sm">
                                    <option selected disabled>Divisi/Bagian</option>
                                    @foreach($divisions as $div)
                                        <option value="{{ $div->id }}">{{ $div->division }}</option>
                                    @endforeach
                                </select>

                                <button class="btn btn-primary btn-sm" type="submit">Pilih</button>
                            </div>

                            <div class="form-group">
                                <a href="{{ url('/tool/export-pegawai') }}" class="btn btn-sm bg-navy">
                                    <i class="fa fa-file-excel-o"></i> Download Data Excel
                                </a>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Perhatian </strong> Data <a href="{{ url('/hrd/division') }}">divisi/bagian</a> tidak ada
                        </div>
                    @endif
                </h3>
                <div class="box-tools pull-left">
                    <form class="form-inline " enctype="multipart/form-data" method="post" action="{{ url('/tool/upload-stakeholder') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <div class="input-group ">
                                <span class="input-group-addon" id="basic-addon1">Import Excel</span>
                                <input type="file" name="upload_pegawai"  class="form-control input-sm">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-info btn-sm">Import</button>
                            </span>
                            </div><!-- /input-group -->
                        </div>
                        <div class="form-group">
                            <a class="btn btn-sm btn-info btn-block" href="{{ url('/tool/download-format-pegawai') }}">
                                <i class="icon wb-download" aria-hidden="true"></i>
                                Download Format Excel
                            </a>
                        </div>
                    </form>

                </div>
            </div>
            <div class="box-body">
                @if($stakeholders)
                    <table class="table table-bordered table-striped" id="tableStakeholder">
                        <thead>
                        <tr>
                            <th class="no-sort">No</th>
                            <th nowrap>Name</th>
                            <th nowrap>TTL</th>
                            <th>J. Kelamin</th>
                            <th>NRP</th>
                            <th>Jabatan</th>
                            <th>Handphone</th>
                            <th >Option</th>
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
                                    <form action="{{ url('/hrd/stakeholder/'.$v->id) }}" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button href="{{ url('/hrd/stakeholder/'.$v->id) }}"
                                                class="btn btn-warning btn-sm btn_delete_action" data-toggle="tooltip" data-original-title="Delete Pegawai !">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <a href="{{ url('/hrd/stakeholder/'.$v->id.'/edit') }}" class="btn btn-info btn-sm tooltip-info tooltip-rotate" data-toggle="tooltip" data-original-title="Edit Pegawai" type="button">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="{{ url('/hrd/stakeholder/'.$v->id) }}" class="btn btn-success btn-sm tooltip-success tooltip-rotate" data-toggle="tooltip" data-original-title="Detail Pegawai " type="button">
                                            <i class="fa fa-arrow-right"></i>
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
            </div><!-- /.box-body -->

        </div>
    </div>

@stop

@section('js')
    <script src="{{ asset('/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(function(){

            myTable = $('#tableStakeholder').dataTable({
//                "columnDefs": [
//                    {
//                        "targets": "hide-column",
//                        "visible": false,
//                    },
//                ],
                "order": [[ 1, 'asc' ]],
                "autoWidth" : false
//                "orderFixed": {
//                    "pre": [ 0, 'asc' ]
//                }
                // "sDom": '<"link_excell"><"dt-panelmenu clearfix ">frlt<"dt-panelfooter clearfix"ip>',
                // "oTableTools": {
                //     "sSwfPath": "{{ asset('/vendor/datatables-tabletools/swf/copy_csv_xls_pdf.swf') }}"
                // }
            });

            // $( ".link_excell" ).html('<a href="{{ url('/tool/export-pegawai') }}">Download data excel</a>');

            myTable.api().on('order.dt', function () {
                myTable.api().column(0, {order:'applied'}).nodes().each(function (cell, i) {
                    cell.innerHTML = i+1;
                });
            }).draw();



        })
    </script>
@endsection