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
                        @if($classrooms)
                            <select name="kelas" id="classroom" class="form-control" placeholder="Pilih Kelas">
                                <option >Pilih Kelas</option>
                                @foreach($classrooms as $cls)
                                    <option {{ (@$_GET['kelas'] == $cls->id) ? 'selected' : '' }} value="{{ $cls->id }}">
                                        {{ $cls->classroom }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <p>Data kelas tidak ada</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <select name="contract" id="contract" class="form-control">
                            <option >Pilih Kelas</option>
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
                                        $uhAverage = 0;

                                        if(isset($scores)){
                                            $uh1 = isset($scores[$std->student_id]->uh_1) ? $scores[$std->student_id]->uh_1 : 0;
                                            $uh2 = isset($scores[$std->student_id]->uh_2) ? $scores[$std->student_id]->uh_2 : 0;
                                            $uh3 = isset($scores[$std->student_id]->uh_3) ? $scores[$std->student_id]->uh_3 : 0;
                                            $uh4 = isset($scores[$std->student_id]->uh_4) ? $scores[$std->student_id]->uh_4 : 0;
                                            $uts = isset($scores[$std->student_id]->uts) ? $scores[$std->student_id]->uts : 0;
                                            $uas = isset($scores[$std->student_id]->uas) ? $scores[$std->student_id]->uas : 0;

                                            $arrUh = array(
                                                    $uh1, $uh2, $uh3, $uh4
                                            );

                                            $uhAverage = array_sum($arrUh) / count($arrUh);
                                            $summary[$std->id] = (2 * $uhAverage + $uts + $uas) / 4;
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
                                            {{ $summary[$std->id] }} -
                                            @if(isset($scores))
                                                @if($summary[$std->id] < 50)
                                                    E
                                                @elseif($summary[$std->id] < 58)
                                                    D
                                                @elseif($summary[$std->id] < 66)
                                                    C
                                                @elseif($summary[$std->id] < 74)
                                                    B
                                                @elseif($summary[$std->id] > 75)
                                                    A
                                                @else
                                                    XX
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

@section('js')
    <script>
        $(function(){
            $('#classroom').change(function(){
                var val = $(this).val();

                $.ajax({
                    url : "{{ url('siswa/contract/') }}/"+val,
                    success : function(data){
                        $('#contract').children().remove();
                        console.log(data);
                        $.each(data, function(x, i){
                            console.log(i);
                            $('#contract').append(
                                    '<option value="'+ i.id +'">' + i.code + ' ' + i.subject + ' ( T. ' +i.grade + ')' + '( S. ' +i.semester + ')' +'</option>'
                            );
                        })
                    }
                })
            });
        })
    </script>
@stop