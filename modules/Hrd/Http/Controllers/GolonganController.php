<?php namespace Modules\Hrd\Http\Controllers;

use Illuminate\Http\Request;
use Pingpong\Modules\Routing\Controller;
use Modules\Hrd\Entities\Golongan;
use Illuminate\Support\Facades\Session;

class GolonganController extends Controller {
	
	public function index()
	{
        $golongan = Golongan::all();
		$title = 'Golongan';
		return view('hrd::partials.golongan.index', compact('title', 'golongan'));
	}

	public function store(Request $request)
	{
        $create = Golongan::create([
            'golongan' => $request->get('golongan'),
            'slug' => str_slug($request->get('golongan'), '-')
        ]);

        if($create){
            Session::flash('info', 'Data inserted');
            return redirect('hrd/golongan');
        }
	}

    public function show($id)
    {
        $golongan = Golongan::find($id);
        $title = 'Edit Golongan';

        return view('hrd::partials.golongan.show', compact('golongan', 'title'));
    }

    public function update($id, Request $request)
    {
        $data = Golongan::find($id);
        $data->golongan = $request->input('golongan');
        $data->slug = str_slug($request->input('golongan'), '-');
        if($data->save()){
            Session::flash('info', 'Data inserted');
        }else{
            Session::flash('info', 'Error');
        }

        return redirect('/hrd/golongan/');
    }

    public function destroy($id)
    {
        $rec = Golongan::destroy($id);
        if($rec){
            Session::flash('info', 'Data deleted');
        }else{
            Session::flash('info', 'Error');
        }

        return redirect('/hrd/golongan');
    }
	
}