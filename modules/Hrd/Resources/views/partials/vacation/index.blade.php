@extends('hrd::layouts_2.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.css') }}">
@stop

@section('content')

    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title "></h4>
            <div class="box-tools ">
                <form action="{{ url('/hrd/vacation') }}" method="get" class="form-inline" autocomplete="off">
                    <div class="form-group">
                        <input type="text" class="form-control input-sm" id="cutier" placeholder="Nama Pegawai">
                        <input type="hidden" id="pegawai" name="pegawai">
                    </div>
                    <div class="form-group">
                        <select name="bulan" id="bulan" class="form-control input-sm">
                            <option value=null>Pilih Bulan</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-sm" id="date" name="date" placeholder="Tanggal">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                    </div>
                    <div class="form-group">
                        <button type="button" data-target="#newVacation" class="no-print btn btn-sm btn-primary btn-default" data-toggle="modal" data-original-title="Add">
                            <i class="fa fa-pencil" aria-hidden="true"></i> Tambah data cuti
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="box-body">
           
            @if($vacations)
                <table class="table dataTable table-striped" id="tableVacation">
                    <thead>
                        <tr>
                            <th>Pegawai</th>
                            <th>Keterangan</th>
                            <th>Mulai</th>
                            <th>Akhir</th>
                            <th class="hidden"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($vacations as $vact)
                        <tr>
                            <td>{{ $vact->pegawai }}</td>
                            <td>{{ $vact->info }}</td>
                            <td>{{ $vact->start }}</td>
                            <td>{{ $vact->end }}</td>
                            <td>
                                <form class="deleteForm" action="{{ url('/hrd/vacation/'.$vact->id) }}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button href="{{ url('/hrd/vacation/'.$vact->id) }}" class="btn btn-warning btn-sm deleteVacation" type="submit" id="deleteIndicator">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>Pick a date</p>
            @endif
        </div>
            
    </div>

    {{--Modal--}}
    <div class="modal fade" id="newVacation" aria-hidden="true" aria-labelledby="newVacation" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form autocomplete="off" method="post" action="{{ url('/hrd/vacation') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                    <input type="hidden" name="year" value="{{ $year }}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Cuti</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group form-material floating row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="stakeholder" />
                                <input type="hidden" name="stakeholder_id" id="stakeholder_id">
                                <label class="floating-label">Nama</label>
                            </div>
                            <div class="col-md-12">
                                <textarea name="info" id="info" cols="30" rows="5" class="form-control" placeholder="Keterangan"></textarea>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="start" name="start" placeholder="Dari tanggal..">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="end" name="end" placeholder="Sampai tanggal..">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--/Modal--}}

@stop

@section('js')
    
    <script src="{{ asset('/js/jquery.autocomplete.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(function(){

            $('#stakeholder').autocomplete({
                serviceUrl: "{{ url('/hrd/stakeholder/search') }}",
                onSelect: function (suggestion) {
                    {{--window.location.href = "{{ url('/siswa') }}/"+suggestion.data;--}}
                    $('#stakeholder_id').val(suggestion.data);
                }
            });

            $('#cutier').autocomplete({
                serviceUrl: "{{ url('/hrd/stakeholder/search') }}",
                onSelect: function (suggestion) {
                    {{--window.location.href = "{{ url('/siswa') }}/"+suggestion.data;--}}
                    $('#pegawai').val(suggestion.data);
                }
            });

            // $('#start, #end, #date').datepicker({
            //     format : 'yyyy-mm-dd',
            //     autoclose : true
            // });

            $('.deleteVacation').click(function(e) {
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

            // var options =  function({
            //     "aoColumnDefs": [{
            //         'bSortable': false,
            //         'aTargets': [-1]
            //     }],
            //     "iDisplayLength": 5,
            //     "aLengthMenu": [
            //         [5, 10, 25, 50, -1],
            //         [5, 10, 25, 50, "All"]
            //     ],
            //     // "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
            //     // "oTableTools": {
            //     //     "sSwfPath": "{{ asset('/vendor/datatables-tabletools/swf/copy_csv_xls_pdf.swf') }}"
            //     // }
            // });

            $('#tableVacation').dataTable();


        })
    </script>
@stop