<?php namespace Modules\Siswa\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Siswa\Entities\Classroom;
use Modules\Siswa\Entities\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClassroomController extends Controller {

    public function __construct()
    {
        $this->middleware('admin');
    }
	
	public function index()
	{
        $obj = new Classroom;
        $classrooms = $obj->getClassrooms();

        //dd($classrooms);

        $teacher = new Teacher;
        $teachers = $teacher->getTeachers();

        $data['teachers'] = (count($teachers)>0) ? $teachers : false;

        $data['title'] = 'Kelas';
        $data['classrooms'] = (count($classrooms) > 0) ? $classrooms : false;

		return view('siswa::partials.classrooms.index', $data);
	}

    public function destroy(Request $request, $id)
    {
        $rec = Classroom::destroy($id);
        if($rec){
            Session::flash('info', 'Data delete');
            return response()->json('true');
        }else{
            Session::flash('info', 'Error');
            return response()->json('false');
        }
    }

    public function show(Request $request, $id)
    {
        $rec = Classroom::find($id);

        return response()->json($rec);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        Classroom::where('id','=', $id)
            ->update($request->except('_method', '_token'));

        Session::flash('info', 'Data updated');

        return redirect('/siswa/classroom');
    }

    public function store(Request $request)
    {
        if($request->all())
        {
            $create = Classroom::create($request->all());

            if($create){
                Session::flash('info', 'Data inserted');
            }else{
                Session::flash('info', 'Error');
            }
            return redirect('/siswa/classroom');
        }
    }
	
}