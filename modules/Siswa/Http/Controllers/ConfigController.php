<?php namespace Modules\Siswa\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Siswa\Entities\Config;
use Pingpong\Modules\Routing\Controller;
use App\User;
use Pingpong\Trusty\Role;

class ConfigController extends Controller {

    public function __construct()
    {
        $this->middleware('admin');
    }
	
	public function index()
	{
        $config = Config::all();
        $user = User::has('roles')->get();
        $role = Role::all();

        $data['users'] = (!$user->isEmpty()) ? $user : false;
        $data['roles'] = (!$role->isEmpty()) ? $role : false;
        $data['configs'] = (!$config->isEmpty()) ? $config : false;
		$data['title'] = 'Config';
		return view('siswa::partials.config.index', $data);
	}

    public function store(Request $request)
    {
        $tahun_ajar = Config::where('slug', '=', 'tahun-ajar')
                ->update(['value'=> $request->get('tahun_ajar')]);

        return redirect('/siswa/config');
    }
	
}