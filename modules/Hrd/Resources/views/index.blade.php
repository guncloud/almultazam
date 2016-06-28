@extends('hrd::layouts_2.master')

@section('content')

	<section class="content-header">
		<h1>
			{{ $title or 'Kepegawaian' }}
			<small> {{ $subtitle or '' }} </small>
		</h1>
	</section>

	<div class="content">
		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Modul HRD </h3>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body">
				<ul>
					<li>Manajemen Pegawai secara keseluruhan</li>
					<li>Manaejemen Bagian / Divisi</li>
				</ul>
			</div><!-- /.box-body -->

		</div><!-- /.box -->

		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">System Updates
				</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body">
				<blockquote>
					<small>Untuk pelaporan error atau sistem tidak sesuai kebutuhan, mohon email : guncloud@yandex.com</small>
				</blockquote>
				<p>19-06-2016</p>
				<ul>
					<li>
						Fixed error saat simpan pegawai
					</li>
				</ul>
				<p>20-03-2016</p>
				<ul>
					<li>
						Update tampilan modul HRD
					</li>
					<li>
						Sistem dapat mengimport report pegawai semester 2
					</li>
					<li>
						Perbaikan penilaian kelas tertentu yang tidak muncul
					</li>
				</ul>
			</div><!-- /.box-body -->

		</div><!-- /.box -->
	</div>

@stop