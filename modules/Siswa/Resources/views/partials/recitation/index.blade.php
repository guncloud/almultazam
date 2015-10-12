@extends('siswa::layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/pages/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/webui-popover/webui-popover.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/toolbar/toolbar.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/select2/select2.css') }}">
@endsection

@section('content')

    <div class="page animsition">

        <div class="modal fade" id="modalAddSubject" aria-hidden="true" aria-labelledby="AddSubject" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-sidebar ">
                <div class="modal-content">
                    <form action="{{ url('/siswa/recitation') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Tambah Data Hafalan </h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="student_id" id="student_id">
                            <input type="hidden" name="semester" value="{{ $_GET['semester'] or '' }}">
                            <input type="hidden" name="classroom" id="kelas" value="{{ $_GET['kelas'] or null }}">
                            <input type="hidden" name="date" value="{{ $_GET['date'] or null }}">
                            <div class="form-group">
                                <input type="text" name="juz" placeholder="Juz" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" name="surah" placeholder="Surat" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" name="from" placeholder="Dari Ayat" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" name="to" placeholder="Sampai Ayat" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-block">Save changes</button>
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="page-header">
            <h4 class="page-title">{{ $title or 'Judul' }}</h4>
            <div class="page-header-actions">
                <form action="{{ url('/siswa/recitation') }}" method="get" class="form-inline">
                    @if($classrooms)
                        <div class="form-group">
                            <input type="text" class="form-control" id="date" name="date" value="{{ $_GET['date'] or '' }}">
                        </div>
                        <div class="form-group">
                            <select name="kelas" id="kelas" class="form-control" placeholder="Pilih Kelas">
                                <option >Pilih Kelas</option>
                                @foreach($classrooms as $cls)
                                    <option value="{{ $cls->id }}">{{ $cls->classroom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="semester" id="semester" class="form-control">
                                <option>Pilih Semester</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary add-hafalan" type="submit">Submit</button>
                        </div>
                    @else
                        <p>Data kelas tidak ada</p>
                    @endif
                </form>
            </div>
        </div>

        <div class="page-content">
            <div class="panel">
                <div class="panel-body">
                    @if($students)
                        {{--<form action="{{ url('/siswa/recitation') }}" method="post">--}}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                            <input type="hidden" name="date" value="{{ $_GET['date'] or '' }}">
                            <input type="hidden" name="classroom" value="{{ $_GET['kelas'] or '' }}">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Siswa </th>
                                    <th>Juz </th>
                                    <th>Surat</th>
                                    <th>Ayat</th>
                                    <th>Nilai</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $std)
                                    <tr>
                                        <td>{{ $std->nama }}</td>
                                        <td>
                                            @if(count(@$recitations[$std->student_id]) > 0)
                                                <ul class="list-unstyled">
                                                    @foreach($recitations[$std->student_id] as $juz)
                                                        <li>{{ $juz->juz }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td>
                                            @if(count(@$recitations[$std->student_id]) > 0)
                                                <ul class="list-unstyled">
                                                    @foreach($recitations[$std->student_id] as $surat)
                                                        <li>{{ $surat->surah }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td>
                                            @if(count(@$recitations[$std->student_id]) > 0)
                                                <ul class="list-unstyled">
                                                    @foreach($recitations[$std->student_id] as $ayat)
                                                        <li>Ayat {{ $ayat->from }} s.d. {{ $ayat->to }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td class="col-md-3">
                                            <form action="{{ url('/siswa/recitation/'.@$recitations[$std->student_id][0]->id) }}" method="post">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                                <input type="hidden" name="_method" value="PUT">
                                                <input type="hidden" name="kelas" value="{{ $_GET['kelas'] or null }}">
                                                <input type="hidden" name="date" value="{{ $_GET['date'] or null }}">
                                                <input type="hidden" name="semester" value="{{ $_GET['semester'] or null }}">
                                                @if(count(@$recitations[$std->student_id]) > 0)
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="Nilai" name="score" value="{{ $recitations[$std->student_id][0]->score or '' }}">
                                                          <span class="input-group-btn">
                                                            <button class="btn btn-default" type="submit">Simpan</button>
                                                          </span>
                                                    </div>
                                                @endif
                                            </form>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round add-hafalan" data-target="#modalAddSubject" data-toggle="modal"
                                                    data-toggle="tooltip" id="btnPopFormKelas" data-siswa="{{ $std->student_id }}">
                                                <i class="icon wb-pencil" aria-hidden="true"></i> Hafalan
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        {{--</form>--}}
                    @else
                        Data empty
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('/vendor/webui-popover/jquery.webui-popover.min.js') }}"></script>
    <script src="{{ asset('/vendor/toolbar/jquery.toolbar.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.autocomplete.js') }}"></script>
    <script src="{{ asset('/js/components/webui-popover.js') }}"></script>
    <script src="{{ asset('/js/components/toolbar.js') }}"></script>
    <script src="{{ asset('/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('/js/components/select2.js') }}"></script>

    <script>
        $(function(){

            $('.add-hafalan').click(function(){
                var id = $(this).attr('data-siswa');
                $('#student_id').val(id);
            });

            $('#date').datepicker({
                format : 'yyyy-mm-dd',
                orionttation : 'bottom',
                autoclose : true
            });

            $(document).ready(function() {

                var defaults = $.components.getDefaults("webuiPopover");

                var tableContent = $('#popMenu').html(),
                        tableSettings = {
                            title: 'Import data siswa',
                            content: tableContent,
                            animation: 'pop'
                        };

                $('#btnPopMenu').webuiPopover($.extend({}, defaults,
                        tableSettings));
            });

        })
    </script>
@stop