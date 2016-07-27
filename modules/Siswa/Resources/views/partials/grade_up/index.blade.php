@extends('siswa::layouts.master')

@section('css')
	<style type="text/css">
		.label{
			margin : 0 5px !important;
		}
	</style>
@stop

@section('content')
	<div class="page animsition">
		<div class="page-header">
		    <h4 class="page-title">{{ $title or 'Judul' }}</h4>
		    <div class="page-header-actions">
		        
		    </div>
		</div>

		<div class="page-content">
			<div class="row">
				<div class="col-md-6">
					<form class="form-inline">
						<div class="form-group">
							<select class="form-control" name="cid">
								@foreach($classroom as $cls)
									<option value="{{ $cls->id }}" {{ ($classroom_picked == $cls->id) ? 'selected' : '' }}>{{ $cls->classroom }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<select class="form-control" name="tahun_ajar">
								<option value="2015/2016" {{ ($year_picked == '2015/2016') ? 'selected' : '' }}>2015/2016</option>
								<option value="2016/2017" {{ ($year_picked == '2016/2017') ? 'selected' : '' }}>2016/2017</option>
								<option value="2017/2018" {{ ($year_picked == '2017/2018') ? 'selected' : '' }}>2017/2018</option>
							</select>
						</div>
						<div class="form-group">
							<button class="btn btn-primary">Submit</button>
						</div>
						<div class="form-group">
							
						</div>
			        </form>
				</div>
			</div> <br>
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">{{ $sub_title or null }}, Tahun Ajar {{ $tahun_ajar }}
						<span id="grade-info"></span> 
					</h3>
				</div>
				
				<table class="table table-bordered table-striped">
					<form method="post" action="{{ url('/siswa/naik-kelas/') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="new_tahun_ajar" value="{{ $new_tahun_ajar }}">
						<thead>
							<tr>
								<th>#</th>
								<th>NIS</th>
								<th>Nama</th>
								<th>Kelas Lanjutan {{ $lanjutan }} untuk tahun ajaran {{ $new_tahun_ajar }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($siswa as $k => $v)
								<tr>
									<td>{{ $k+1 }}</td>
									<td>{{ $v->nis }}</td>
									<td>{{ $v->nama }}</td>
									<td>
										@foreach($classroom_next as $cn)
											<input type="radio" name="kelas_lanjutan[{{ $v->student_id }}]" 
												value="{{$cn->id}}" {{ (@$classroom_upgrade[$v->student_id] == $cn->id) ? 'checked' : '' }} 
												class="grade_info" data-id = "{{ $v->student_id }}" > 
												{{ $cn->classroom }}

										@endforeach
										<input type="radio" name="kelas_lanjutan[{{ $v->student_id }}]" 
											value="null" {{ (isset($classroom_upgrade[$v->student_id])) ? '' : 'checked' }} class="grade_info" data-id = "{{ $v->student_id }}"> None
									</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<td colspan="4">
									<button class="btn btn-primary pull-right">Save</button>
								</td>
							</tr>
						</tfoot>
					</form>
				</table>
				
			</div>
		</div>
	</div>
@stop

@section('js')
	<script type="text/javascript">
		$(function(){
			
			count_next_grade = new Array();
			default_info = {};

			$('.grade_info:checked').each(function(data){
				if($(this).val() != 'null' ){
					var obj = {};
					var id = $(this).attr('data-id');

					obj[id] = $(this).val();
					default_info[id] = $(this).val();
				}
			});

			$.ajax("{{ url('/siswa/naik-kelas/count-next-grade?year='.$new_tahun_ajar) }}",{
				success : function(data){
					// console.log(data);
					count_next_grade = data;
					show_info(count_next_grade);
				},
				dataType: "json",
			});

			$('.grade_info').change(function(){
				var val = $(this).val();
				var before_siswa_id = $(this).attr('data-id');
				var before_kelas_id = default_info[before_siswa_id];

				default_info[before_siswa_id] = val;

				if(val != 'null'){
					count_next_grade[val].jumlah += 1;
					if(count_next_grade[before_kelas_id]){
						count_next_grade[before_kelas_id].jumlah -= 1;
					}
					show_info(count_next_grade);
				}else{
					count_next_grade[before_kelas_id].jumlah -= 1;
					show_info(count_next_grade);
				}
				
			});

			var show_info = function(data){
				$('#grade-info').empty();
				$.each(data, function(i, val){
					var info = '<span class="label label-primary">'+ val.kelas+ ' : '+val.jumlah+' ' +'</span> ';
					$('#grade-info').append(info);
				})
			}

		})
	</script>
@stop