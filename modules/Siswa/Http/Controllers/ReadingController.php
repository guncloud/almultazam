<?php namespace Modules\Siswa\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Siswa\Entities\Classroom;
use Modules\Siswa\Entities\ClassroomStudent;
use Modules\Siswa\Entities\Config;
use Modules\Siswa\Entities\Reading;
use Modules\Siswa\Entities\Student;
use Pingpong\Modules\Routing\Controller;

class ReadingController  extends Controller {

    public function __construct()
    {
        $this->middleware('alquran');
    }
	
	public function index(Request $request)
	{
        if($request->all()){
            $student = new ClassroomStudent;
            $students = $student->getClassroomStudent($request->get('kelas'));

            $student_id = array_pluck($students, 'student_id');

            $year = Config::where('slug', '=', 'tahun-ajar')->first()->value;
            $reading = Reading::where('year', '=', $year)
                ->whereIn('student_id', $student_id)
                ->where('date', '=', $request->get('date'))
                ->get();

            //dd($reading->toArray());

            if(count($reading) > 0){
                foreach($reading as $read){
                    $readings[$read->student_id] = array(
                        'attendance' => $read->attendance,
                        'score' => $read->score
                    );
                }
            }else{
                $readings = false;
            }

        }else{
            $students = false;
            $readings = false;
        }

        $classroom = Classroom::all();

        $data['readings'] = $readings;
        $data['students'] = $students;
        $data['classrooms'] = (!$classroom->isEmpty()) ? $classroom : false;
		$data['title'] = 'Bacaan';
		return view('siswa::partials.reading.index', $data);
	}

    public function store(Request $request)
    {
        $score = $request->get('score');
        $attendance = $request->get('attendance');
        $year = Config::where('slug', '=', 'tahun-ajar')->first()->value;

        foreach ($score as $sid => $val) {
            //cek already
            $cek = Reading::where('student_id', '=', $sid)
                        ->where('date', '=', $request->get('date'))
                        ->where('semester', '=', $request->get('semester'))
                        ->where('year', '=', $year)
                        ->first();

            if(count($cek) > 0){
                //update
                $update = Reading::find($cek->id);
                $update->attendance = $attendance[$sid];
                $update->score = $val;
                $update->save();
            }else{
                //insert
                $create = Reading::create([
                    'student_id' => $sid,
                    'attendance' => $attendance[$sid],
                    'score' => $val,
                    'year' => $year,
                    'semester' => $request->get('semester'),
                    'date' => $request->get('date')
                ]);
            }
        }

        Session::flash('info', 'Data changed');
        return redirect('/siswa/reading?date='.$request->get('date').'&kelas='.$request->get('classroom').'&semester='.$request->get('semester'));

    }
	
}