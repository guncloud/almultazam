<?php namespace Modules\Siswa\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Siswa\Entities\Contract;
use Modules\Siswa\Entities\Ekskul;
use Pingpong\Modules\Routing\Controller;
use Modules\Siswa\Entities\Student;
use Modules\Siswa\Entities\Classroom;
use Modules\Siswa\Entities\ClassroomStudent;
use Modules\Siswa\Entities\Config;
use Illuminate\Support\Facades\Session;
use Modules\Siswa\Entities\StudentEkskul;

class SiswaController extends Controller {

    public function index(Request $request)
    {
        $student = new ClassroomStudent;
        $classroomId = $request->get('byClassroom', null);
        $students = $student->getClassroomStudent($classroomId);
        $classrooms = Classroom::all();

        $data['classrooms'] = (!$classrooms->isEmpty()) ? $classrooms : false;
        $data['title'] = 'Siswa';
        $data['students'] = (count($students) > 0) ? $students : false;
        return view('siswa::partials.siswa.index', $data);
    }

    public function create()
    {
        $data['title'] = 'Create data siswa';
        $classrooms = Classroom::all();

        $data['classrooms'] = (!$classrooms->isEmpty()) ? $classrooms : false;

        return view('siswa::partials.siswa.create', $data);
    }

    public function edit($uid)
    {
        $student = Student::find($uid);
        $classrooms = Classroom::all();
        $studentClass = new Classroom;
        $studentClass = $studentClass->getClass($uid);

//        dd($student->classrooms());

        $data['classrooms'] = (!$classrooms->isEmpty()) ? $classrooms : false;
        $data['title'] = 'Update data siswa';
        $data['student'] = $student;
        $data['studentClass'] = $studentClass;
        return view('siswa::partials.siswa.edit', $data);
    }

    public function update(Request $request, $uid)
    {
        $update = Student::where('id', '=', $uid)->update($request->except('classroom', '_token', '_method'));

        $year = Config::where('slug', '=', 'tahun-ajar')->first()->value;
        ClassroomStudent::where('student_id', '=', $uid)
            ->where('year', '=', $year)
            ->update([
                'classroom_id' => $request->get('classroom')
            ]);

        if($update){
            Session::flash('info', 'Data Update');
        }else{
            Session::flash('info', 'Error');
        }

        return redirect('/siswa/siswa/');
    }

    public function show($userId)
    {
        $data['title'] = 'Detail Siswa';
        $student = Student::find($userId);
        $contract = new Contract;
        $contracts = $contract->getContract();

        $akademik = $this->getAkademik($userId);
        $ekskuls = Ekskul::all();

        $ekskulStudent = $this->getEkskul($userId);

        $data['ekskuls'] = (!$ekskuls->isEmpty()) ? $ekskuls : false;
        $data['ekskulStudent'] = (count($ekskulStudent) > 0) ? $ekskulStudent : false;
        $data['scores'] = (count($akademik)) ? $akademik : false;
        $data['contracts'] = (count($contracts) > 0) ? $contracts : false;
        $data['student'] = ($student) ? $student : false;
        return view('siswa::partials.siswa.detail', $data);
    }

    public function getEkskul($uid)
    {
        $ekskul = StudentEkskul::where('student_id', $uid)->get();

        if(count($ekskul) > 0){
            foreach($ekskul as $eks)
            {
                $ekskulStudent[$eks->ekskul_id] = $eks;
            }
        }else{
            $ekskulStudent = false;
        }

        return $ekskulStudent;
    }

    public function getAkademik($uid)
    {
        $score = Student::find($uid)->scores;

       // dd($score);

        if(!$score->isEmpty()){
            foreach($score as $scr)
            {
                $arr = array($scr->uh_1, $scr->uh_2, $scr->uh_3, $scr->uh_4);
                $arr = array_filter($arr);

                if(count($arr) > 0){
                    $arrAverage = $uhAverage = array_sum($arr) / count($arr);
                    $summary = (2 * $arrAverage + $scr->uts + $scr->uas) / 4;
                }else{
                    $summary = false;
                }

                $scores[$scr->contract_id] = $scr;
                $scores[$scr->contract_id]['skor'] = $summary;
            }
        }else{
            $scores = false;
        }

        return $scores;
    }

    public function store(Request $request)
    {
        if($request->all()){
            $tahun_ajar = Config::where('slug', '=', 'tahun-ajar')->first()->value;
            $create = Student::create($request->except('classroom'));
            if($create){
                $student = Student::find($create->id);
                $student->classrooms()->attach($request->input('classroom'), ['year' => $tahun_ajar]);
                Session::flash('info', 'Data inserted');
            }else{
                Session::flash('info', 'Error');
            }
            return redirect('siswa/siswa');
        }
    }

    public function search(Request $request)
    {
        $data = Student::where('nama', 'LIKE', '%'.$request->get('query').'%')->get();

        foreach($data as $guru){
            $gurus[] = [
                'value' => $guru->nama,
                'data' => $guru->id
            ];
        };

        $suggest['query'] = 'Unit';
        $suggest['suggestions'] = $gurus;

        return json_encode($suggest);

    }

    public function destroy(Request $request, $id)
    {
        $rec = Student::destroy($id);

        if($rec){
            Session::flash('info', 'Data deleted');
            return response()->json('true');
        }else{
            Session::flash('info', 'Error');
            return response()->json('false');
        }
    }

}