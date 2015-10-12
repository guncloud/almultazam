@extends('siswa::layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-bootstrap/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-fixedheader/dataTables.fixedHeader.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-responsive/dataTables.responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/formvalidation/formValidation.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap-sweetalert/sweet-alert.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/select2/select2.css') }}">
@stop

@section('content')

    <div class="page animsition">
        <div class="page-header">
            <h4 class="page-title">{{ $title or 'Judul' }}</h4>
            <div class="page-header-actions">
                <form autocomplete="off" id="new_form" method="post" action="{{ url('/siswa/classroom') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                    <div class="form-group form-material floating row">
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="classroom" />
                            <label class="floating-label">Kelas<span class="required">*</span></label>
                        </div>
                        <div class="col-sm-4">
                            <select name="teacher_id" id="" class="form-control" data-plugin="select2" data-placeholder="Guru">
                                @if($teachers)
                                    <option value="">Guru</option>
                                    @foreach($teachers as $tch)
                                        <option value="{{ $tch->id }}">{{ $tch->nama }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="page-content">

            @if($classrooms)
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title"></h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover dataTable table-striped width-full" id="tableClassrooms">
                            <thead>
                            <tr>
                                <th>Kelas</th>
                                <th>Wali Kelas</th>
                                <th class="col-md-3">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($classrooms as $v)
                                <tr>
                                    <td>{{ $v->classroom }}</td>
                                    <td>{{ $v->guru or '-' }}</td>
                                    <td>
                                        <form class="deleteForm" action="{{ url('/siswa/classroom/'.$v->id) }}" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button href="{{ url('/siswa/classroom/'.$v->id) }}" class="btn btn-warning btn-sm deleteClassroom" type="submit" id="deleteClassroom">
                                                <i class="icon wb-trash"></i>
                                            </button>
                                            <a href="{{ url('/siswa/classroom/'.$v->id) }}" data-classroom="{{ $v->id }}" class="btn btn-info btn-sm updateClassroom" type="button">
                                                <i class="icon wb-pencil"></i>Edit
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>

        <div class="modal fade" id="modalUpdateClassroom" aria-hidden="true" aria-labelledby="UpdateClassroom" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-sidebar modal-sm">
                <div class="modal-content">
                    <form action="" method="post" id="formUpdateClassroom">
                        <input type="hidden" name="_method" value="patch">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Update Kelas </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="classroom" id="updateClassroom">
                            </div>
                            <div class="form-group">
                                <select name="teacher_id" id="updateTeacherId" class="form-control" data-plugin="select2" data-placeholder="Guru">
                                    @if($teachers)
                                        <option value="">Guru</option>
                                        @foreach($teachers as $tch)
                                            <option value="{{ $tch->id }}">{{ $tch->nama }}</option>
                                        @endforeach
                                    @endif
                                </select>
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

    </div>
@stop

@section('js')
    <script src="{{ asset('/vendor/formvalidation/formValidation.min.js') }}"></script>
    <script src="{{ asset('/vendor/formvalidation/framework/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/vendor/datatables-fixedheader/dataTables.fixedHeader.js') }}"></script>
    <script src="{{ asset('/vendor/datatables-bootstrap/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('/vendor/datatables-responsive/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('/vendor/datatables-tabletools/dataTables.tableTools.js') }}"></script>
    <script src="{{ asset('/vendor/toastr/toastr.js') }}"></script>
    <script src="{{ asset('/js/components/toastr.js') }}"></script>
    <script src="{{ asset('/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('/js/components/select2.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap-sweetalert/sweet-alert.js') }}"></script>
    <script src="{{ asset('/js/components/datatables.js') }}"></script>
    <script src="{{ asset('/js/components/bootstrap-sweetalert.js') }}"></script>

    <script>
        $(function(){

            $('.updateClassroom').click(function(e){
                e.preventDefault();
                var id = $(this).attr('data-classroom');
                //(id);
                var url = $(this).attr('href');
                console.log(url);
                $('#formUpdateClassroom').attr('action', url);
                $.ajax({
                    url : url
                }).done(function(data){
                    console.log(data);
                    $('#updateClassroom').val(data.classroom);
                    $('#updateTeacherId').val(data.teacher_id);

                });
                $('#modalUpdateClassroom').modal('show');
            });

            var notif = "{{ Session::has('info') or '' }}";
            console.log(notif);
            if(notif != ''){
                toastr.success("{{ Session::get('info') }}", 'Info',{
                    positionClass : 'toast-top-full-width',
                });
            };

            $('.deleteClassroom').click(function(e) {
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

            $('#tableClassrooms').dataTable(options);
        });

    </script>
@endsection