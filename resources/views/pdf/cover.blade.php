<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Pegawai</title>

    <link href="{{ base_path('public/css/pure.min.css') }}" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'renfrew';
            src : url('Renfrew.ttf') format('truetype');
        },
    </style>
</head>
<body>

<div class="container">

    <center style="padding-top: 110px">
        <h1 style="font-family: renfrew">
            RAPORT PEGAWAI <br>
            YPI AL-MULTAZAM <br>
            HUSNUL KHOTIMAH <br>
        </h1>

        <img src="{{ base_path('public/img/logo-cover.png') }}" alt="" style="margin-top: 150px">

        <h1 style="margin-top: 150px">
            SEMESTER {{ ($semester == '1') ? 'GANJIL' : 'GENAP' }} <br>
            TAHUN AKADEMIK {{ $year }} <br>
        </h1>

    </center>
</div>

</body>
</html>