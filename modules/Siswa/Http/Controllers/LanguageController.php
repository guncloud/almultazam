<?php namespace Modules\Siswa\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Siswa\Entities\Classroom;
use Modules\Siswa\Entities\Language;
use Pingpong\Modules\Routing\Controller;
use Modules\Siswa\Entities\Config;
use Modules\Siswa\Entities\ClassroomStudent;
use Modules\Siswa\Entities\LanguageStudent;

class LanguageController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->middleware('pembina');
    }
	
	public function index()
	{
		$language = new Language;
        $languages = $language->getAll();

        $data['languages'] = (count($languages) > 0) ? $languages : false;
		$data['title'] = 'Bahasa';
		return view('siswa::partials.language.index', $data);
	}

    public function store(Request $request)
    {
        $create = Language::create($request->all());
        if($create){
            Session::flash('info', 'Data inserted');
        }else{
            Session::flash('info', 'Error');
        }
        return redirect('/siswa/language');
    }

    public function score(Request $request)
    {
        $classroom = Classroom::all();

        if($request->all()){
            $year = Config::where('slug', '=', 'tahun-ajar')->first()->value;

            $student = new ClassroomStudent;
            $students = $student->getClassroomStudent($request->get('kelas'));

            $student_id = array_pluck($students, 'student_id');

            $lang = LanguageStudent::whereIn('student_id', $student_id)
                ->where('date', '=', $request->get('date'))
                ->where('semester', '=', $request->get('semester'))
                ->where('year', '=', $year)
                ->where('language_id', '=', $request->get('bahasa'))
                ->get();

            if(count($lang) > 0){
                foreach ($lang as $l) {
                    $langs[$l->student_id] = $l;
                }
            }else{
                $langs = false;
            }


        }else{
            $students = false;
            $langs = false;
        }

        $language = Language::all();

        $data['langStudent'] = $langs;
        $data['languages'] = (!$language->isEmpty()) ? $language : false;
        $data['title'] = 'Penilaian Bahasa';
        $data['students'] = $students;
        $data['classrooms'] = (!$classroom->isEmpty()) ? $classroom : false;

        return view('siswa::partials.language.score', $data);
    }

    public function show($id)
    {
        $rec = Language::find($id);

        return response()->json($rec);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        Language::where('id','=', $id)
            ->update($request->except('_method', '_token'));

        Session::flash('info', 'Data updated');

        return redirect('/siswa/language');
    }

    public function destroy(Request $request, $id)
    {
        $rec = Language::destroy($id);
        if($rec){
            Session::flash('info', 'Data deleted');
            return response()->json('true');
        }else{
            Session::flash('info', 'Error');
            return response()->json('false');
        }
    }

}