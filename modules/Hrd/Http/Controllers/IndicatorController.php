<?php namespace Modules\Hrd\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Hrd\Entities\Indicator;
use Modules\Hrd\Entities\Performance;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Support\Facades\Session;

class IndicatorController extends Controller {

	public function index()
	{
        $indicator = Indicator::all();
        $performance = Indicator::has('performances')->get();

        $data['performances'] = (count($performance) > 0) ? $performance : false;
        $data['indicators'] = (!$indicator->isEmpty()) ? $indicator : false;
		$data['title'] = 'Indikator Penilaian';
		return view('hrd::partials.indicator.index', $data);
	}

    public function createIndicator(Request $request)
    {
        if($request->all()){
            $create = Indicator::create($request->all());

            if($create){
                Session::flash('info', 'Data inserted');
                return redirect('hrd/indicator');
            }
        }
    }

    public function postCreatePerformance(Request $request)
    {
        if($request->all()){
            $create = Performance::create($request->all());
        }

        if($create){
            Session::flash('info', 'Data inserted');
            return redirect('hrd/indicator');
        }
    }

    public function show($id)
    {
        $rec = Division::find($id);

        return response()->json($rec);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        Division::where('id','=', $id)
            ->update($request->except('_method', '_token'));

        Session::flash('info', 'Data updated');

        return redirect('/hrd/division');
    }

    public function destroy(Request $request, $id)
    {
        $rec = Indicator::destroy($id);
        if($rec){
            Session::flash('info', 'Data deleted');
            return response()->json('true');
        }else{
            Session::flash('info', 'Error');
            return response()->json('false');
        }
    }
	
}