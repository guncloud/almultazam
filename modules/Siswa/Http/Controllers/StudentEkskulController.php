<?php namespace Modules\Siswa\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Siswa\Entities\Classroom;
use Modules\Siswa\Entities\Ekskul;
use Modules\Siswa\Entities\StudentEkskul;
use Pingpong\Modules\Routing\Controller;
use Modules\Siswa\Entities\ClassroomStudent;
use Modules\Siswa\Entities\Config;

class StudentEkskulController extends Controller {

    public function __construct()
    {
        $this->middleware('pembina');
    }
	
	public function index(Request $request)
	{
        $ekskul = new Ekskul;
        $ekskuls = $ekskul->getAll();
        $classroom = Classroom::all();

        if($request->all()){
            $year = Config::where('slug', '=', 'tahun-ajar')->first()->value;
            $student = new ClassroomStudent;
            $students = $student->getClassroomStudent($request->get('kelas'));

            $student_id = array_pluck($students, 'student_id');

            $ekskul = StudentEkskul::whereIn('student_id', $student_id)
                ->where('date', '=', $request->get('date'))
                ->where('semester', '=', $request->get('semester'))
                ->where('year', '=', $year)
                ->where('ekskul_id', '=', $request->get('ekskul'))
                ->get();

            if(count($ekskul) > 0){
                foreach ($ekskul as $l) {
                    $ekskulStudent[$l->student_id] = $l;
                }
            }else{
                $ekskulStudent = false;
            }

        }else{
            $students = false;
            $ekskulStudent = false;
        }

        $data['students'] = $students;
        $data['ekskulStudent'] = $ekskulStudent;
        $data['classrooms'] = (!$classroom->isEmpty()) ? $classroom : false;
        $data['ekskuls'] = (count($ekskuls)) ? $ekskuls : false;
		$data['title'] = "Nilai Ekskul";
		return view('siswa::partials.student_ekskul.index', $data);
	}

    public function store(Request $request)
    {
        $scores = $request->get('score');
        $attendance = $request->get('attendance');

        $year = Config::where('slug', '=', 'tahun-ajar')->first()->value;

        foreach ($scores as $sid => $score) {
            $cek = StudentEkskul::where('student_id', '=', $sid)
                ->where('date', '=', $request->get('date'))
                ->where('semester', '=', $request->get('semester'))
                ->where('year', '=', $year)
                ->where('ekskul_id', '=', $request->get('ekskul'))
                ->first();

            if(count($cek) > 0){
                $update = StudentEkskul::find($cek->id);
                $update->attendance = $attendance[$sid];
                $update->score = $score;
                $update->save();
            }else{
                $create = StudentEkskul::create([
                    'student_id' => $sid,
                    'ekskul_id' => $request->get('ekskul'),
                    'score' => $score,
                    'attendance' => $attendance[$sid],
                    'date' => $request->get('date'),
                    'year' => $year,
                    'semester' => $request->get('semester')
                ]);
            }
        }

        return redirect('/siswa/student-ekskul?ekskul='.$request->get('bahasa').'&date='.$request->get('date').'&kelas='.$request->get('kelas').'&semester='.$request->get('semester'));
    }

	
}