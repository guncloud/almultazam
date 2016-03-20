@extends('hrd::layouts_2.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/pages/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/webui-popover/webui-popover.css') }}">
@endsection

    @section('content')

    <script>
        function getAge(lahir)
        {
            var d = lahir.slice(0, 10).split('-');
            var dateString = d[1] +'-'+ d[0] +'-'+ d[2];

            var today = new Date();
            var birthDate = new Date(dateString);
            var age = today.getFullYear() - birthDate.getFullYear();

            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate()))
            {
                age--;
            }
            if(age){
                document.write(', Umur : '+age);
            }

            return true;
        }
    </script>
    <!-- Page -->
    <div class="hidden" id="popMenu">
        <form class="form-inline " enctype="multipart/form-data" method="post" action="{{ url('/siswa/utility/upload-siswa') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    </div>
    <section class="content-header">
        <h1>{{ $title or 'Judul' }} <b>{{ $stakeholder->nama }}</b></h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/tool/pdf-profile-stakeholder/'.$stakeholder->id) }}" class="btn btn-primary" type="button">Save PDF</a></li>
        </ol>
    </section>

    <div class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h1 class="box-title">{{ $stakeholder->nama }}</h1>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <p>
                            {{ ($stakeholder->jenis_kelamin == 'l') ? 'Laki-laki' : 'Perempuan' }}, {{ $stakeholder->tempat_lahir }}, {{ $stakeholder->tanggal_lahir }}
                        </p>
                        <table class="table table-striped">
                            <tr>
                                <td>Kontak</td>
                                <td>{{ $stakeholder->kontak }}</td>
                            </tr>
                            <tr>
                                <td>KTP</td>
                                <td>{{ $stakeholder->ktp }}</td>
                            </tr>
                            <tr>
                                <td>NRP</td>
                                <td>{{ $stakeholder->nrp }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-4">

                        <table class="table table-striped">
                            <tr><td>Alamat Rumah</td><td>{{ $stakeholder->alamat_rumah }}</td></tr>
                            <tr><td>Alamat Sekarang</td><td>{{ $stakeholder->alamat_sekarang }}</td></tr>
                            <tr><td>Marital</td><td>{{ $stakeholder->status_maritak }}</td></tr>
                            <tr><td>Nama Suami / Istri</td><td>{{ $stakeholder->nama_suami_istri }}</td></tr>
                            <tr><td>Pekerjaan Suami / Istri</td><td>{{ $stakeholder->pekerjaan_keluarga }}</td></tr>
                        </table>

                        <table class="table table-striped">
                            <tr><td>TK</td><td>{{ $stakeholder->tk }}@if($stakeholder->tahun_lulus_tk){{ '( '.$stakeholder->tahun_lulus_tk.' )' }}@endif</td></tr>
                            <tr><td>SD</td><td>{{ $stakeholder->sd }}@if($stakeholder->tahun_lulus_sd){{ '( '.$stakeholder->tahun_lulus_sd.' )' }}@endif</td></tr>
                            <tr><td>SMP</td><td>{{ $stakeholder->smp }}@if($stakeholder->tahun_lulus_smp){{ '( '.$stakeholder->tahun_lulus_smp.' )' }}@endif</td></tr>
                            <tr><td>SMA</td><td>{{ $stakeholder->sma }}@if($stakeholder->tahun_lulus_sma){{ '( '.$stakeholder->tahun_lulus_sma.' )' }}@endif</td></tr>
                            <tr><td>Diploma</td><td>{{ $stakeholder->diploma }}@if($stakeholder->tahun_lulus_diploma){{ '( '.$stakeholder->tahun_lulus_diploma.' )' }}@endif</td></tr>
                            <tr><td>S1</td><td>{{ $stakeholder->s1 }}@if($stakeholder->tahun_lulus_s1){{ '( '.$stakeholder->tahun_lulus_s1.' )' }}@endif</td></tr>
                            <tr><td>S2</td><td>{{ $stakeholder->ts2 }}@if($stakeholder->tahun_lulus_s2){{ '( '.$stakeholder->tahun_lulus_s2.' )' }}@endif</td></tr>
                        </table>

                    </div>

                    <div class="col-md-4">
                        <table class="table table-striped">
                            <tr><td>Status Kepegawaian</td><td>{{ $stakeholder->status_kepegawaian }}</td></tr>
                            <tr><td>Divisi / Bagian</td><td>{{ $stakeholder->division->division }}</td></tr>
                            <tr><td>Jabatan</td><td>@if($positions)
                                        @foreach($positions as $pos)
                                            {{ $pos->position }}
                                        @endforeach
                                    @endif</td></tr>
                            <tr><td>Mulai Kerja</td><td>{{ $stakeholder->mulai_kerja }}</td></tr>
                            <tr><td>Golongan</td><td>{{ @$stakeholder->golongan->golongan }}</td></tr>
                        </table>

                        <table class="table table-striped">
                            <tr>
                                <td>Pendidikan Non-Formal</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li>{{ @$stakeholder->nama_lembaga_1 }} {{ @$stakeholder->jenis_pedidikan_1 }}</li>
                                        <li>{{ @$stakeholder->nama_lembaga_2 }} {{ @$stakeholder->jenis_pedidikan_2 }}</li>
                                        <li>{{ @$stakeholder->nama_lembaga_3 }} {{ @$stakeholder->jenis_pedidikan_3 }}</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Penglaman Kerja</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li>{{ $stakeholder->lembaga_pengalaman_kerja_1 }} {{ $stakeholder->alamat_pengalaman_kerja_1 }} {{ $stakeholder->jabatan_pengalaman_kerja_1 }} {{ $stakeholder->awal_kerja_1 }} {{ $stakeholder->akhir_kerja_1 }}</li>
                                        <li>{{ $stakeholder->lembaga_pengalaman_kerja_2 }} {{ $stakeholder->alamat_pengalaman_kerja_2 }} {{ $stakeholder->jabatan_pengalaman_kerja_1 }} {{ $stakeholder->awal_kerja_2 }} {{ $stakeholder->akhir_kerja_2 }}</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Penglaman Organisasi</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li>{{ $stakeholder->lembaga_organisasi_1 }} {{ $stakeholder->jabatan_organisasi_1 }}</li>
                                        <li>{{ $stakeholder->lembaga_organisasi_2 }} {{ $stakeholder->jabatan_organisasi_2 }}</li>
                                        <li>{{ $stakeholder->lembaga_organisasi_3 }} {{ $stakeholder->jabatan_organisasi_3 }}</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Keahlian</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li>{{ $stakeholder->keahlian_1 }} </li>
                                        <li>{{ $stakeholder->keahlian_2 }} </li>
                                        <li>{{ $stakeholder->keahlian_3 }} </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Anak</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li>{{ $stakeholder->child_1 }} <script>getAge("{{ $stakeholder->lahir_child_1 }}")</script></li>
                                        <li>{{ $stakeholder->child_2 }} <script>getAge("{{ $stakeholder->lahir_child_2 }}")</script> </li>
                                        <li>{{ $stakeholder->child_3 }} <script>getAge("{{ $stakeholder->lahir_child_3 }}")</script> </li>
                                        <li>{{ $stakeholder->child_4 }} <script>getAge("{{ $stakeholder->lahir_child_4 }}")</script> </li>
                                        <li>{{ $stakeholder->child_5 }} <script>getAge("{{ $stakeholder->lahir_child_5 }}")</script> </li>
                                        <li>{{ $stakeholder->child_6 }} <script>getAge("{{ $stakeholder->lahir_child_6 }}")</script> </li>
                                        <li>{{ $stakeholder->child_7 }} <script>getAge("{{ $stakeholder->lahir_child_7 }}")</script> </li>
                                        <li>{{ $stakeholder->child_8 }} <script>getAge("{{ $stakeholder->lahir_child_8 }}")</script> </li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>



                </div>

            </div>
        </div>
    </div>

    <!-- End Page -->
@stop

@section('js')
    <script src="{{ asset('/vendor/webui-popover/jquery.webui-popover.min.js') }}"></script>
    <script src="{{ asset('/vendor/toolbar/jquery.toolbar.min.js') }}"></script>
    <script src="{{ asset('/js/components/webui-popover.js') }}"></script>
    <script src="{{ asset('/js/components/toolbar.js') }}"></script>

    <script>
        $(function(){
            $(document).ready(function() {

                var defaults = $.components.getDefaults("webuiPopover");

                var tableContent = $('#popMenu').html(),
                        tableSettings = {
                            title: 'Download data pdf',
                            content: tableContent,
                            width: 500,
                            animation: 'pop'
                        };

                $('#btnPopMenu').webuiPopover($.extend({}, defaults,
                        tableSettings));
            });



        })
    </script>
@stop