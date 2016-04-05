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
                <form action="{{ url('siswa/contract/'.$contract->id) }}" method="post">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Mata Pelajaran</label>
                                    <select class="form-control" name="subject_id" id="subject">
                                        @foreach($subject as $sub)
                                            <option value="{{ $sub->id }}" {{ ($sub->id == $contract->subject_id) ? 'selected' : '' }}>{{ $sub->subject }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Pengajar</label>
                                    <input type="text" id="teacher" class="form-control" value="{{ $contract->teacher->nama }}">
                                    <input type="hidden" id="teacher_id" name="teacher_id" value="{{ $contract->teacher_id }}">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $('#teacher').autocomplete({
            serviceUrl: "{{ url('/siswa/teacher/search') }}",
            onSelect: function (suggestion) {
                {{--window.location.href = "{{ url('/siswa') }}/"+suggestion.data;--}}
                $('#teacher_id').val(suggestion.data);
            }
        });
    </script>
@endsection