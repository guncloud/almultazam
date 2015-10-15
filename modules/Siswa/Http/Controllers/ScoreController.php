<?php namespace Modules\Siswa\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\Siswa\Entities\Classroom;
use Modules\Siswa\Entities\Contract;
use Modules\Siswa\Entities\Score;
use Pingpong\Modules\Routing\Controller;
use Modules\Siswa\Entities\ClassroomStudent;

class ScoreController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->middleware('admin');
    }
	
	public function index(Request $request)
	{
        $classroom = new Classroom;
        $classroom = $classroom->getClassrooms();
        $contract = new Contract;
        $contracts = $contract->getContract();
        $selectedContract = $contract->getContractById($request->get('contract'));

        $student = new ClassroomStudent;
        $classroomId = $request->get('kelas', null);
        $students = $student->getClassroomStudent($classroomId);

        $students_id = array_pluck($students, 'student_id');

        $score = DB::table('scores')
            ->join('contracts', 'contracts.id', '=', 'scores.contract_id')
            ->where('scores.contract_id', '=', $request->get('contract'))
            ->where('contracts.semester', '=', $request->get('semester'))
            ->whereIn('scores.student_id', $students_id)
            ->get();

//        dd($contracts);

        if(count($score) > 0){
            foreach($score as $scr){
                $scores[$scr->student_id] = $scr;
            }
        }else{
            $scores = false;
        }

        //dd($scores);

        if(!$request->all()){
            $students = false;
        }

        $data['scores'] = $scores;
        $data['selectedContract'] = (count($selectedContract) > 0) ? $selectedContract : false;
        $data['contracts'] = (count($contracts)) ? $contracts : false;
        $data['classrooms'] = (count($classroom) > 0) ? $classroom : false;
        $data['students'] = (count($students) > 0) ? $students : false;
		$data['title'] = 'Penilaian';
		return view('siswa::partials.score.index', $data);
	}

    public function store(Request $request)
    {
        $uh1 = $request->get('uh1');
        $uh2 = $request->get('uh2');
        $uh3 = $request->get('uh3');
        $uh4 = $request->get('uh4');
        $uts = $request->get('uts');
        $uas = $request->get('uas');

        foreach ($uh1 as $sid => $score ) {

            //cek if students has already a score
            $cek = Score::where('student_id', '=', $sid)
                ->where('contract_id', '=', $request->get('contract'))
                ->first();

            if(count($cek) > 0){
                //update
                $update = Score::find($cek->id);
                $update->uh_1 = $score;
                $update->uh_2 = $uh2[$sid];
                $update->uh_3 = $uh3[$sid];
                $update->uh_4 = $uh4[$sid];
                $update->uts = $uts[$sid];
                $update->uas = $uas[$sid];
                $update->save();

            }else{
                //create
                Score::create([
                    'student_id' => $sid,
                    'contract_id' => $request->get('contract'),
                    'uh_1' => $score,
                    'uh_2' => $uh2[$sid],
                    'uh_3' => $uh3[$sid],
                    'uh_4' => $uh4[$sid],
                    'uts' => $uts[$sid],
                    'uas' => $uas[$sid],
                ]);
            }

        }

        Session::flash('info', 'Data changed');
        return redirect('/siswa/score?contract='.$request->get('contract').'&kelas='.$request->get('kelas').'&semester='.$request->get('semester'));

    }
}