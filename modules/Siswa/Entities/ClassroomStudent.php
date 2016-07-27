<?php namespace Modules\Siswa\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ClassroomStudent extends Model {

    protected $guarded = ['id'];
    protected $table = 'classroom_student';

    public function getClassroomStudent($classroomId = null, $year = null)
    {
        $this->classroomId = $classroomId;
        $this->year = ($year != null) ? $year : Config::where('slug','=', 'tahun-ajar')->first()->value;

        if($classroomId == null){
            return DB::table('classroom_student')
                    ->select('*')
                    ->join('students', 'students.id', '=', 'classroom_student.student_id')
                    ->join('classrooms', 'classrooms.id', '=', 'classroom_student.classroom_id')
                    ->where('year', '=', $this->year)
                    ->whereNull('deleted_at')
                    ->get();


        }else{
            return DB::table('classroom_student')
                    ->select('*')
                    ->join('students', 'students.id', '=', 'classroom_student.student_id')
                    ->join('classrooms', 'classrooms.id', '=', 'classroom_student.classroom_id')
                    ->where('year', '=', $this->year)
                    ->where('classrooms.id', '=', $this->classroomId)
                    ->whereNull('deleted_at')
                    ->get();

        }

        return $getRec;
    }

    public function getClassroomStudentUpgrade($student_id, $year = null)
    {
        $this->year = ($year != null) ? $year : Config::where('slug','=', 'tahun-ajar')->first()->value;

        $next_year = explode('/', $this->year);
        $yearUpgrade = ($next_year[0]+1)."/".($next_year[1]+1);

        return DB::table('classroom_student')
                    ->select('classroom_student.id', 'student_id', 'classroom_id')
                    ->join('students', 'students.id', '=', 'classroom_student.student_id')
                    ->join('classrooms', 'classrooms.id', '=', 'classroom_student.classroom_id')
                    ->where('year', '=', $yearUpgrade)
                    // ->where('classrooms.id', '=', $this->classroomId)
                    ->whereIn('student_id', $student_id)
                    ->whereNull('deleted_at')
                    ->get();
    }

    public function getClassroomStudent_bak($classroomId = null)
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