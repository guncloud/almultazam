@extends('siswa::layouts.master')

@section('content')

    <div class="page animsition">
        <div class="page-header">
            <h4 class="page-title">
                {{ $title or 'Judul' }}
                <small>
                    @if($selectedContract)
                        {{ $selectedContract->subject or '' }}
                    @endif
                </small>
            </h4>
            <div class="page-header-actions">
                <form action="{{ url('/siswa/score') }}" method="get" class="form-inline">
                    <div class="form-group">
                        @if($contracts)
                            <select name="contract" id="contract" class="form-control" placeholder="Pilih Kelas">
                                <option >Pilih M. Pel</option>
                                @foreach($contracts as $sbj)
                                    <option value="{{ $sbj->id }}">{{ $sbj->code }} - {{ $sbj->subject }} ({{ $sbj->grade }})</option>
                                @endforeach
                            </select>
                        @else
                            <p>Data kelas tidak ada</p>
                        @endif
                    </div>
                    <div class="form-group">
                        @if($classrooms)
                            <select name="kelas" id="kelas" class="form-control" placeholder="Pilih Kelas">
                                <option >Pilih Kelas</option>
                                @foreach($classrooms as $cls)
                                    <option value="{{ $cls->id }}">{{ $cls->classroom }}</option>
                                @endforeach
                            </select>
                        @else
                            <p>Data kelas tidak ada</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <select name="semester" id="semester" class="form-control">
                            <option>Semester</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>

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
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Siswa</th>
                                    <th class="col-md-1">UH 1</th>
                                    <th class="col-md-1">UH 2</th>
                                    <th class="col-md-1">UH 3</th>
                                    <th class="col-md-1">UH 4</th>
                                    <th class="col-md-1">UTS</th>
                                    <th class="col-md-1">UAS</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                            <form action="{{ url('/siswa/score') }}" method="post" >
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                <input type="hidden" name="contract" value="{{ $_GET['contract'] or '' }}">
                                <input type="hidden" name="semester" value="{{ $_GET['semester'] or '' }}">
                                <input type="hidden" name="kelas" value="{{ $_GET['kelas'] or '' }}">
                                @foreach($students as $std)
                                    <?php
                                        if($scores){
                                            $uh1 = $scores[$std->student_id]->uh_1;
                                            $uh2 = $scores[$std->student_id]->uh_2;
                                            $uh3 = $scores[$std->student_id]->uh_3;
                                            $uh4 = $scores[$std->student_id]->uh_4;

                                            $arrUh = array(
                                                    $uh1, $uh2, $uh3, $uh4
                                            );

                                            $uhAverage = array_sum($arrUh) / count($arrUh);
                                            $summary = (2 * $uhAverage + $scores[$std->student_id]->uts + $scores[$std->student_id]->uas) / 4;
                                        }

                                    ?>
                                    <tr>
                                        <td>{{ $std->nama }}</td>
                                        <td>
                                            <input type="number" class="form-control" name="uh1[{{ $std->student_id }}]" value="{{ $scores[$std->student_id]->uh_1 or 0 }}" />
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="uh2[{{ $std->student_id }}]" value="{{ $scores[$std->student_id]->uh_2 or 0 }}" />
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="uh3[{{ $std->student_id }}]" value="{{ $scores[$std->student_id]->uh_3 or 0 }}" />
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="uh4[{{ $std->student_id }}]" value="{{ $scores[$std->student_id]->uh_4 or 0 }}" />
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="uts[{{ $std->student_id }}]" value="{{ $scores[$std->student_id]->uts or 0 }}" />
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="uas[{{ $std->student_id }}]" value="{{ $scores[$std->student_id]->uas or 0 }}" />
                                        </td>
                                        <td>
                                            {{ $summary or 0 }} -
                                            @if($scores)
                                                @if($summary < 50)
                                                    E
                                                @elseif($summary < 58)
                                                    D
                                                @elseif($summary < 66)
                                                    C
                                                @elseif($summary <= 75)
                                                    B
                                                @elseif($summary > 76)
                                                    A
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <button class="btn btn-primary btn-fixed btn-floating">
                                    <i class="icon fa-save"></i>
                                </button>
                            </form>
                            </tbody>
                        </table>
                    @else
                        Please select options above
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop