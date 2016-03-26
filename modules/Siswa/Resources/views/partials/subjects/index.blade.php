@extends('siswa::layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/pages/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/webui-popover/webui-popover.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/toolbar/toolbar.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-responsive/dataTables.responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap-sweetalert/sweet-alert.css') }}">
@endsection

@section('content')

    <div class="page animsition">

        <!-- Modal -->
        <div class="modal fade" id="modalAddSubject" aria-hidden="true" aria-labelledby="AddSubject" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-sidebar modal-sm">
                <div class="modal-content">
                    <form action="{{ url('/siswa/subject') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Tambah Data Pelajaran </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="code" placeholder="Kode M. Pelajaran">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" placeholder="Nama M. Pelajaran">
                            </div>
                            <div class="form-group">
                                <select name="grade" id="grade" class="form-control">
                                    <option>Pilih Tingkat</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
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

        <div class="modal fade" id="modalAddContract" aria-hidden="true" aria-labelledby="addContract" role="dialog" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ url('/siswa/contract') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Tambah Data Pengajar </h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <input type="text" name="teacher" id="teacher" class="form-control" placeholder="Nama Pengajar / Guru">
                                        <input type="hidden" name="teacher_id" id="teacher_id">
                                    </div>
                                    <div class="form-group">
                                        <select name="subject_id" id="subjecy_id" class="form-control" data-plugin="select2">
                                            @if($subjects)
                                                @foreach($subjects as $sbj)
                                                    <option value="{{ $sbj->id }}">{{$sbj->code}} - {{ $sbj->subject }} - {{ $sbj->grade }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="classroom" id="classroom" class="form-control">
                                            <option>Pilih Kelas</option>
                                            @if($classrooms)
                                                @foreach($classrooms as $cls)
                                                    <option value="{{ $cls->id }}">{{ $cls->classroom }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="semester" id="semester" class="form-control">
                                            <option>Pilih Semester</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>
                                </div>
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

        <div class="modal fade" id="modalUpdateSubject" aria-hidden="true" aria-labelledby="updatehostel" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-sidebar modal-sm">
                <div class="modal-content">
                    <form action="" method="post" id="formUpdateSubject">
                        <input type="hidden" name="_method" value="patch">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Update M. Pelajaran </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="code" id="updateCode">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="updateSubject">
                            </div>
                            <div class="form-group">
                                <select name="grade" id="updateTingkat" class="form-control">
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
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

        <div class="modal fade" id="modalUpdateContract" aria-hidden="true" aria-labelledby="updateContract" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-sidebar modal-sm">
                <div class="modal-content">
                    <form action="" method="post" id="formUpdateContract">
                        <input type="hidden" name="_method" value="patch">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Update Pengajar </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <select name="subject_id" id="update_contract_subject_id" class="form-control">
                                    @if(@$subjects)
                                        @foreach($subjects as $sbj)
                                            <option value="{{ $sbj->id }}">{{ $sbj->subject }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="updateContractTeacherId">
                                <input type="hidden" name="teacher_id" id="update_contract_teacher_id">
                            </div>
                            <div class="form-group">
                                <select name="classroom_id" id="update_contract_classroom_id" class="form-control">
                                    @if($classrooms)
                                        @foreach($classrooms as $cls)
                                            <option value="{{ $cls->id }}">{{ $cls->classroom }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="semester" id="update_contract_semester" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
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
        <!-- End Modal -->

        <div class="page-header">
            <h4 class="page-title">{{ $title or 'Judul' }}</h4>
            <div class="page-header-actions">
                <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-target="#modalAddSubject" data-toggle="modal"
                        data-toggle="tooltip" id="btnPopFormKelas">
                    <i class="icon wb-pencil" aria-hidden="true"></i> M. Pelajaran
                </button>
                <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-target="#modalAddContract" data-toggle="modal"
                        data-toggle="tooltip" id="btnPopFormContract">
                    <i class="icon wb-pencil" aria-hidden="true"></i> Pengajar
                </button>
            </div>
        </div>

        <div class="page-content">
            <div class="panel">
                <div class="panel-body">

                    <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                        <li class="active" role="presentation">
                            <a data-toggle="tab" href="#tabSubject" aria-controls="tabSubject" role="tab">Mata Pelajaran</a>
                        </li>
                        <li role="presentation">
                            <a data-toggle="tab" href="#tabPengajar" aria-controls="tabPengajar" role="tab">Pengajar</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tabSubject" role="tabpanel">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="media">
                                        <div class="media-body">
                                            <table class="table table-striped" id="table-siswa">
                                                <thead>
                                                <tr>
                                                    <th>Kode M. Pelajaran</th>
                                                    <th>Nama M. Pelajaran</th>
                                                    <th>Tingkat</th>
                                                    <th>Options</th>
                                                </tr>
                                                </thead>
                                                @if($subjects)
                                                    @foreach($subjects as $sbj)
                                                        <tr>
                                                            <td>{{ $sbj->code }}</td>
                                                            <td>{{ $sbj->subject }}</td>
                                                            <td>{{ $sbj->grade }}</td>
                                                            <td>
                                                                <form class="deleteForm" action="{{ url('/siswa/subject/'.$sbj->id) }}" method="post">
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <button href="{{ url('/siswa/subject/'.$sbj->id) }}" class="btn btn-warning btn-sm deleteSubject" type="submit" id="deleteSubject">
                                                                        <i class="icon wb-trash"></i>
                                                                    </button>
                                                                    <a href="{{ url('/siswa/subject/'.$sbj->id) }}" class="btn btn-info btn-sm updateSubject" type="button">
                                                                        <i class="icon wb-pencil"></i>Edit
                                                                    </a>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-pane" id="tabPengajar" role="tabpanel">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="media">
                                        <div class="media-body">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>M. Pelajaran</th>
                                                    <th>Pengajar</th>
                                                    <th>Kelas</th>
                                                    <th>Tahun Ajaran</th>
                                                    <th>Semester</th>
                                                    <th>Options</th>
                                                </tr>
                                                </thead>
                                                @if($contracts)
                                                    @foreach($contracts as $ctr)
                                                        <tr>
                                                            <td>{{ $ctr->subject }}</td>
                                                            <td>{{ $ctr->teacher }}</td>
                                                            <td>{{ $ctr->classroom }}</td>
                                                            <td>{{ $ctr->year }}</td>
                                                            <td>{{ $ctr->semester }}</td>
                                                            <td>
                                                                <form class="deleteForm" action="{{ url('/siswa/contract/'.$ctr->id) }}" method="post">
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <button href="{{ url('/siswa/contract/'.$ctr->id) }}" class="btn btn-warning btn-sm deleteContract" type="submit" id="deleteContract">
                                                                        <i class="icon wb-trash"></i>
                                                                    </button>
                                                                    <a href="{{ url('/siswa/contract/'.$ctr->id) }}" class="btn btn-info btn-sm updateContract" type="button">
                                                                        <i class="icon wb-pencil"></i>Edit
                                                                    </a>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
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

            $('#teacher').autocomplete({
                serviceUrl: "{{ url('/siswa/teacher/search') }}",
                onSelect: function (suggestion) {
                    {{--window.location.href = "{{ url('/siswa') }}/"+suggestion.data;--}}
                    $('#teacher_id').val(suggestion.data);
                }
            });

            $('#updateContractTeacherId').autocomplete({
                serviceUrl: "{{ url('/siswa/teacher/search') }}",
                onSelect: function (suggestion) {
                    {{--window.location.href = "{{ url('/siswa') }}/"+suggestion.data;--}}
                    $('#update_contract_teacher_id').val(suggestion.data);
                }
            });

            $('.updateContract').click(function(e){
                e.preventDefault();

                var url = $(this).attr('href');

                $('#formUpdateContract').attr('action', url);
                $.ajax({
                    url : url
                }).done(function(data){
                    console.log(data);
                    $('#update_contract_subject_id').val(data.subject_id);
                    $('#update_contract_teacher_id').val(data.teacher_id);
                    $('#update_contract_classroom_id').val(data.classroom_id);
                    $('#update_contract_semester').val(data.semester);
                });
                $('#modalUpdateContract').modal('show');
            });

            $('.deleteContract').click(function(e) {
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

            $('.updateSubject').click(function(e){
                e.preventDefault();

                var url = $(this).attr('href');

                $('#formUpdateSubject').attr('action', url);
                $.ajax({
                    url : url
                }).done(function(data){
                    console.log(data);
                    $('#updateCode').val(data.code);
                    $('#updateSubject').val(data.subject);
                    $('#updateTingkat').val(data.grade);
                });
                $('#modalUpdateSubject').modal('show');
            });

            $('.deleteSubject').click(function(e) {
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

            $(document).ready(function() {

                var defaults = $.components.getDefaults("webuiPopover");

                var tableContent = $('#popMenu').html(),
                        tableSettings = {
                            title: 'Import data siswa',
                            content: tableContent,
                            animation: 'pop'
                        };

                $('#btnPopMenu').webuiPopover($.extend({}, defaults,
                        tableSettings));
            });

            $('#table-siswa').datatable();

        })
    </script>
@stop