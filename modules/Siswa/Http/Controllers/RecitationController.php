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
        parent::__construct();
        $this->middleware('alquran');
    }
	
	public function index(Request $request)
	{
		$classroom = Classroom::all();

        $recitations = false;

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


        $data['recitations'] = ($recitations) ? $recitations : false;
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

    public function edit(Request $request, $id)
    {
        $recitation = Recitation::find($id);

        $data['rec'] = $recitation;
        return view('siswa::partials.recitation.edit', $data);
    }

    public function update(Request $request, $id)
    {
        if($request->all()){
            $update = Recitation::find($id);
            $update->score = $request->get('score');
            if($request->get('all')){
                $update->juz = $request->get('juz');
                $update->surah = $request->get('surah');
                $update->from = $request->get('from');
                $update->to = $request->get('to');
            }
            $update->save();

            $year = Config::where('slug', '=', 'tahun-ajar')->first()->value;

            $kelas = ClassroomStudent::where('student_id', '=', $update->student_id)
                ->where('year', '=', $year)
                ->first();

            return redirect('/siswa/recitation?kelas='.$kelas->classroom_id.
            '&date='. $update->date.
            '&semester='. $update->semester);
        }
    }
}