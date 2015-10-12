@extends('siswa::layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/pages/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/webui-popover/webui-popover.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/toolbar/toolbar.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap-sweetalert/sweet-alert.css') }}">

@endsection

@section('content')

    <div class="page animsition">

        <!-- Modal -->
        <div class="modal fade" id="modalAddLanguage" aria-hidden="true" aria-labelledby="AddLanguage" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-sidebar modal-sm">
                <div class="modal-content">
                    <form action="{{ url('/siswa/language') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Tambah Data Bahasa </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="code" placeholder="Kode">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="language" placeholder="Nama">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="teacher" placeholder="Pengajar">
                                <input type="hidden" name="teacher_id" id="teacher_id">
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

        <div class="modal fade" id="modalUpdateLanguage" aria-hidden="true" aria-labelledby="UpdateLanguage" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-sidebar modal-sm">
                <div class="modal-content">
                    <form action="" method="post" id="formUpdateLanguage">
                        <input type="hidden" name="_method" value="patch">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Update Data Bahasa </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="code" id="updateCode">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="language" id="updateLanguage">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Pelatih" id="updateTeacher">
                                <input type="hidden" name="teacher_id" id="update_teacher_id">
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
                <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-target="#modalAddLanguage" data-toggle="modal"
                        data-toggle="tooltip" id="btnAddLanguage">
                    <i class="icon wb-pencil" aria-hidden="true"></i> Bahasa
                </button>
            </div>
        </div>

        <div class="page-content">
            <div class="panel">
                <div class="panel-body">
                    @if($languages)
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Kode </th>
                            <th>Nama </th>
                            <th>Pengajar</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($languages as $lng)
                                <tr>
                                    <td>{{ $lng->code }}</td>
                                    <td>{{ $lng->language }}</td>
                                    <td>{{ $lng->teacher }}</td>
                                    <td>
                                        <form class="deleteForm" action="{{ url('/siswa/language/'.$lng->id) }}" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button href="{{ url('/siswa/language/'.$lng->id) }}" class="btn btn-warning btn-sm deleteLanguage" type="submit" id="deleteLanguage">
                                                <i class="icon wb-trash"></i>
                                            </button>
                                            <a href="{{ url('/siswa/language/'.$lng->id) }}" class="btn btn-info btn-sm updateLanguage" type="button">
                                                <i class="icon wb-pencil"></i>Edit
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
    <script src="{{ asset('/vendor/webui-popover/jquery.webui-popover.min.js') }}"></script>
    <script src="{{ asset('/vendor/toolbar/jquery.toolbar.min.js') }}"></script>
    <script src="{{ asset('/js/components/webui-popover.js') }}"></script>
    <script src="{{ asset('/js/components/toolbar.js') }}"></script>
    <script src="{{ asset('/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('/js/components/select2.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap-sweetalert/sweet-alert.js') }}"></script>
    <script src="{{ asset('/js/components/bootstrap-sweetalert.js') }}"></script>
    <script src="{{ asset('/js/jquery.autocomplete.js') }}"></script>

    <script>
        $(function(){
            $('#updateTeacher').autocomplete({
                serviceUrl: "{{ url('/siswa/teacher/search') }}",
                onSelect: function (suggestion) {
                    {{--window.location.href = "{{ url('/siswa') }}/"+suggestion.data;--}}
                    $('#update_teacher_id').val(suggestion.data);
                }
            });

            $('.updateLanguage').click(function(e){
                e.preventDefault();

                var url = $(this).attr('href');

                $('#formUpdateLanguage').attr('action', url);
                $.ajax({
                    url : url
                }).done(function(data){
                    console.log(data);
                    $('#update_teacher_id').val(data.teacher_id);
                    $('#updateCode').val(data.code);
                    $('#updateLanguage').val(data.language);
                });
                $('#modalUpdateLanguage').modal('show');
            });

            $('.deleteLanguage').click(function(e) {
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

            $('#teacher').autocomplete({
                serviceUrl: "{{ url('/siswa/teacher/search') }}",
                onSelect: function (suggestion) {
                    {{--window.location.href = "{{ url('/siswa') }}/"+suggestion.data;--}}
                    $('#teacher_id').val(suggestion.data);
                }
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

        })
    </script>
@stop