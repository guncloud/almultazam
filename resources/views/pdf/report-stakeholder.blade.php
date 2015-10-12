<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Raport Pegawai</title>

    <link href="{{ base_path('public/css/pure.min.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <h3>{{ $title }}</h3>

        NRP : {{ $stakeholder->nrp }} <br>
        Nama Lengkap : {{ $stakeholder->nama }} <br>

        Bagian : {{ $stakeholder->division->division }} <br >
        Jabatan : {{ $stakeholder->jabatan }} <br>
    <br>

    <table class="pure-table pure-table-bordered">
        <thead>
        <tr>
            <th>Kriteria</th>
            <th>Indikator</th>
            <th>Skor</th>
            <th>Nilai</th>
        </tr>
        </thead>
        <tbody>
        @foreach($report as $rpt)
            <tr>
                <td>{{ $rpt->indicator }}</td>
                <td>
                    @foreach($rpt->performances as $v)
                        {{ $v->performance }} <br>
                    @endforeach
                </td>
                <td>
                    @foreach($rpt->performances as $v)
                        {{ @$reportScores[$v->id]->score }} <br>
                    @endforeach
                </td>
                <td>
                    @foreach($rpt->performances as $v)
                        @if(@$reportScores[$v->id]->score < 55)
                            Kurang
                        @elseif(@$reportScores[$v->id]->score < 70)
                            Sedang
                        @elseif(@$reportScores[$v->id]->score <= 80)
                            Cukup
                        @elseif(@$reportScores[$v->id]->score <= 90)
                            Baik
                        @elseif(@$reportScores[$v->id]->score > 90)
                            Sangat baik
                        @else
                            -
                        @endif
                        <br>
                    @endforeach
                </td>
            </tr>
        @endforeach
        <tr>
            <td>Total Skor</td>
            <td colspan="3">{{ $totalScore }}</td>
        </tr>
        <tr>
            <td>Kesimpulan</td>
            <td colspan="3">
                @if(@$totalScore < 55)
                    Kurang
                @elseif(@$totalScore < 70)
                    Sedang
                @elseif(@$totalScore <= 80)
                    Cukup
                @elseif(@$totalScore <= 90)
                    Baik
                @elseif(@$totalScore > 90)
                    Sangat baik
                @else
                    -
                @endif
            </td>
        </tr>
        </tbody>
    </table>

    <div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <p style="text-align: right">
            Kuningan, <?php echo date('d-m-y') ?> 
        </p>
        
        <p>
            Mengatahui :
        </p>
        
        <div>
            <a style="margin-left: 45px">
                Kepala Divisi HRD ............. ,
            </a>
            <a style="margin-left: 355px">
                Kepala Bagian
            </a>
        </div>
        <br>
        <br>
        <br>
        <br>

        <div>
            <a style="border-bottom: 1px solid black">
                H. Dul Ahmad Bachtiar, Lc, M.Pd.I
            </a>
            <a style="border-bottom: 1px solid black; margin-left: 285px">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </a>
        </div>
    </div>
</div>
</body>
</html>