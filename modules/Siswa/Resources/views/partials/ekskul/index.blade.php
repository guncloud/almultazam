@extends('siswa::layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap-sweetalert/sweet-alert.css') }}">
@stop

@section('content')

    <div class="page animsition">

        <!-- Modal -->
        <div class="modal fade" id="modalAddEkskul" aria-hidden="true" aria-labelledby="AddSubject" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-sidebar modal-sm">
                <div class="modal-content">
                    <form action="{{ url('/siswa/ekskul') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Tambah Data Ekskul </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="code" placeholder="Kode Ekskul">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="ekskul" placeholder="Nama Ekskul">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Pelatih" id="teacher">
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

        <div class="modal fade" id="modalUpdateEkskul" aria-hidden="true" aria-labelledby="UpdateEkskul" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-sidebar modal-sm">
                <div class="modal-content">
                    <form action="" method="post" id="formUpdateEkskul">
                        <input type="hidden" name="_method" value="patch">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Update Data Ekskul </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="code" id="updateCode">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="ekskul" id="updateEkskul">
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
        {{-- /Modal --}}

        <div class="page-header">
            <h4 class="page-title">{{ $title or 'Judul' }}</h4>
            <div class="page-header-actions">
                <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-target="#modalAddEkskul" data-toggle="modal"
                        data-toggle="tooltip" id="btnPopFormKelas">
                    <i class="icon wb-pencil" aria-hidden="true"></i> Tambah Ekskul
                </button>
            </div>
        </div>
        <div class="page-content">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $sub_title or null }}</h3>
                </div>
                <div class="panel-body">
                    @if($ekskuls)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Pelatih / Pengurus</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ekskuls as $i => $eks)
                                    <tr>
                                        <td>{{ $eks->code }}</td>
                                        <td>{{ $eks->ekskul }}</td>
                                        <td>{{ $eks->nama }}</td>
                                        <td>
                                            <form class="deleteForm" action="{{ url('/siswa/ekskul/'.$eks->ekskul_id) }}" method="post">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button href="{{ url('/siswa/ekskul/'.$eks->ekskul_id) }}" class="btn btn-warning btn-sm deleteEkskul" type="submit" id="deleteEkskul">
                                                    <i class="icon wb-trash"></i>
                                                </button>
                                                <a href="{{ url('/siswa/ekskul/'.$eks->ekskul_id) }}" data-teacher="{{ $eks->nama }}" class="btn btn-info btn-sm updateEkskul" type="button">
                                                    <i class="icon wb-pencil"></i>Edit
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No data</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('/vendor/bootstrap-sweetalert/sweet-alert.js') }}"></script>
    <script src="{{ asset('/js/components/bootstrap-sweetalert.js') }}"></script>
    <script src="{{ asset('/js/jquery.autocomplete.js') }}"></script>

    <script>
        $(function(){
            $('#teacher').autocomplete({
                serviceUrl: "{{ url('/siswa/teacher/search') }}",
                onSelect: function (suggestion) {
                    {{--window.location.href = "{{ url('/siswa') }}/"+suggestion.data;--}}
                    $('#teacher_id').val(suggestion.data);
                }
            });

            $('#updateTeacher').autocomplete({
                serviceUrl: "{{ url('/siswa/teacher/search') }}",
                onSelect: function (suggestion) {
                    {{--window.location.href = "{{ url('/siswa') }}/"+suggestion.data;--}}
                    $('#update_teacher_id').val(suggestion.data);
                }
            });

            $('.updateEkskul').click(function(e){
                e.preventDefault();

                var url = $(this).attr('href');
                var tch = $(this).attr('data-teacher');

                $('#formUpdateEkskul').attr('action', url);
                $.ajax({
                    url : url
                }).done(function(data){
                    console.log(data);
                    $('#update_teacher_id').val(data.teacher_id);
                    $('#updateCode').val(data.code);
                    $('#updateTeacher').val(tch);
                    $('#updateEkskul').val(data.ekskul);
                });
                $('#modalUpdateEkskul').modal('show');
            });

            $('.deleteEkskul').click(function(e) {
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