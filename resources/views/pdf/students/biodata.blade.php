
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Laporan Siswa</title>

    <link href="{{ base_path('public/css/pure.min.css') }}" rel="stylesheet">
    <style>
        .body{
            font-size: 19px;
        }
        td{
            padding: 5px; border-bottom: 1px solid grey
        }
    </style>
</head>
<body>
<div class="container">

    <h3>{{ $title }}</h3>

    Profil <br>
    <hr>

    <table class="pure-tas" style="width: 100%">
        <tr>
            <td>Nis</td>
            <td>:</td>
            <td>{{ $student->nis }}</td>


            <td style="border-left: 1px solid grey; padding-left: 10px">Nama</td>
            <td>:</td>
            <td nowrap="">{{ $student->nama }}</td>
        </tr>
        <tr>
            <td nowrap="">Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $student->jenis_kelamin }}</td>

            <td style="border-left: 1px solid grey; padding-left: 10px">Kelahiran</td>
            <td>:</td>
            <td>{{ $student->tempat_lahir }}, {{ $student->tanggal_lahir }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $student->nik }}</td>

            <td style="border-left: 1px solid grey; padding-left: 10px">Alamat</td>
            <td>:</td>
            <td>{{ $student->alamat }}</td>
        </tr>
        <tr>
            <td>Jenis Tinggal</td>
            <td>:</td>
            <td>{{ $student->jenis_tinggal }}</td>

            <td style="border-left: 1px solid grey; padding-left: 10px">Kontak</td>
            <td>:</td>
            <td>{{ $student->handphone }}, {{ $student->telepon }}, {{ $student->email }}</td>
        </tr>
        <tr>
            <td colspan="6" style="border-bottom:1px solid #cbcbcb; border-top:1px solid #cbcbcb; padding-top: 10px">
                <b>Data Ibu</b>
            </td>
        </tr>
        <tr>
            <td>Nama Ibu</td>
            <td>:</td>
            <td>{{ $student->ibu }}</td>

            <td style="border-left: 1px solid grey; padding-left: 10px">Tahun Lahir</td>
            <td>:</td>
            <td> {{ $student->tahun_lahir_ibu }}</td>
        </tr>
        <tr>
            <td nowrap>Jenjang Pendidikan</td>
            <td>:</td>
            <td>{{ $student->jenjang_pendidikan_ibu }}</td>

            <td style="border-left: 1px solid grey; padding-left: 10px">Pekerjaan</td>
            <td>:</td>
            <td>{{ $student->pekerjaan_ibu }}</td>
        </tr>
        <tr>
            <td>SKHUN</td>
            <td>:</td>
            <td>{{ $student->skhun_ibu }}</td>

            <td style="border-left: 1px solid grey; padding-left: 10px">KPS</td>
            <td>:</td>
            <td>{{ $student->kps_ibu }}</td>
        </tr>
        <tr>
            <td colspan="6"  style="border-bottom:1px solid #cbcbcb; border-top:1px solid #cbcbcb ; padding-top: 10px">
                <b>Data Ayah</b>
            </td>
        </tr>
        <tr>
            <td>Ayah</td>
            <td>:</td>
            <td>{{ $student->ayah }}</td>

            <td style="border-left: 1px solid grey; padding-left: 10px">Tahun Lahir</td>
            <td>:</td>
            <td>{{ $student->tahun_lahir_ayah }}</td>
        </tr>

        <tr>
            <td>Jenjang Pendidikan</td>
            <td>:</td>
            <td>{{ $student->jenjang_pendidikan_ayah }}</td>

            <td style="border-left: 1px solid grey; padding-left: 10px">Pekerjaan</td>
            <td>:</td>
            <td>{{ $student->pekerjaan_ayah }}, {{ $student->penghasilan_ayah }} perbulan</td>
        </tr>
        <tr>
            <td colspan="6" style="border-bottom:1px solid #cbcbcb; border-top:1px solid #cbcbcb;  padding-top: 10px">
                <b>Data Wali</b>
            </td>
        </tr>
        <tr>
            <td>Wali</td>
            <td>:</td>
            <td>{{ $student->wali }}</td>

            <td style="border-left: 1px solid grey; padding-left: 10px" nowrap>Tahun Lahir</td>
            <td>:</td>
            <td>{{ $student->tahun_lahir_wali }}</td>
        </tr>

        <tr>
            <td>Jenjang Pendidikan</td>
            <td>:</td>
            <td>{{ $student->jenjang_pendidikan_wali }}</td>

            <td style="border-left: 1px solid grey; padding-left: 10px">Pekerjaan</td>
            <td>:</td>
            <td>{{ $student->pekerjaan_wali }}, {{ $student->penghasilan_wali }} perbulan</td>
        </tr>
    </table>

</div>
</body>
</html>