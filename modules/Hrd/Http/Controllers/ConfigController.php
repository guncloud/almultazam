<?php namespace Modules\Hrd\Http\Controllers;

use Illuminate\Http\Request;
use Pingpong\Modules\Routing\Controller;
use Modules\Siswa\Entities\Config;
use Illuminate\Support\Facades\Session;

class ConfigController extends Controller {
	
	public function index()
	{
        $kepala_divisi = Config::where('slug', 'kepala-divisi')->first();

		$title = 'Konfigurasi';
		return view('hrd::partials.config.index', compact('title', 'kepala_divisi'));
	}

    public function store(Request $request)
    {
        $value = $request->get('kepala_divisi');

        //Check
        $config = Config::where('slug', 'kepala-divisi')->first();

        if($config){

            if($config->update(array('value' => $value))){
                Session::flash('info', 'Data updated');
                return redirect('/hrd/config');
            }
        }else{
            $new = Config::create(array(
                'config' => 'Kepala Divisi',
                'slug' => str_slug('kepala divisi', '-'),
                'value' => $value
            ));

            if($new){
                Session::flash('info', 'Data inserted');
                return redirect('/hrd/config');
            }
        }

    }
	
}