<?php namespace Modules\Siswa\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClassroomStudent extends Model {

    protected $guarded = ['id'];
    protected $table = 'classroom_student';

    public function getClassroomStudent($classroomId = null)
    {
        $year = Config::where('slug','=', 'tahun-ajar')->first()->value;

        if($classroomId == null){
            $getRec = DB::table('classroom_student')
                ->select('*')
                ->join('students', 'students.id', '=', 'classroom_student.student_id')
                ->join('classrooms', 'classrooms.id', '=', 'classroom_student.classroom_id')
                ->where('year', '=', $year)
                ->where('deleted_at', '=', null)
                ->get();
        }else{
            $getRec = DB::table('classroom_student')
                ->select('*')
                ->join('students', 'students.id', '=', 'classroom_student.student_id')
                ->join('classrooms', 'classrooms.id', '=', 'classroom_student.classroom_id')
                ->where('year', '=', $year)
                ->where('classrooms.id', '=', $classroomId)
                ->where('deleted_at', '=', null)
                ->get();
        }

        return $getRec;
    }

}