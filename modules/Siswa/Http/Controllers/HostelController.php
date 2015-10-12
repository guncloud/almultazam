<?php namespace Modules\Siswa\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Siswa\Entities\Hostel;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Support\Facades\Session;

class HostelController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->middleware('admin');
    }
	
	public function index()
	{
		$hostel = new Hostel;
        $hostel = $hostel->getAll();

        ///dd($hostel);

        $data['title'] = 'Asrama';
        $data['hostels'] = (count($hostel) > 0) ? $hostel : false;
		return view('siswa::partials.hostel.index',$data);
	}

    public function store(Request $request)
    {

        $create = Hostel::create($request->all());
        if($create){
            Session::flash('info', 'Data inserted');
        }else{
            Session::flash('info', 'Error');
        };

        return redirect('/siswa/hostel');
    }

    public function show($id)
    {
        $hostel = new Hostel;
        $hostel = $hostel->getOne($id);

        return response()->json($hostel);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        Hostel::where('id','=', $id)
            ->update($request->except('_method', '_token'));

        Session::flash('info', 'Data updated');

        return redirect('/siswa/hostel');
    }

    public function destroy(Request $request, $id)
    {
        $rec = Hostel::destroy($id);
        if($rec){
            Session::flash('info', 'Data deleted');
            return response()->json('true');
        }else{
            Session::flash('info', 'Error');
            return response()->json('false');
        }
    }
	
}