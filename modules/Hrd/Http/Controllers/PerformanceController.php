<?php namespace Modules\Hrd\Http\Controllers;

use Modules\Hrd\Entities\Performance;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PerformanceController extends Controller {
	
	public function index()
	{
		return view('hrd::index');
	}

	public function show($id)
	{
		$rec = Performance::find($id);

		return response()->json($rec);
	}

	public function update(Request $request, $id)
	{
		//dd($request->all());
		Performance::where('id','=', $id)
			->update($request->except('_method', '_token'));

		Session::flash('info', 'Data updated');

		return redirect('/hrd/division');
	}

	public function destroy(Request $request, $id)
	{
		$rec = Performance::destroy($id);
		if($rec){
			Session::flash('info', 'Data deleted');
			return response()->json('true');
		}else{
			Session::flash('info', 'Error');
			return response()->json('false');
		}
	}
}