<?php namespace Modules\Siswa\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Siswa\Entities\Student;
use Pingpong\Modules\Routing\Controller;
use Modules\Siswa\Entities\Achievement;

class AchievementController extends Controller {
	
	public function index()
	{
        $achievement = Student::has('achievements')->get();

		$data['title'] = 'Prestasi siswa';
        $data['achievements'] = (!$achievement->isEmpty()) ? $achievement : false;
		return view('siswa::partials.achievement.index', $data);
	}

    public function store(Request $request)
    {
        $create = Achievement::create($request->all());
        return redirect('/siswa/achievement');
    }
}