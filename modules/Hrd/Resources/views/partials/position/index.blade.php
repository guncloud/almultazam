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
            <div class="row">
                <div class="col-md-4">
                    <form action="{{ url('/hrd/position') }}" method="post" class="form-inline">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <input type="text" class="form-control" name="position" placeholder="Nama Jabatan">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Tambah</button>
                        </div>
                    </form>
                    <br>
                </div>
            </div>

            @if($positions)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Jabatan</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($positions as $pos)
                            <tr>
                                <td>{{ $pos->position }}</td>
                                <td>
                                    <form action="{{ url('/hrd/position/'.$pos->id) }}" method="post" class="formDelete">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="delete">
                                        <button class="btn btn-link btnSubmit" type="submit" >Hapus</button>

                                        <a href="{{ url('/hrd/position/'.$pos->id) }}">Edit</a>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Data  jabatan tidak ada</p>
            @endif
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function(){

            $('.btnSubmit').click(function(e){
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