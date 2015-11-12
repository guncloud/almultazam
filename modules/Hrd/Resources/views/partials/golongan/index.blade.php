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
                <button type="button" data-target="#newGolongan" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-toggle="modal" data-original-title="Add">
                    <i class="icon wb-pencil" aria-hidden="true"></i> Add
                </button>
            </div>
        </div>

        <div class="page-content">
            @if($golongan)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Golongan</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($golongan as $gol)
                            <tr>
                                <td>{{ $gol->golongan }}</td>
                                <td>
                                    <form action="{{ url('/hrd/golongan/'.$gol->id) }}" method="post" class="formDelete">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="delete">
                                        <button class="btn btn-link btnDelete" type="submit" >Hapus</button>

                                        <a href="{{ url('/hrd/golongan/'.$gol->id) }}">Edit</a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Tidak ada data</p>
            @endif
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="newGolongan">
    	<div class="modal-dialog">
    		<div class="modal-content">
                <form action="{{ url('/hrd/golongan') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Tambah Golongan</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Golongan</label>
                            <input type="text" name="golongan" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
    		</div><!-- /.modal-content -->
    	</div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Modal -->

@stop

@section('js')
    <script>
        $(function(){
            $('.btnDelete').click(function(e){
                e.preventDefault();
                var r = confirm('Yakin akan menghapus');

                if (r == true) {
                    $(this).closest("form").submit();
                } else {
                    return false;
                }
            });
        })
    </script>
@stop