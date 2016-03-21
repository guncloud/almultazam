@extends('hrd::layouts_2.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap-sweetalert/sweet-alert.css') }}">

@stop

@section('content')

    <section class="content-header">
        <h1>{{ $title or 'Judul' }} {{$position->position    }}</h1>
    </section>

    <div class="content">
        <div class="box box-default">
            <div class="box-body">
                <div class="col-md-4">
                    <form action="{{ url('/hrd/position/'.$position->id) }}" method="post" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <input type="text" class="form-control" name="position" placeholder="Nama Jabatan" value="{{ $position->position }}">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop