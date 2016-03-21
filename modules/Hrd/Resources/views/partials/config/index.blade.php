@extends('hrd::layouts_2.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap-sweetalert/sweet-alert.css') }}">

@stop

@section('content')

    <section class="content-header">
        <h1>{{ $title or '' }}</h1>
    </section>

    <div class="content">
        <div class="box">
            <div class="box-header">
                <h4 class="box-title"></h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ url('/hrd/config') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="">Kepala Divisi/Bagian</label>
                                <input type="text" class="form-control" name="kepala_divisi" value="{{ $kepala_divisi->value or '' }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
