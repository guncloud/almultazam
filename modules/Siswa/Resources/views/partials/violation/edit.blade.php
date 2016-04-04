@extends('siswa::layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-bootstrap/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-fixedheader/dataTables.fixedHeader.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-responsive/dataTables.responsive.css') }}">
@stop

@section('content')

    <div class="page animsition">
        <div class="page-header">
            <h4 class="page-title">{{ $title or 'Judul' }} - {{ $viol->student->nama }}</h4>
            <div class="page-header-actions">

            </div>
        </div>
        <div class="page-content">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $sub_title or null }}</h3>
                </div>
                <div class="panel-body">
                    <form action="{{ url('/siswa/violation/'.$viol->id) }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <input type="hidden" name="_method" value="PUT">
                        <div class="row">
                            <div class="form-group">
                                <label for="">Pelanggaran</label>
                                <textarea name="violation" id="" cols="10" rows="5" class="form-control" placeholder="Pelanggaran">{{ $viol->violation }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Poin</label>
                                <input type="text" class="form-control" name="point" placeholder="Poin" value="{{ $viol->point }}">
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="text" name="date" id="date" class="form-control" placeholder="Tanggal" value="{{ $viol->date }}">
                            </div>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function(){
            $('#date').datepicker({
                format : 'yyyy-mm-dd',
                orionttation : 'bottom',
                autoclose : true
            });
        })
    </script>
@stop