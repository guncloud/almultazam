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

    <table class="pure-table pure-table-bordered" style="width: 100%">
        <thead>
        <tr>
            <th>Tanggal</th>
            <th>Prestasi</th>
            <th>Keterangan</th>
        </tr>
        </thead>
        <tbody>
        @foreach($student->achievements as $v)
            <tr>
                <td>{{ $v->date }}</td>
                <td>{{ $v->achievement }}</td>
                <td>{{ $v->info }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
</body>
</html>