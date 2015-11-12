<?php namespace Modules\Hrd\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Modules\Hrd\Entities\Golongan;
use Modules\Hrd\Entities\Position;
use Modules\Hrd\Entities\PositionStakeholder;
use Pingpong\Modules\Routing\Controller;
use App\Division;
use Illuminate\Http\Request;
use App\Stakeholder;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class StakeholderController extends Controller {

    public function index(Request $request)
    {
        $data['title'] = 'Pegawai';

        if($request->get('division')){
            $stakeholders = Stakeholder::where('division_id','=',$request->get('division'))->get();
        }else{
            $stakeholders = Stakeholder::all();
        }

        $divisions = Division::all();
        $positions = Position::all();
        $golongans = Golongan::all();

        $data['positions'] = (!$positions->isEmpty()) ? $positions : false;
        $data['golongans'] = (!$golongans->isEmpty()) ? $golongans : false;
        $data['stakeholders'] = (count($stakeholders) > 0) ? $stakeholders : false;
        $data['divisions'] = (!$divisions->isEmpty()) ? $divisions : false;

//        dd($stakeholders->toArray());

        return view('hrd::partials.stakeholder.index', $data);
    }

    public function create()
    {
        $data['title'] = 'Pegawai';
        $data['divisions'] = Division::all();
        $positions = Position::all();
        $golongans = Golongan::all();

        $data['positions'] = (!$positions->isEmpty()) ? $positions : false;
        $data['golongans'] = (!$golongans->isEmpty()) ? $golongans : false;
        return view('hrd::partials.stakeholder.create', $data);
    }

    public function edit($id)
    {
        $data['stakeholder'] = Stakeholder::find($id);
        $data['divisions'] = Division::all();
        $data['title'] = 'Update';
        $positions = Position::all();
        $golongans = Golongan::all();

        $position = DB::table('stakeholders')
            ->select('positions.id','position')
            ->join('position_stakeholder', 'position_stakeholder.stakeholder_id', '=', 'stakeholders.id')
            ->join('positions', 'positions.id', '=', 'position_stakeholder.position_id')
            ->where('stakeholders.id', '=', $id)
            ->get();

        $data['position'] = (count($position) > 0) ? $position : false;
        $data['golongans'] = (!$golongans->isEmpty()) ? $golongans : false;
        $data['positions'] = (!$positions->isEmpty()) ? $positions : false;

        return view('hrd::partials.stakeholder.edit', $data);
    }

    public function store(Request $request)
    {

        if($request->all()){
            $create = Stakeholder::create($request->except('position'));
            if($create){
                //Insert into position / jabatan
                $positions = $request->input('position');
                foreach($positions as $pos){
                    PositionStakeholder ::create([
                        'stakeholder_id' => $create->id,
                        'position_id' => $pos
                    ]);
                }

                $isPhoto = $request->file('photo');
                if($isPhoto){
                    $photos = $this->uploadPhoto();
                    $create->photo = $photos;
                }

                if($create->save()){
                    Session::flash('info', 'Data inserted');
                }
            }else{
                Session::flash('info', 'Error inserting data');
            }

            return redirect('/hrd/stakeholder');
        }
    }

    public function uploadPhoto()
    {

        // checking file is valid.
        if (@Input::file('photo')->isValid()) {
            //$destinationPath = 'photos'; // upload path
            $destinationPath = public_path('photos');
//            $extension = Input::file('photo')->getClientOriginalExtension(); // getting image extension
            $fileName = Input::file('photo')->getClientOriginalName();
            Input::file('photo')->move($destinationPath, $fileName); // uploading file to given path
            // sending back with message
            Session::flash('success', 'Upload successfully');
        }else{
            return true;
        }

        return Input::file('photo')->getClientOriginalName();
    }

    public function destroy($id)
    {
        $rec = Stakeholder::destroy($id);
        if($rec){
            Session::flash('info', 'Data delete');
            return response()->json('true');
        }else{
            Session::flash('info', 'Error');
            return response()->json('false');
        }
    }

    public function search(Request $request)
    {
        $data = Stakeholder::where('nama', 'LIKE', '%'.$request->get('query').'%')->get();

        foreach($data as $stakeholder){
            $stakeholders[] = [
                'value' => $stakeholder->nama,
                'data' => $stakeholder->id
            ];
        };

        $suggest['query'] = 'Unit';
        $suggest['suggestions'] = $stakeholders;

        return json_encode($suggest);
    }

    public function show($id)
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
        return view('hrd::partials.stakeholder.detail', $data);
    }

    public function update(Request $request ,$id)
    {

//        dd($request->input('position'));

        $rec = Stakeholder::find($id);

        if($request->hasFile('photo')){
            if(Input::file('photo')->getClientOriginalName() == $rec->photo){
                $update = Stakeholder::where('id','=', $id)->update($request->except('_method', '_token', 'photo','position'));

                if($update){
                    Session::flash('info', 'Data Update');
                }else{
                    Session::flash('info', 'Error');
                }
            }else{
                $update = Stakeholder::where('id','=', $id)->update($request->except('_method', '_token', 'photo','position'));

                $photos = $this->uploadPhoto();
                $rec->photo = $photos;
                if($rec->save()){
                    Session::flash('info', 'Data Update');
                }else{
                    Session::flash('info', 'Error');
                }
            }
        }else{
            $update = Stakeholder::where('id','=', $id)->update($request->except('_method', '_token', 'photo','position'));

            if($update){
                Session::flash('info', 'Data Update');
            }else{
                Session::flash('info', 'Error');
            }
        }

        $positions = $request->input('position');
        if($positions){
            foreach($positions as $pos){
                $cek = PositionStakeholder ::where('stakeholder_id', '=', $id)
                    ->where('position_id', '=', $pos)
                    ->get();

                if(count($cek) > 0){
                    PositionStakeholder::where('stakeholder_id', '=', $id)
                        ->delete();
                }

                PositionStakeholder::create(['stakeholder_id' => $id,'position_id' => $pos]);


            }
        }

        return redirect('/hrd/stakeholder/'.$id.'/edit');
    }
}