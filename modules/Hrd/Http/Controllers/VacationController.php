<?php namespace Modules\Hrd\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Hrd\Entities\Vacation;
use Pingpong\Modules\Routing\Controller;

class VacationController extends Controller {
	
	public function index(Request $request)
	{
        $vacations = false;

        if($request->all()){
            $vact = new Vacation;
            $vacation = $vact->getVacation($request->all());
            $vacations = (count($vacation) > 0) ? $vacation : false;
        }else{
            $vact = new Vacation;
            $vacation = $vact->getAllVacation();
            $vacations = (count($vacation) > 0) ? $vacation : false;
        }

        $data['vacations'] = $vacations;
		$data['title'] = 'Data Cuti Pegawai';
		return view('hrd::partials.vacation.index', $data);
	}

    public function store(Request $request)
    {
        $create = Vacation::create($request->all());
        if($create){
            Session::flash('info', 'Data inserted');
        }else{
            Session::flash('info', 'Error');
        }

        return redirect('/hrd/vacation');
    }

    public function destroy(Request $request, $id)
    {
        $rec = Vacation::destroy($id);
        if($rec){
            Session::flash('info', 'Data deleted');
            return response()->json('true');
        }else{
            Session::flash('info', 'Error');
            return response()->json('false');
        }
    }
	
}