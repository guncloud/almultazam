@extends('hrd::layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap-sweetalert/sweet-alert.css') }}">

@stop

@section('content')

    <div class="page animsition">
        <div class="page-header">
            <h4 class="page-title">{{ $title or 'Judul' }}</h4>
        </div>
        <div class="page-content">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Kriteria</h3>
                        <div class="page-header-actions">
                            <button type="button" data-target="#newIndicator" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-toggle="modal" data-original-title="Add">
                                <i class="icon wb-pencil" aria-hidden="true"></i> Add
                            </button>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if($indicators)
                            <table class="table table-striped">
                                @foreach($indicators as $ind)
                                    <tr>
                                        <td>{{ $ind->indicator }}</td>
                                        <td>
                                            <form class="deleteForm" action="{{ url('/hrd/indicator/'.$ind->id) }}" method="post">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button href="{{ url('/hrd/indicator/'.$ind->id) }}" class="btn btn-warning btn-sm deleteIndicator" type="submit" id="deleteIndicator">
                                                    <i class="icon wb-trash"></i>
                                                </button>
                                                {{--<a href="{{ url('/hrd/indicator/'.$ind->id) }}" class="btn btn-info btn-sm updateDivision" type="button">--}}
                                                    {{--<i class="icon wb-pencil"></i>Edit--}}
                                                {{--</a>--}}
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            Data not found
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Indikator</h3>
                        <div class="page-header-actions">
                            <button type="button" data-target="#newPerformance" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-toggle="modal" data-original-title="Add">
                                <i class="icon wb-pencil" aria-hidden="true"></i> Add
                            </button>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if($performances)
                            <table class="table table-striped">
                                @foreach($performances as $perm)
                                    <tr>
                                        <td>
                                            {{ $perm->indicator }}
                                            <ul>
                                            @foreach($perm->performances as $p)
                                                <li>{{ $p->performance }},
                                                    <form class="deleteForm" action="{{ url('/hrd/indicator/'.$p->id) }}" method="post">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button href="{{ url('/hrd/performance/'.$p->id) }}" class="btn btn-warning btn-sm deletePerformance" type="submit" id="deleteIndicator">
                                                            <i class="icon wb-trash"></i>
                                                        </button>
                                                        {{--<a href="{{ url('/hrd/performance/'.$p->id) }}" class="btn btn-info btn-sm updateDivision" type="button">--}}
                                                            {{--<i class="icon wb-pencil"></i>Edit--}}
                                                        {{--</a>--}}
                                                    </form>
                                                </li>
                                            @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            Data not found
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="newPerformance" aria-hidden="true" aria-labelledby="newPerformance" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form autocomplete="off" method="post" action="{{ url('/hrd/indicator/create-performance') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                    <input type="hidden" name="performance" value=false>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Indikator</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group form-material floating row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="performance" />
                                <label class="floating-label">Nama</label>
                                <br>
                            </div>
                            <div class="col-sm-12">
                                @if($indicators)
                                    <select name="indicator_id" id="indicator_id" class="form-control">
                                        <option></option>
                                        @foreach($indicators as $ind)
                                            <option value="{{ $ind->id }}">{{ $ind->indicator }}</option>
                                        @endforeach
                                    </select>
                                @endif
                                <label class="floating-label">Kriteria</label>
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

    <div class="modal fade" id="newIndicator" aria-hidden="true" aria-labelledby="newIndicator" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form autocomplete="off" method="post" action="{{ url('/hrd/indicator/create-indicator') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                    <input type="hidden" name="indicator" value=false>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Kriteria</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group form-material floating row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="indicator" />
                                <label class="floating-label">Nama</label>
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
    <!-- End Modal -->

@stop


@section('js')
    <script src="{{ asset('/vendor/toastr/toastr.js') }}"></script>
    <script src="{{ asset('/js/components/toastr.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap-sweetalert/sweet-alert.js') }}"></script>
    <script src="{{ asset('/js/components/bootstrap-sweetalert.js') }}"></script>

    <script>
        $(function(){
            var notif = "{{ Session::has('info') or '' }}";
            console.log(notif);
            if(notif != ''){
                toastr.success("{{ Session::get('info') }}", 'Info',{
                    positionClass : 'toast-top-full-width',
                });
            }

            $('.deletePerformance').click(function(e) {
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

            $('.deleteIndicator').click(function(e) {
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
@stop