@extends('siswa::layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/pages/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/webui-popover/webui-popover.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/toolbar/toolbar.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/select2/select2.css') }}">
@endsection

@section('content')

    <div class="page animsition">
        <div class="page-header">
            <h4 class="page-title">
                Edit data hafalan
            </h4>
        </div>

        <div class="page-content">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ url('siswa/recitation/'.$rec->id) }}" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="all" value="true">

                        <div class="form-group">
                            <label for="">JUz</label>
                            <input type="text" name="juz" placeholder="Juz" class="form-control" value="{{ $rec->juz }}">
                        </div>
                        <div class="form-group">
                            <label for="">Surat</label>
                            <input type="text" name="surah" placeholder="Surat" class="form-control" value="{{ $rec->surah }}">
                        </div>
                        <div class="form-group">
                            <label for="">Dari </label>
                            <input type="text" name="from" placeholder="Dari Ayat" class="form-control" value="{{ $rec->from }}">
                        </div>
                        <div class="form-group">
                            <label for="">Sampai </label>
                            <input type="text" name="to" placeholder="Sampai Ayat" class="form-control" value="{{ $rec->to }}">
                        </div>
                        <div class="form-group">
                            <label for="">Nilai </label>
                            <input type="text" name="score" placeholder="Nilai" class="form-control" value="{{ $rec->score}}">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

