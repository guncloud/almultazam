
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Laporan Siswa</title>

    <link href="{{ base_path('public/css/pure.min.css') }}" rel="stylesheet">
    <style>
        .body{
            font-size: 19px;
        }
        td{border-bottom:1px solid #cbcbcb}
    </style>
</head>
<body>
<div class="container">
    <h3>{{ $title }}</h3>

    Profil

    <table class="pure-table pure-table-bordered" style="width: 100%">
        <tr>
            <td>Nis</td>
            <td>{{ $student->nis }}</td>

            <td>Nama</td>
            <td>{{ $student->nama }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>{{ $student->jenis_kelamin }}</td>

            <td>Kelahiran</td>
            <td>{{ $student->tempat_lahir }}, {{ $student->tanggal_lahir }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>{{ $student->nik }}</td>

            <td>Alamat</td>
            <td>{{ $student->alamat }}</td>
        </tr>
        <tr>
            <td>Jenis Tinggal</td>
            <td>{{ $student->jenis_tinggal }}</td>

            <td>Kontak</td>
            <td>{{ $student->handphone }}, {{ $student->telepon }}, {{ $student->email }}</td>
        </tr>
        <tr>
            <td colspan="4" style="border-bottom:1px solid #cbcbcb; border-top:1px solid #cbcbcb">Ibu</td>
        </tr>
        <tr>
            <td>Nama Ibu</td>
            <td>{{ $student->ibu }}</td>

            <td>Tahun Lahir</td>
            <td>{{ $student->tahun_lahir_ibu }}</td>
        </tr>
        <tr>
            <td>Jenjang Pendidikan</td>
            <td>{{ $student->jenjang_pendidikan_ibu }}</td>

            <td>Pekerjaan</td>
            <td>{{ $student->pekerjaan_ibu }}</td>
        </tr>
        <tr>
            <td>SKHUN</td>
            <td>{{ $student->skhun_ibu }}</td>

            <td>KPS</td>
            <td>{{ $student->kps_ibu }}</td>
        </tr>
        <tr>
            <td colspan="4"  style="border-bottom:1px solid #cbcbcb; border-top:1px solid #cbcbcb">Ayah</td>
        </tr>
        <tr>
            <td>Ayah</td>
            <td>{{ $student->ayah }}</td>

            <td>Tahun Lahir</td>
            <td>{{ $student->tahun_lahir_ayah }}</td>
        </tr>

        <tr>
            <td>Jenjang Pendidikan</td>
            <td>{{ $student->jenjang_pendidikan_ayah }}</td>

            <td>Pekerjaan</td>
            <td>{{ $student->pekerjaan_ayah }}, {{ $student->penghasilan_ayah }} perbulan</td>
        </tr>
        <tr>
            <td colspan="4" style="border-bottom:1px solid #cbcbcb; border-top:1px solid #cbcbcb">Wali</td>
        </tr>
        <tr>
            <td>Wali</td>
            <td>{{ $student->wali }}</td>

            <td>Tahun Lahir</td>
            <td>{{ $student->tahun_lahir_wali }}</td>
        </tr>

        <tr>
            <td>Jenjang Pendidikan</td>
            <td>{{ $student->jenjang_pendidikan_wali }}</td>

            <td>Pekerjaan</td>
            <td>{{ $student->pekerjaan_wali }}, {{ $student->penghasilan_wali }} perbulan</td>
        </tr>
    </table>

</div>
</body>
</html>