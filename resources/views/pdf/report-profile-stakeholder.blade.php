<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Pegawai</title>

    <link href="{{ base_path('public/css/pure.min.css') }}" rel="stylesheet">
    <style>
        body{
            font-size: 12px;
        }
    </style>
</head>
<body>

<div class="container">
    <h3>{{ $title }}</h3>

    @if($stakeholder->photo)
        <img src="{{ base_path('public/photos/'.$stakeholder->photo) }}" alt="..." style="height: 140px">
    @else
        <img src="{{ base_path('public/photos/5.jpg') }}" alt="..." style="height: 140px">
    @endif

    <br>
    <br>

    Nama Lengkap : {{ $stakeholder->nama }} <br>
    KTP : {{ $stakeholder->ktp }} <br>
    NRP : {{ $stakeholder->nrp }}
    <br />
    <br />
    <table class="pure-table pure-table-bordered" style="width: 100%">
        <thead>
            <tr>
                <th colspan="4">Profil</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Jenis Kelamin</td>
                <td>{{ ($stakeholder->jenis_kelamin == 'l') ? 'Laki - laki' : 'perempuan' }}</td>
                <td>Nama Suami/Istri</td>
                <td>{{ $stakeholder->nama_istri_suami }} </td>

            </tr>
            <tr>
                <td>Kelahiran</td>
                <td>{{ $stakeholder->tempat_lahir }}, {{ date('d-m-Y', strtotime($stakeholder->tanggal_lahir)) }}</td>
                <td>Kontak</td>
                <td>{{ $stakeholder->kontak }} </td>
            </tr>
            <tr>
                <td>Alamat Rumah</td>
                <td>{{ $stakeholder->alamat_rumah }}</td>
                <td>Alamat Sekarang</td>
                <td>{{ $stakeholder->alamat_sekarang }}</td>
            </tr>
        </tbody>
    </table>

    <br />
    <table class="pure-table pure-table-bordered" style="width: 100%">
        <thead>
        <tr>
            <th colspan="4">Pendidikan</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>SD</td>
            <td>
                {{ $stakeholder->sd }}
                @if($stakeholder->tahun_lulus_sd)
                    {{ '( '.$stakeholder->tahun_lulus_sd.' )' }}
                @endif
            </td>
            <td>SMP</td>
            <td>
                {{ $stakeholder->smp }}
                @if($stakeholder->tahun_lulus_smp)
                    {{ '( '.$stakeholder->tahun_lulus_smp.' )' }}
                @endif
            </td>
        </tr>
        <tr>
            <td>SMA</td>
            <td>
                {{ $stakeholder->sma }}
                @if($stakeholder->tahun_lulus_sma)
                    {{ '( '.$stakeholder->tahun_lulus_sma.' )' }}
                @endif
            </td>
            <td>Diploma</td>
            <td>
                {{ $stakeholder->universitas_diploma }}
                @if($stakeholder->tahun_lulus_diploma)
                    {{ '( '.$stakeholder->tahun_lulus_diploma.' )' }}
                @endif
            </td>
        </tr>
        <tr>
            <td>S1</td>
            <td>
                {{ $stakeholder->universitas_s1 }}
                @if($stakeholder->tahun_lulus_s1)
                    {{ '( '.$stakeholder->tahun_lulus_s1.' )' }}
                @endif
            </td>
            <td>S2</td>
            <td>
                {{ $stakeholder->universitas_s2 }}
                @if($stakeholder->tahun_lulus_s2)
                    {{ '( '.$stakeholder->tahun_lulus_s2.' )' }}
                @endif
            </td>
        </tr>
        </tbody>
    </table>

    <br />
    <table class="pure-table pure-table-bordered" style="width: 100%">
        <thead>
        <tr>
            <th colspan="4">Status Kepegawaian</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>Status Kepegawaian</td>
                <td>{{ $stakeholder->status_kepegawaian }}</td>
                <td>Jabatan</td>
                <td>
                    @if($stakeholder->positions)
                        @foreach($stakeholder->positions as $pos)
                            {{ $pos->position }},
                        @endforeach
                    @endif
                </td>
            </tr>
            <tr>
                <td>Mulai Kerja</td>
                <td>{{ $stakeholder->mulai_kerja }}</td>
                <td>Golongan</td>
                <td>{{ @$stakeholder->golongan->golongan }}</td>
            </tr>
        </tbody>
    </table>

    <br />
    <table class="pure-table pure-table-bordered" style="width: 100%">
        <thead>
        <tr>
            <th colspan="4">Pendidikan Non Formal</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td> {{ $stakeholder->nama_lembaga_1 }} </td>
                <td> {{ $stakeholder->pendidikan_lembaga_1 }} </td>
                <td> {{ $stakeholder->nama_lembaga_2 }} </td>
                <td> {{ $stakeholder->pendidikan_lembaga_2 }} </td>
            </tr>
            <tr>
                <td> {{ $stakeholder->nama_lembaga_3 }} </td>
                <td> {{ $stakeholder->pendidikan_lembaga_3 }} </td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <br />
    <table class="pure-table pure-table-bordered" style="width: 100%">
        <thead>
        <tr>
            <th colspan="5">Pengalaman Kerja</th>
        </tr>
        <tr>
            <th>Lembaga</th>
            <th>Alamat</th>
            <th>Jabatan</th>
            <th>Awal Kerja</th>
            <th>Akhir Kerja</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $stakeholder->lembaga_pengalaman_kerja_1 }}</td>
                <td>{{ $stakeholder->alamat_pengalaman_kerja_1 }}</td>
                <td>{{ $stakeholder->jabatan_pengalaman_kerja_1 }} </td>
                <td>{{ $stakeholder->awal_kerja_1 }}</td>
                <td>{{ $stakeholder->akhir_kerja_1 }}</td>
            </tr>
            <tr>
                <td>{{ $stakeholder->lembaga_pengalaman_kerja_2 }}</td>
                <td>{{ $stakeholder->alamat_pengalaman_kerja_2 }}</td>
                <td>{{ $stakeholder->jabatan_pengalaman_kerja_2 }} </td>
                <td>{{ $stakeholder->awal_kerja_2 }}</td>
                <td>{{ $stakeholder->akhir_kerja_2 }}</td>
            </tr>
        </tbody>
    </table>

    <br />
    <table class="pure-table pure-table-bordered" style="width: 100%">
        <thead>
        <tr>
            <th colspan="2">Pengalaman Organisasi</th>
        </tr>
        <tr>
            <th>Lembaga</th>
            <th>Jabatan</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $stakeholder->lembaga_organisasi_1 }}</td>
            <td>{{ $stakeholder->jabatan_organisasi_1 }}</td>
        </tr>
        <tr>
            <td>{{ $stakeholder->lembaga_organisasi_2 }}</td>
            <td>{{ $stakeholder->jabatan_organisasi_2 }}</td>
        </tr>
        </tbody>
    </table>

    <br />
    <table class="pure-table pure-table-bordered" style="width: 100%">
        <thead>
        <tr>
            <th>Keahlian</th>
        </tr>
        <tbody>
        <tr>
           <td>{{ $stakeholder->keahlian_1 }}</td>
        </tr>
        <tr>
            <td>{{ $stakeholder->keahlian_2 }}</td>
        </tr>
        <tr>
            <td>{{ $stakeholder->keahlian_3 }}</td>
        </tr>
        </tbody>
    </table>

    <br />
    <table class="pure-table pure-table-bordered" style="width: 100%">
        <thead>
        <tr>
            <th>Anak</th>
        </tr>
        <tbody>
        <tr>
            <td>{{ $stakeholder->child_1 }}
                <?php
                if($stakeholder->lahir_child_1){
                    $birthDate = explode("-", $stakeholder->lahir_child_1);
                    $birthDate = array_filter($birthDate);

                    if($birthDate[2] > 0){
                        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[0], $birthDate[2]))) > date("md")
                                ? ((date("Y") - $birthDate[2]) - 1)
                                : (date("Y") - $birthDate[2]));
                        echo "Umur " .$age;
                    }
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>{{ $stakeholder->child_2 }}
                <?php
                if($stakeholder->lahir_child_2){
                    $birthDate = explode("-", $stakeholder->lahir_child_2);
                    $birthDate = array_filter($birthDate);

                    if($birthDate[2] > 0){
                        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[0], $birthDate[2]))) > date("md")
                                ? ((date("Y") - $birthDate[2]) - 1)
                                : (date("Y") - $birthDate[2]));
                        echo "Umur " .$age;
                    }else{
                        $age = '';
                    }
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>{{ $stakeholder->child_3 }}
                <?php
                if($stakeholder->lahir_child_3){
                    $birthDate = explode("-", $stakeholder->lahir_child_3);
                    $birthDate = array_filter($birthDate);

                    if($birthDate[2] > 0){
                        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[0], $birthDate[2]))) > date("md")
                                ? ((date("Y") - $birthDate[2]) - 1)
                                : (date("Y") - $birthDate[2]));
                        echo "Umur " .$age;
                    }
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>{{ $stakeholder->child_4 }}
                <?php
                if($stakeholder->lahir_child_4){
                    $birthDate = explode("-", $stakeholder->lahir_child_4);
                    $birthDate = array_filter($birthDate);

                    if($birthDate[2] > 0){
                        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[0], $birthDate[2]))) > date("md")
                                ? ((date("Y") - $birthDate[2]) - 1)
                                : (date("Y") - $birthDate[2]));
                        echo "Umur " .$age;
                    }
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>{{ $stakeholder->child_5 }}
                <?php
                if($stakeholder->lahir_child_5){
                    $birthDate = explode("-", $stakeholder->lahir_child_5);
                    $birthDate = array_filter($birthDate);

                    if($birthDate[2] > 0){
                        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[0], $birthDate[2]))) > date("md")
                                ? ((date("Y") - $birthDate[2]) - 1)
                                : (date("Y") - $birthDate[2]));
                        echo "Umur " .$age;
                    }
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>{{ $stakeholder->child_6 }}
                <?php
                if($stakeholder->lahir_child_6){
                    $birthDate = explode("-", $stakeholder->lahir_child_6);
                    $birthDate = array_filter($birthDate);

                    if($birthDate[2] > 0){
                        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[0], $birthDate[2]))) > date("md")
                                ? ((date("Y") - $birthDate[2]) - 1)
                                : (date("Y") - $birthDate[2]));
                        echo "Umur " .$age;
                    }
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>{{ $stakeholder->child_7 }}
                <?php
                if($stakeholder->lahir_child_7){
                    $birthDate = explode("-", $stakeholder->lahir_child_7);
                    $birthDate = array_filter($birthDate);

                    if($birthDate[2] > 0){
                        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[0], $birthDate[2]))) > date("md")
                                ? ((date("Y") - $birthDate[2]) - 1)
                                : (date("Y") - $birthDate[2]));
                        echo "Umur " .$age;
                    }
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>{{ $stakeholder->child_8 }}
                <?php
                if($stakeholder->lahir_child_8){
                    $birthDate = explode("-", $stakeholder->lahir_child_8);
                    $birthDate = array_filter($birthDate);

                    if($birthDate[2] > 0){
                        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[0], $birthDate[2]))) > date("md")
                                ? ((date("Y") - $birthDate[2]) - 1)
                                : (date("Y") - $birthDate[2]));
                        echo "Umur " .$age;
                    }
                }
                ?>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>