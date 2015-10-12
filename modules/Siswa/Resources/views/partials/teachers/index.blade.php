@extends('siswa::layouts.master')

@section('content')

    <div class="page animsition">
        <div class="page-header">
            <h4 class="page-title">{{ $title or 'Judul' }}</h4>
        </div>
        <div class="page-content">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $sub_title or null }}</h3>
                </div>
                <div class="panel-body">
                    @if($teachers == false)
                        No data, You can import or add new data
                    @else
                        <table class="table table-hover dataTable table-striped width-full" id="tableStakeholder">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>TTL</th>
                                <th>J. Kelamin</th>
                                <th>Status</th>
                                <th>Detail</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teachers as $v)
                                <tr>
                                    <td>{{ $v->nama }}</td>
                                    <td>{{ $v->tempat_lahir }}, {{ $v->tanggal_lahir }}</td>
                                    <td>{{ $v->jenis_kelamin }}</td>
                                    <td>{{ $v->status }}</td>
                                    <td>
                                        <a href="{{ url('/siswa/teacher/show/'.$v->id) }}" class="btn btn-success btn-sm tooltip-success tooltip-rotate" data-toggle="tooltip" data-original-title="Detail Pegawai " type="button">
                                            <i class="icon wb-arrow-right"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop