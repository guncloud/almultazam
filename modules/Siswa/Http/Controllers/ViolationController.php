<?php namespace Modules\Siswa\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Siswa\Entities\Student;
use Modules\Siswa\Entities\Violation;
use Pingpong\Modules\Routing\Controller;

class ViolationController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->middleware('pembina');
    }
	
	public function index()
	{
        $violation = Student::has('violations')->get();

        $data['violations'] = (!$violation->isEmpty()) ? $violation : false;
		$data['title'] = 'Pelanggaran Siswa';
		return view('siswa::partials.violation.index', $data);
	}

    public function store(Request $request)
    {
        $create = Violation::create($request->all());
        if($create){
            Session::flash('info', 'Date inserted');
        }else{
            Session::flash('info', 'Error');
        }
        return redirect('/siswa/violation');
    }

    public function edit(Request $request, $id)
    {
        $data['viol'] = Violation::find($id);
        $data['title'] = 'Edit Data Pelanggaran';

        return view('siswa::partials.violation.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $update = Violation::find($id);
        $update->violation = $request->get('violation');
        $update->date = $request->get('date');
        $update->point = $request->get('point');
        $update->save();

        return redirect('/siswa/violation');
    }

    public function destroy($id)
    {
        if(Violation::destroy($id)){
            return redirect('/siswa/violation');
        }
    }
	
}