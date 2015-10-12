@extends('siswa::layouts.master')

@section('content')

    <div class="page animsition">
        <div class="page-header">
            <h4 class="page-title">{{ $title or 'Judul' }}</h4>
        </div>
        <div class="page-content">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $sub_title or null }}</h3>
                </div>
                <div class="panel-body">
                    <p>Modul Siswa : </p>
                    <ul>
                        <li> Manejemen Siswa</li>
                        <li> Manejemen Asrama</li>
                        <li> Manejemen Kelas</li>
                        <li> Manejemen Pelanggaran</li>
                        <li> Manejemen Prestasi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop

{{--<ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">--}}
    {{--<li class="active" role="presentation">--}}
        {{--<a data-toggle="tab" href="#tabSubject" aria-controls="tabSubject" role="tab">Mata Pelajaran</a>--}}
    {{--</li>--}}
    {{--<li role="presentation">--}}
        {{--<a data-toggle="tab" href="#tabPengajar" aria-controls="tabPengajar" role="tab">Pengajar</a>--}}
    {{--</li>--}}
{{--</ul>--}}

{{--<div class="tab-content">--}}
    {{--<div class="tab-panel" id="tabSubject" role="tabpanel">--}}
        {{--<ul class="list-group">--}}
            {{--<li class="list-group-item">--}}
                {{--<div class="media">--}}
                    {{--<div class="media-body">--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</div>--}}
{{--</div>--}}

{{--<div class="tab-content">--}}
    {{--<div class="tab-pane active" id="tabSubject" role="tabpanel">--}}
        {{--<ul class="list-group">--}}
            {{--<li class="list-group-item">--}}
                {{--<div class="media">--}}
                    {{--<div class="media-body">--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</div>--}}
{{--</div>--}}