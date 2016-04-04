@extends('hrd::layouts_2.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap-datepicker/bootstrap-datepicker.css') }}">
@stop

@section('content')

    <section class="content-header">
        <h1>Cuti</h1>
        <ul class="breadcrumb">
            <li>
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
            </li>
        </ul>
    </section>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
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
                                                <button class="btn btn-danger" type="submit" data-toggle="confirmation"><i class="fa fa-trash"></i></button>
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
            </div>
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
    <script src="{{ asset('/js/bs-confirm.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('/js/components/bootstrap-datepicker.js') }}"></script>

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

             $('#start, #end, #date').datepicker({
                 format : 'yyyy-mm-dd',
                 autoclose : true,
                 placement : 'bottom'
             });

            $('[data-toggle="confirmation"]').confirmation({
                singleton : true,
                placement : 'left',
                onConfirm:function(event, element) {
                    console.log('fuck');
                    element.closest('form').submit();
                }
            });

            $('#tableVacation').dataTable();


        })
    </script>
@stop