<?php namespace Modules\Hrd\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class HrdController extends Controller {
	
	public function index()
	{
		return view('hrd::index');
	}
	
}