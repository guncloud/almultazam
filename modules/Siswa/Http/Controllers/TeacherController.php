<?php namespace Modules\Siswa\Http\Controllers;

use Illuminate\Http\Request;
use Pingpong\Modules\Routing\Controller;
use Modules\Siswa\Entities\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Stakeholder;

class TeacherController extends Controller {

    public function __construct()
    {
        parent::__construct();
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

    public function getShow($id)
    {
        $position = DB::table('stakeholders')
            ->select('position')
            ->join('position_stakeholder', 'position_stakeholder.stakeholder_id', '=', 'stakeholders.id')
            ->join('positions', 'positions.id', '=', 'position_stakeholder.position_id')
            ->where('stakeholders.id', '=', $id)
            ->get();

        $data['positions'] = (count($position) > 0) ? $position : false;
        $data['stakeholder'] = Stakeholder::find($id);
        $data['title'] = 'Profil';
        return view('siswa::partials.teachers.detail', $data);
    }
	
}