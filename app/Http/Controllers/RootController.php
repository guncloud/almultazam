<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class RootController extends Controller {

	public function __construct()
	{
		$this->middleware('root', ['except' => 'getLogin']);
	}

	public function getIndex()
	{
		echo "index";
	}

	public function getLogin()
	{
		echo "login";
	}

}
