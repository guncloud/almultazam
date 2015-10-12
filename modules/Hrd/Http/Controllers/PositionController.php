<?php namespace Modules\Hrd\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Hrd\Entities\Position;
use Pingpong\Modules\Routing\Controller;

class PositionController extends Controller {
	
	public function index()
	{
        $rec = Position::all();

        $data['positions'] = (!$rec->isEmpty()) ? $rec : false;
		$data['title'] = 'Data Jabatan';

		return view('hrd::partials.position.index', $data);
	}

    public function store(Request $request)
    {
        $create = Position::create($request->except('_token'));

        if($create){
            Session::flash('success', 'Data inserted');
        }else{
            Session::flash('error', 'Error');
        }

        return redirect('/hrd/position');
    }
	
}