<?php namespace Modules\Siswa\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Siswa\Entities\Ekskul;
use Pingpong\Modules\Routing\Controller;

class EkskulController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->middleware('pembina');
    }
	
	public function index()
	{
        $ekskul = new Ekskul;
        $ekskul = $ekskul->getAll();

//        dd($ekskul);

        $data['ekskuls'] = (count($ekskul)) ? $ekskul : false;
		$data['title'] = 'Ekskul';
		return view('siswa::partials.ekskul.index', $data);
	}

    public function store(Request $request)
    {
        $create = Ekskul::create($request->all());
        if($create){
            Session::flash('info', 'Data inserted');
        }else{
            Session::flash('info', 'Error');
        }
        return redirect('/siswa/ekskul');
    }

    public function show($id)
    {
        $rec = Ekskul::find($id);

        return response()->json($rec);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        Ekskul::where('id','=', $id)
            ->update($request->except('_method', '_token'));

        Session::flash('info', 'Data updated');

        return redirect('/siswa/ekskul');
    }

    public function destroy(Request $request, $id)
    {
        $rec = Ekskul::destroy($id);
        if($rec){
            Session::flash('info', 'Data deleted');
            return response()->json('true');
        }else{
            Session::flash('info', 'Error');
            return response()->json('false');
        }
    }
	
}