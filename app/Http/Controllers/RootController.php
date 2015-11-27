<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RootController extends Controller {

	public function __construct()
	{
		$this->middleware('root', ['except' => 'getLogin']);
	}

	public function getIndex()
	{
		$title = 'Admin Dashboard';

		return view('root.dashboard.index', compact('title'));
	}

	public function getLogin()
	{
		$title = 'Login Admin';

		return view('root.auth.login', compact('title'));
	}

}
