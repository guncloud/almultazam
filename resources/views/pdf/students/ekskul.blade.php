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
    @if($ekskuls)
        @foreach($ekskuls as $eks)
        <h4>{{ $eks->ekskul }}</h4>
        <table class="pure-table pure-table-bordered" style="width: 100%">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kehadiran</th>
                    <th>Skor</th>
                </tr>
            </thead>
            <tbody>
                @if($ekskulStudent)
                    @foreach($ekskulStudent as $eksStd)
                        <tr>
                            <td>{{ $eksStd->date }}</td>
                            <td>{{ $eksStd->attendance }}</td>
                            <td>{{ $eksStd->score }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        @endforeach
    @endif
</div>
</body>
</html>