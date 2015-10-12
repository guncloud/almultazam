<?php namespace Modules\Siswa\Http\Controllers;

use Illuminate\Http\Request;
use Pingpong\Modules\Routing\Controller;
use Modules\Siswa\Entities\Teacher;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller {

    public function __construct()
    {
        $this->middleware('admin', ['except' => ['search']]);
    }
	
	public function getIndex()
	{
        $teacher = new Teacher;
        $teachers = $teacher->getTeachers();

        $data['title'] = 'Guru';
        $data['teachers'] = (count($teachers)>0) ? $teachers : false;
		return view('siswa::partials.teachers.index', $data);
	}

	public function search(Request $request)
	{
		$teacher = new Teacher;
        $data = $teacher->search($request->get('query'));

        foreach($data as $guru){
            $gurus[] = [
                'value' => $guru->nama,
                'data' => $guru->id
            ];
        };

        $suggest['query'] = 'Unit';
        $suggest['suggestions'] = $gurus;

        return json_encode($suggest);

	}
	
}