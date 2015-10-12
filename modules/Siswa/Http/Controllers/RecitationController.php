<?php namespace Modules\Siswa\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Siswa\Entities\Recitation;
use Pingpong\Modules\Routing\Controller;
use Modules\Siswa\Entities\Classroom;
use Modules\Siswa\Entities\ClassroomStudent;
use Illuminate\Support\Facades\Session;
use Modules\Siswa\Entities\Config;

class RecitationController extends Controller {

    public function __construct()
    {
        $this->middleware('alquran');
    }
	
	public function index(Request $request)
	{
		$classroom = Classroom::all();

        if($request->all()){
            $year = Config::where('slug', '=', 'tahun-ajar')->first()->value;

            $student = new ClassroomStudent;
            $students = $student->getClassroomStudent($request->get('kelas'));

            $student_id = array_pluck($students, 'student_id');

            $recitation = Recitation::where('year', '=', $year)
                ->where('date', '=', $request->get('date'))
                ->where('semester', '=', $request->get('semester'))
                ->whereIn('student_id', $student_id)
                ->get();

            if(count($recitation->toArray()) > 0) {
                foreach ($recitation as $rc) {
                    $recitations[$rc->student_id][] = $rc;
                }
            }

        }else{
            $students = false;
            $recitations = false;
        }

        $data['recitations'] = $recitations;
        $data['students'] = $students;
		$data['classrooms'] = (!$classroom->isEmpty()) ? $classroom : false;
		$data['title'] = 'Hafalan';
		return view('siswa::partials.recitation.index', $data);
	}

    public function store(Request $request)
    {
        //dd($request->all());
        if($request->all()){
            $year = Config::where('slug', '=', 'tahun-ajar')->first()->value;

            Recitation::create([
                'student_id' => $request->get('student_id'),
                'juz' => $request->get('juz'),
                'surah' => $request->get('surah'),
                'from' => $request->get('from'),
                'to' => $request->get('to'),
                'date' => $request->get('date'),
                'semester' => $request->get('semester'),
                'year' => $year
            ]);

            Session::flash('info', 'Data telah disimpan');

            return redirect('/siswa/recitation?kelas='.$request->get('kelas').'&date='.$request->get('date').'&semester='.$request->get('semester'));
        }
    }

    public function update(Request $request, $id)
    {
        if($request->all()){
            $update = Recitation::find($id);
            $update->score = $request->get('score');
            $update->save();

            return redirect('/siswa/recitation?kelas='.$request->get('kelas').'&date='.$request->get('date').'&semester='.$request->get('semester'));
        }
    }
}