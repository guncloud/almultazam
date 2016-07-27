<?php namespace Modules\Siswa\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Siswa\Entities\Classroom;
use Modules\Siswa\Entities\Student;
use Modules\Siswa\Entities\ClassroomStudent;
use Modules\Siswa\Entities\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradeUpController extends Controller {

	private $new_year = '';
	
	public function index(Request $request, ClassroomStudent $classroom_student)
	{
		$this->classroom_id = ($request->cid) ? $request->cid : '6';
		$this->tahun_ajar = ($request->tahun_ajar) ? 
				$request->tahun_ajar : 
				Config::where('slug', '=', 'tahun-ajar')->first()->value;

		$rec_classroom = Classroom::find($this->classroom_id);

		$tingkat = explode(' ', $rec_classroom->classroom);

		switch ($tingkat[0]) {
			case 'VII':
				$lanjutan = 'VIII';
				break;
			case 'VIII':
				$lanjutan = 'IX';
				break;
			case 'IX':
				$lanjutan = false;
				break;
			default:
				$lanjutan = 'VII';
				break;
		}

		$next_tahun_ajar = explode('/', $this->tahun_ajar);
		$new_tahun_ajar = ($next_tahun_ajar[0]+1)."/".($next_tahun_ajar[1]+1);

		$siswa = $classroom_student->getClassroomStudent($this->classroom_id, $this->tahun_ajar);
		if($siswa){
			foreach ($siswa as $k => $v) {
				$students_id[] = $v->student_id;
			}

			$rec_classroom_upgrade = $classroom_student->getClassroomStudentUpgrade($students_id, $this->tahun_ajar);
			if($rec_classroom_upgrade){
				foreach ($rec_classroom_upgrade as $k => $v) {
					$classroom_upgrade[$v->student_id] = $v->classroom_id;
				}
			}else{
				$classroom_upgrade = false;			
			}	
		}

		/*Var View*/
		$title = 'Kenaikan Kelas';
		$sub_title = 'Data Siswa';
		$tahun_ajar = $this->tahun_ajar;
		$classroom = Classroom::orderBy('classroom')->get();
		$classroom_picked = $this->classroom_id;
		$year_picked = $this->tahun_ajar;
		$classroom_next = Classroom::where('classroom', 'like', $lanjutan.'%')->get();

		// dd($classroom_upgrade);

		return view('siswa::partials.grade_up.index', compact(
				'title', 'sub_title','classroom', 'siswa', 'lanjutan', 'classroom_next',
				'tahun_ajar', 'new_tahun_ajar', 'classroom_upgrade',
				'year_picked', 'classroom_picked'
			)
		);
	}

	public function store(Request $request)
	{
		// dd($request->all());

		$this->up_grade = $request->kelas_lanjutan;
		$this->new_year = $request->new_tahun_ajar;

		foreach ($this->up_grade as $k => $v) {
			if($v != "null"){
				$classroom = $this->check_classroom($k, $v);

				if($classroom){
					/*Update*/
					$student = Student::find($k);
					$student->classrooms()->detach($classroom->classrooms[0]->id);
					$student->classrooms()->attach([$v => ['year' => $this->new_year]]);
				}else{	
					/*Insert*/
					$student = Student::find($k);
					// dd($student);
					$student->classrooms()->attach([$v => ['year' => $this->new_year]]);
				}
			}
		}

		return redirect('/siswa/naik-kelas');
	}

	private function check_classroom($siswa_id, $classroom_id)
	{
		// $student = Student::find($siswa_id)->classrooms;
		$student = Student::find($siswa_id)->with(array('classrooms' => function($q) use($classroom_id){
			// $q->wherePivot('classroom_id', $classroom_id);
			$q->wherePivot('year', $this->new_year);
		}))->find($siswa_id);

		return (count($student->classrooms) > 0) ? $student : false;
	}

	public function countNextGrade(Request $request)
	{
		$year = ($request->year) ? $request->year : Config::where('slug', '=', 'tahun-ajar')->first()->value;
		$data = DB::table('classroom_student')
					->where('year', $year)
					->join('classrooms', 'classrooms.id', '=', 'classroom_student.classroom_id')
				   	->selectRaw('count(classroom_id) as val, classroom_id as id, classroom')
				   	->groupBy('classroom_id')
				   	->get();

	   	$tingkat = explode(' ', $data[0]->classroom);
	   	$lanjutan = $tingkat[0];

	   	$rec_classroom_next = Classroom::where('classroom', 'like', $lanjutan.'%')->get();
	   	foreach ($rec_classroom_next as $k => $v) {
			$classroom_next[$v->id] = $v->classroom;
	   	}

	   	foreach ($data as $key => $value) {
	   		$info[$value->id] = $value;
	   	}

	   	foreach ($classroom_next as $key => $value) {
	   		if(isset($info[$key])){
   				$rec[$key] = array(
   						'kelas' => $value,
   						'jumlah' => $info[$key]->val
   					);
	   		}else{
	   			$rec[$key] = array(
	   					'kelas' => $classroom_next[$key],
	   					'jumlah' => 0
	   				);
	   		}
	   	}
	
		return response()->json($rec);
	}

}