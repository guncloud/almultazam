<?php namespace Modules\Hrd\Http\Controllers;

use App\Stakeholder;
use Illuminate\Http\Request;
use Modules\Hrd\Entities\Indicator;
use Modules\Hrd\Entities\Report;
use Modules\Siswa\Entities\Config;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller {
	
	public function index(Request $request)
	{
        if($request->all()){
            $year = Config::where('slug', '=', 'tahun-ajar')->first()->value;
            $stakeholder = Stakeholder::find($request->get('stakeholder_id'));

            $report = Indicator::has('performances')->get();

            $reportScore = Report::where('stakeholder_id', '=', $request->get('stakeholder_id'))
                ->where('semester', '=', $request->get('semester'))
                ->where('year', '=', $year)
                ->get();

            //dd($reportScore->toArray());

            if(count($reportScore) > 0){
                foreach ($reportScore as $rpt) {
                    $reportScores[$rpt->performance_id] = $rpt;
                }
            }else{
                $reportScores = false;
            }

        }else{
            $stakeholder = false;
            $report = false;
            $reportScores = false;
        }

        //dd($reportScores);

        $data['reportScores'] = $reportScores;
        $data['report'] = $report;
        $data['stakeholder'] = $stakeholder;
		$data['title'] = 'Rapor Pegawai';
		return view('hrd::partials.report.index', $data);
	}

    public function store(Request $request)
    {
        $year = Config::where('slug', '=', 'tahun-ajar')->first()->value;
        $score = $request->get('score');

        foreach ($score as $perf_id => $scr) {
            $cek = Report::where('stakeholder_id', '=', $request->get('stakeholder'))
                ->where('semester', '=', $request->get('semester'))
                ->where('performance_id', '=', $perf_id)
                ->where('year', '=', $year)
                ->first();

            if(count($cek) > 0){
                $update = Report::find($cek->id);
                $update->score = $scr;
                $update->save();

                Session::flash('info', 'Data inserted');
            }else{
                $create = Report::create([
                    'stakeholder_id' => $request->get('stakeholder'),
                    'performance_id' => $perf_id,
                    'year' => $year,
                    'semester' => $request->get('semester'),
                    'score' => $scr
                ]);

                Session::flash('info', 'Data inserted');
            }

        }

        return redirect('hrd/report?stakeholder_id='.$request->get('stakeholder').'&semester='.$request->get('semester'));

    }
}