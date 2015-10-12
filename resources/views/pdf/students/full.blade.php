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

    Profil

    <table class="pure-table pure-table-bordered" style="width: 100%">
    <tbody>
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
            <td colspan="4">Ibu</td>
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
            <td colspan="4">Ayah</td>
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
            <td colspan="4">Wali</td>
        </tr>
        <tr>
            <td>Ayah</td>
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
    </tbody>
    </table>
    <br>
    <hr>

    <h4>Akademik</h4>
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
    <br>
    <hr>

    <h4>Ekskul</h4>
    @if($ekskuls)
        @foreach($ekskuls as $eks)
            <b>{{ $eks->ekskul }}</b>
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
    <br>
    <hr>

    <h4>Prestasi</h4>
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
    <br>
    <hr>

    <h4>Pelanggaran</h4>
    <table class="pure-table pure-table-bordered" style="width: 100%">
        <thead>
        <tr>
            <th>Tanggal</th>
            <th>Pelanggaran</th>
            <th>Poin</th>
        </tr>
        </thead>
        <tbody>
        @foreach($student->violations as $v)
            <tr>
                <td>{{ $v->date }}</td>
                <td>{{ $v->violation }}</td>
                <td>{{ $v->point }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
</body>
</html>