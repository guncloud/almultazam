@extends('hrd::layouts.master')

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
                    Modul HRD :
					<ul>
                        <li>Manajemen Pegawai secara keseluruhan</li>
                        <li>Manaejemen Bagian / Divisi</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

@stop