<?php namespace Modules\Siswa\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Siswa\Entities\LanguageStudent;
use Pingpong\Modules\Routing\Controller;
use Modules\Siswa\Entities\Config;

class LanguageStudentController extends Controller {

    public function __construct()
    {
        $this->middleware('pembina');
    }
	
	public function store(Request $request)
	{
        $scores = $request->get('score');
        $attendance = $request->get('attendance');

        $year = Config::where('slug', '=', 'tahun-ajar')->first()->value;

        foreach ($scores as $sid => $score) {
            $cek = LanguageStudent::where('student_id', '=', $sid)
                ->where('date', '=', $request->get('date'))
                ->where('semester', '=', $request->get('semester'))
                ->where('year', '=', $year)
                ->where('language_id', '=', $request->get('language'))
                ->first();

            if(count($cek) > 0){
                $update = LanguageStudent::find($cek->id);
                $update->attendance = $attendance[$sid];
                $update->score = $score;
                $update->save();
            }else{
                $create = LanguageStudent::create([
                    'student_id' => $sid,
                    'language_id' => $request->get('language'),
                    'score' => $score,
                    'attendance' => $attendance[$sid],
                    'date' => $request->get('date'),
                    'year' => $year,
                    'semester' => $request->get('semester')
                ]);
            }
        }

        return redirect('/siswa/language/score?bahasa='.$request->get('bahasa').'&date='.$request->get('date').'&kelas='.$request->get('kelas').'&semester='.$request->get('semester'));
    }
	
}