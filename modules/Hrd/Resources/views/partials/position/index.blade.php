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
                    <form action="{{ url('/hrd/position') }}" method="post" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <input type="text" class="form-control" name="position" placeholder="Nama Jabatan">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>


            @if($positions)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Jabatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($positions as $pos)
                            <tr>
                                <td>{{ $pos->position }}</td>
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