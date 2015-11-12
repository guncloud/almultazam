<?php namespace Modules\Hrd\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use App\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DivisionController extends Controller {
	
	public function index()
	{
		$data['title'] = 'Divisi/Bagian';
        $divisions = Division::all();

        $data['divisions'] = (!$divisions->isEmpty()) ? $divisions : false;
		return view('hrd::partials.division.index', $data);
	}

    public function store(Request $request)
    {
        if($request->get('division')){
            $create = Division::create([
                'division' => $request->get('division'),
                'slug' => str_slug($request->get('division'), '-')
            ]);

            if($create){
                Session::flash('info', 'Data inserted');
                return redirect('hrd/division');
            }
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

        $rec = Division::destroy($id);
        if($rec){
            Session::flash('info', 'Data deleted');
            return response()->json('true');
        }else{
            Session::flash('info', 'Error');
            return response()->json('false');
        }
    }
	
}