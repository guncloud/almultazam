<?php namespace Modules\Siswa\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Siswa\Entities\Classroom;
use Modules\Siswa\Entities\Contract;
use Modules\Siswa\Entities\Subject;
use Modules\Siswa\Entities\Teacher;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Support\Facades\Session;

class SubjectController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->middleware('admin');
    }
	
	public function index()
	{
        $subject = Subject::all();
        $teacher = new Teacher;
        $teachers = $teacher->getTeachers();
        $classrooms = Classroom::all();
        $contract = new Contract;
        $contracts = $contract->getContract();

        //dd($contracts);

        $data['contracts'] = (count($contracts) > 0) ? $contracts : false;
        $data['classrooms'] = (!$classrooms->isEmpty()) ? $classrooms : false;
        $data['teachers'] = (count($teachers) > 0) ? $teachers : false;
        $data['subjects'] = (!$subject->isEmpty()) ? $subject : false;
		$data['title'] = 'Mata Pelajaran';
		return view('siswa::partials.subjects.index', $data);
	}

    public function store(Request $request)
    {
        if($request->all()){
            $create = Subject::create($request->all());
            if($create){
                return redirect('/siswa/subject');
            }else{
                return redirect('/siswa/subject');
            }
        }
    }

    public function show($id)
    {
        $rec = Subject::find($id);

        return response()->json($rec);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        Subject::where('id','=', $id)
            ->update($request->except('_method', '_token'));

        Session::flash('info', 'Data updated');

        return redirect('/siswa/subject');
    }

    public function destroy(Request $request, $id)
    {
        $rec = Subject::destroy($id);
        if($rec){
            Session::flash('info', 'Data deleted');
            return response()->json('true');
        }else{
            Session::flash('info', 'Error');
            return response()->json('false');
        }
    }
	
}