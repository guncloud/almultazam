<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Siswa</title>

    <link href="{{ base_path('public/css/pure.min.css') }}" rel="stylesheet">
    <style>
        .body{
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="container">
    <h3>{{ $title }}</h3>

    Nama Lengkap : {{ $student->nama }} <br>
    Kelas : {{ $classroom->classroom }}
    <hr>
    @if($contracts)
        <table class="pure-table pure-table-bordered" style="width: 100%">
            <thead>
            <tr>
                <th>M. Pelajaran</th>
                <th>Semester</th>
                <th>UH 1</th>
                <th>UH 2</th>
                <th>UH 3</th>
                <th>UH 4</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>NA</th>
                <th>Skor</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contracts as $v)
                <tr>
                    <td>{{ $v->subject }}</td>
                    <td>{{ $v->semester }}</td>
                    <td>{{ $scores[$v->id]->uh_1 }}</td>
                    <td>{{ $scores[$v->id]->uh_2 }}</td>
                    <td>{{ $scores[$v->id]->uh_3 }}</td>
                    <td>{{ $scores[$v->id]->uh_4 }}</td>
                    <td>{{ $scores[$v->id]->uts }}</td>
                    <td>{{ $scores[$v->id]->uas }}</td>
                    <td>
                        {{ $scores[$v->id]->skor }}
                    </td>
                    <td>
                        @if($scores[$v->id]->skor < 50)
                            <span class="badge badge-danger">E</span>
                        @elseif($scores[$v->id]->skor < 58)
                            <span class="badge badge-warning">D</span>
                        @elseif($scores[$v->id]->skor < 66)
                            <span class="badge badge-default">C</span>
                        @elseif($scores[$v->id]->skor <= 75)
                            <span class="badge badge-primary">B</span>
                        @elseif($scores[$v->id]->skor > 76)
                            <span class="badge badge-success">A</span>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
</body>
</html>