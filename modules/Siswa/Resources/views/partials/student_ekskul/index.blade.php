@extends('siswa::layouts.master')

@section('content')

    <div class="page animsition">
        <div class="page-header">
            <h4 class="page-title">{{ $title or 'Judul' }}</h4>
            <div class="page-header-actions">
                <form action="{{ url('/siswa/student-ekskul') }}" method="get" class="form-inline">
                    @if($classrooms)
                        <div class="form-group">
                            <input type="text" class="form-control" id="date" name="date" placeholder="Tanggal" value="{{ $_GET['date'] or '' }}">
                        </div>
                        <div class="form-group">
                            <select name="ekskul" id="ekskul" class="form-control" placeholder="Pilih Ekskul" value="{{ $_GET['ekskul'] or '' }}">
                                <option >Pilih Ekskul</option>
                                @if($ekskuls)
                                    @foreach($ekskuls as $lng)
                                        <option value="{{ $lng->id }}">{{ $lng->ekskul }}</option>
                                    @endforeach
                                @endif
                            </select>
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
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $sub_title or null }}</h3>
                </div>
                <div class="panel-body">
                    @if($students)
                        <form action="{{ url('/siswa/student-ekskul') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                            <input type="hidden" name="date" value="{{ $_GET['date'] or '' }}">
                            <input type="hidden" name="ekskul" value="{{ $_GET['ekskul'] or '' }}">
                            <input type="hidden" name="semester" value="{{ $_GET['semester'] or '' }}">
                            <input type="hidden" name="kelas" value="{{ $_GET['kelas'] or '' }}">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Siswa </th>
                                    <th>Kehadiran </th>
                                    <th>Penilaian </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $std)
                                    <tr>
                                        <td>{{ $std->nama }}</td>
                                        <td>
                                            <input type="radio" name="attendance[{{ $std->student_id }}]" value="hadir" @if(@$ekskulStudent[$std->student_id]['attendance'] == 'hadir' or @$std->bacaan[0]->attendance == '') checked @endif> Hadir
                                            <input type="radio" name="attendance[{{ $std->student_id }}]" value="izin" @if(@$ekskulStudent[$std->student_id]['attendance'] == 'izin') checked @endif> Izin
                                            <input type="radio" name="attendance[{{ $std->student_id }}]" value="sakit" @if(@$ekskulStudent[$std->student_id]['attendance'] == 'sakit') checked @endif> Sakit
                                            <input type="radio" name="attendance[{{ $std->student_id }}]" value="alpa" @if(@$ekskulStudent[$std->student_id]['attendance'] == 'alpa') checked @endif> Alpa
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="score[{{ $std->student_id }}]" value="{{ @$ekskulStudent[$std->student_id]['score'] }}"/>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <button class="btn btn-floating btn-primary btn-fixed" type="submit">
                                <i class="icon fa-save"></i>
                            </button>
                        </form>
                    @else
                        No Data
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

    <script>
        $(function(){

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