<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        .scontainer{
            border: 1px solid darkgreen;
        }
        @font-face{
            font-family: Renfrew;
            src: url('Renfrew.ttf');
        }

        .container {
            background: rgb(232, 255, 201);
            color: black;

            border: 2px dashed #fff;
            border-radius: 10px;
            box-shadow: 0 0 0 4px #ff0030, 2px 1px 6px 4px rgba(10, 10, 0, 0.5);
            text-shadow: -1px -1px #aa3030;
            font-weight: normal;
        }

        h2 {
            color: #999;
        }

        p{
            font-size: 30px;
        }


    </style>
</head>
<body marginwidth="0" marginheight="0" >

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