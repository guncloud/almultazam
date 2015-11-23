<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
    <link href="http://fonts.googleapis.com/css?family=Give+You+Glory&amp;v2" rel="stylesheet" type="text/css">
    <style type="text/css">
        body {
            font-family: sans-serif;
        }
        @font-face{
            font-family: Renfrew;
            src: url('Renfrew.ttf');
        }

        h2 {
            color: #999;
        }

        p{
            font-size: 30px;
        }
    </style>
</head>
<body marginwidth="0" marginheight="0">

<div class="container" style="text-align: center">
    <p>
        RAPORT PEGAWAI <br>
        YAYASAN PENDIDIKAN ISLAM
    </p>
    <p style="font-family: 'Renfrew', sans-serif;"> AL-MULTAZAM
        HUSNUL KHOTIMAH
    </p>

    <img src="{{ base_path('public/img/logo-cover.png') }}" alt="" style="margin-top: 200px">


    <h1 style="margin-top: 250px">
        SEMESTER {{ ($semester == '1') ? 'GANJIL' : 'GENAP' }} <br>
        TAHUN AKADEMIK {{ $year }} <br>
    </h1>
</div>

</body></html>