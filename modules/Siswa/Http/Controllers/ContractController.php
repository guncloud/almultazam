<?php namespace Modules\Siswa\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Modules\Siswa\Entities\Config;
use Modules\Siswa\Entities\Contract;
use Modules\Siswa\Entities\Subject;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Support\Facades\Session;

class ContractController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->middleware('admin');
    }
	
	public function index()
	{
		//return view('siswa::index');
	}

    public function store(Request $request)
    {
        $year = Config::where('slug','=','tahun-ajar')->first()->value;

        if($request->all()){
            $create = Contract::create([
                'teacher_id' => $request->get('teacher_id'),
                'subject_id' => $request->get('subject_id'),
                'classroom_id' => $request->get('classroom'),
                'year' => $year,
                'semester' => $request->get('semester')
            ]);

            if($create){
                Session::flash('info', 'Data Inserted');
                return redirect('/siswa/subject');
            }else{
                return redirect('/siswa/subject');
            }
        }
    }

    public function show(Request $request, $id)
    {

        if($request->ajax()){
            $classroom_id = $id;

            $contract = new Contract;
            $rec = $contract->getContractByClassroom($classroom_id);

            return response()->json($rec);
        }else{
            $contract = Contract::find($id);
        }

//        return response()->json($rec);
//        echo $contract->teacher->nama;
//
//        dd($contract);
        $data['subject'] = Subject::all();
        
        $data['title'] = 'Update Pengajaran';
        $data['contract'] = $contract;
        return view('siswa::partials.contract.edit', $data);

    }

    public function update(Request $request, $id)
    {
        Contract::where('id','=', $id)
            ->update($request->except('_method', '_token'));

        Session::flash('info', 'Data updated');

        return redirect('/siswa/subject');
    }

    public function destroy(Request $request, $id)
    {
        $rec = Contract::destroy($id);
        if($rec){
            Session::flash('info', 'Data deleted');
            return response()->json('true');
        }else{
            Session::flash('info', 'Error');
            return response()->json('false');
        }
    }

}