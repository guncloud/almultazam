<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Raport Pegawai</title>

    <link href="{{ base_path('public/css/pure.min.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <h3 style="text-align: center">RAPORT PEGAWAI
        YAYASAN PENDIDIKAN ISLAM
        AL-MULTAZAM HUSNUL KHOTIMAH</h3>

        @if($stakeholder->photo)
            <img src="{{ base_path('public/photos/'.$stakeholder->photo) }}" alt="..." style="height: 140px">
        @else
            <img src="{{ base_path('public/photos/5.jpg') }}" alt="..." style="height: 140px">
        @endif

        <br>
        <br>

        NRP : {{ $stakeholder->nrp }} <br>
        Nama Lengkap : {{ $stakeholder->nama }} <br>

        Bagian : {{ @$stakeholder->division->division }} <br >
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
                            E (Kurang)
                        @elseif(@$reportScores[$v->id]->score < 70)
                            D (Sedang)
                        @elseif(@$reportScores[$v->id]->score <= 80)
                            C (Cukup)
                        @elseif(@$reportScores[$v->id]->score <= 90)
                            B (Baik)
                        @elseif(@$reportScores[$v->id]->score > 90)
                            A (Sangat Baik)
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
                    E (Kurang)
                @elseif(@$totalScore < 70)
                    D (Sedang)
                @elseif(@$totalScore <= 80)
                    C (Cukup)
                @elseif(@$totalScore <= 90)
                    B (Baik)
                @elseif(@$totalScore > 90)
                    A (Sangat Baik)
                @else
                    -
                @endif
            </td>
        </tr>
        </tbody>
    </table>

    <div>
        <br>

        <p style="text-align: right">
            Kuningan, <?php echo date('d-m-y') ?> 
        </p>
        
        <p>
            Mengetahui :
        </p>
        
        <div>
            <a style="margin-left: 20px">
                Kepala Divisi HRD ,
            </a>
            <a style="margin-left: 350px">
                Kepala Disivsi/Bagian
            </a>
        </div>
        <br>
        <br>
        <br>

        <div>
            <a style="border-bottom: 1px solid black">
                {{ $kepala_divisi->value or 'Kepala divisi belum di set' }}
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