@if(Auth::user()->is('hrd'))
    @extends('hrd::layouts.master')
@else
    @extends('siswa::layouts.master')
@endif

{{ Auth::user()->is('hrd') }}

@section('content')

    <div class="page animsition">
        <div class="page-header">
            <h4 class="page-title">{{ $title or 'Judul' }}</h4>
        </div>
        <div class="page-content">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="panel">
                    <div class="panel-body">
                        <form action="{{ url('/tool/print-cover') }}" method="get" class="form-horizontal">
                            <div class="form-group">
                                <label for="" class="control-label col-md-4">Print Cover</label>
                                <div class="col-md-4">
                                    <select name="semester" id="semester" class="form-control">
                                        <option selected disabled>Pilih Semester</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary" type="submit">Pilih</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop