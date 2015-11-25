<?php namespace Modules\Siswa\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ClassroomStudent extends Model {

    protected $guarded = ['id'];
    protected $table = 'classroom_student';

    public function getClassroomStudent($classroomId = null)
    {
        $this->classroomId = $classroomId;

        if($classroomId == null){
            $getRec = Cache::remember('student_'.$classroomId, 60, function()
            {
                $year = Config::where('slug','=', 'tahun-ajar')->first()->value;

                return DB::table('classroom_student')
                    ->select('*')
                    ->join('students', 'students.id', '=', 'classroom_student.student_id')
                    ->join('classrooms', 'classrooms.id', '=', 'classroom_student.classroom_id')
                    ->where('year', '=', $year)
                    ->whereNull('deleted_at')
                    ->get();
            });


        }else{
            $getRec = Cache::remember('student_'.$classroomId, 60, function()
            {
                $year = Config::where('slug','=', 'tahun-ajar')->first()->value;

                return DB::table('classroom_student')
                    ->select('*')
                    ->join('students', 'students.id', '=', 'classroom_student.student_id')
                    ->join('classrooms', 'classrooms.id', '=', 'classroom_student.classroom_id')
                    ->where('year', '=', $year)
                    ->where('classrooms.id', '=', $this->classroomId)
                    ->whereNull('deleted_at')
                    ->get();
            });

        }

        return $getRec;
    }

}