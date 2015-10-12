<?php namespace Modules\Siswa\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Siswa\Entities\Attendance;
use Modules\Siswa\Entities\Classroom;
use Modules\Siswa\Entities\Student;
use Pingpong\Modules\Routing\Controller;
use Modules\Siswa\Entities\ClassroomStudent;
use Illuminate\Support\Facades\Session;

class AttendanceController extends Controller {

    public function __construct()
    {
        $this->middleware('admin');
    }
	
	public function index(Request $request)
	{
        $date = $request->get('date', null);

        $classroom = new Classroom;
        $classrooms = $classroom->getClassrooms();

        //dd($classrooms);

        $student = new ClassroomStudent;
		$classroomId = $request->get('kelas', null);
		$students = $student->getClassroomStudent($classroomId);

        //dd($students);
        $students_id = array_pluck($students, 'student_id');

        if($date != null){
            $attendace = Attendance::where('date','=', $date)
                ->whereIn('student_id', $students_id)
                ->get();

            if(count($attendace) > 0){
                foreach($attendace as $v){
                    $attendaces[$v->student_id] = $v->status;
                }
            }else{
                $attendaces = false;
            }

            $data['attendances'] = $attendaces;
        }else{
            $students = false;
        }

        //dd($students);

        $data['classrooms'] = (count($classrooms) > 0) ? $classrooms : false;
        $data['students'] = (count($students) > 0) ? $students : false;
		$data['title'] = 'Kehadiran';
		return view('siswa::partials.attendance.index', $data);
	}

    public function store(Request $request)
    {
        $absen = $request->ket;
        $error = array();

        foreach($absen as $id => $v) {

            $cek = Attendance::where('student_id', $id)
                ->where('date', '=', $request->date)
                ->first();

            if($cek){
                $update = Attendance::find($cek->id);
                $update->status = $v;
                if(!$update->save()){
                    $error[] = $id;
                }
            }else{
                $create = Attendance::create([
                    'student_id' => $id,
                    'status' => $v,
                    'date' => $request->date
                ]);

                if ($create) {

                } else {
                    $error[] = $id;
                }
            }
        }

        if(count($error) == 0){
            Session::flash('info', 'Data absen telah disimpan');
        }

        return redirect('/siswa/attendance?date='.$request->get('date').'&kelas='.$request->get('classroom'));
    }
	
}