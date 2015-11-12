<?php namespace Modules\Siswa\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classroom extends Model {

    protected $guarded = ['id'];

    public function getClassrooms()
    {
        $rec = DB::table('classrooms')
                    ->select('stakeholders.id as stakeholder_id',
                        'stakeholders.nama as guru', 'classrooms.*')
                    ->join('stakeholders', 'stakeholders.id', '=', 'classrooms.teacher_id')
                    ->join('divisions', 'divisions.id', '=', 'stakeholders.division_id')
                    ->where('divisions.slug', '=', 'smpit-al-multazam')
                    ->get();

        return $rec;
    }

    public function students()
    {
        return $this->belongsToMany('Modules\Siswa\Entities\Student')->withPivot('year');
    }

    public function getClass($uid)
    {
        $year = Config::where('slug','=','tahun-ajar')->first()->value;

        $rec = DB::table('classroom_student')
            ->select('classroom_student.classroom_id', 'classrooms.classroom')
            ->join('students', 'students.id', '=', 'classroom_student.student_id')
            ->join('classrooms', 'classrooms.id', '=', 'classroom_student.classroom_id')
            ->where('year','=',$year)
            ->where('student_id', '=', $uid)
            ->first();

        return $rec;
    }

}