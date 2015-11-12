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

    public function show($id)
    {
        $position = Position::find($id);
        $title = 'Edit Jabatan';

        return view('hrd::partials.position.show', compact('position', 'title'));
    }

    public function update($id, Request $request)
    {
        $data = Position::find($id);
        $data->position = $request->input('position');
        $data->slug = str_slug($request->input('position'), '-');
        if($data->save()){
            Session::flash('info', 'Data inserted');
        }else{
            Session::flash('info', 'Error');
        }

        return redirect('/hrd/position/');
    }

    public function destroy($id)
    {
        $rec = Position::destroy($id);
        if($rec){
            Session::flash('info', 'Data deleted');
        }else{
            Session::flash('info', 'Error');
        }

        return redirect('/hrd/position');
    }
	
}