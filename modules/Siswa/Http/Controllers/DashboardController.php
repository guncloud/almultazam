<?php namespace Modules\Siswa\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class DashboardController extends Controller {
	
	public function index()
	{
		$data['title'] = 'Kesiswaaan';
		return view('siswa::index', $data);
	}
	
}