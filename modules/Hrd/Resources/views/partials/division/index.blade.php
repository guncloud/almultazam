@extends('hrd::layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap-sweetalert/sweet-alert.css') }}">
@stop

@section('content')

    <div class="page animsition">
        <div class="page-header">
            <h4 class="page-title">{{ $title or 'Judul' }}</h4>
            <div class="page-header-actions">
                <button type="button" data-target="#newDivision" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-toggle="modal" data-original-title="Add">
                    <i class="icon wb-pencil" aria-hidden="true"></i> Add
                </button>
            </div>
        </div>
        <div class="page-content">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $sub_title or null }}</h3>
                </div>
                <div class="panel-body">
                    @if($divisions)
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($divisions as $div)
                                <tr>
                                    <td>{{ $div->division }}</td>
                                    <td>
                                        <form class="deleteForm" action="{{ url('/hrd/division/'.$div->id) }}" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button href="{{ url('/hrd/division/'.$div->id) }}" class="btn btn-warning btn-sm deleteDivision" type="submit" id="deleteDivision">
                                                <i class="icon wb-trash"></i>
                                            </button>
                                            <a href="{{ url('/hrd/division/'.$div->id) }}" class="btn btn-info btn-sm updateDivision" type="button">
                                                <i class="icon wb-pencil"></i>Edit
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

    <!-- Modal -->
    <div class="modal fade" id="newDivision" aria-hidden="true" aria-labelledby="newDivision" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-sidebar modal-sm">
            <div class="modal-content">
                <form autocomplete="off" method="post" action="{{ url('/hrd/division/') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">New Division</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group form-material floating row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="division" />
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

    <div class="modal fade" id="modalUpdateDivision" aria-hidden="true" aria-labelledby="UpdateDivsion" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-sidebar modal-sm">
            <div class="modal-content">
                <form autocomplete="off" method="post" id="formUpdateDivision">>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                    <input type="hidden" name="_method" value="patch">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">New Division</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group form-material floating row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="division" id="updateDivision"/>
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
            $('.updateDivision').click(function(e){
                e.preventDefault();

                var url = $(this).attr('href');
                console.log(url);
                $('#formUpdateDivision').attr('action', url);
                $.ajax({
                    url : url
                }).done(function(data){
                    console.log(data);
                    $('#updateDivision').val(data.division);
                });
                $('#modalUpdateDivision').modal('show');
            });

            $('.deleteDivision').click(function(e) {
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