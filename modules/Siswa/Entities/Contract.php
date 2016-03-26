<?php namespace Modules\Siswa\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Siswa\Entities\Config;

class Contract extends Model {

    protected $guarded = ['id'];

    public function getContract()
    {
        $year = Config::where('slug','=','tahun-ajar')->first()->value;

        $record = DB::table('contracts')
            ->select('contracts.*','stakeholders.nama as teacher', 'subjects.subject', 'subjects.grade', 'subjects.code',
                'classrooms.id as classroom_id', 'classrooms.classroom')
            ->join('stakeholders', 'stakeholders.id', '=', 'contracts.teacher_id')
            ->join('subjects', 'subjects.id', '=', 'contracts.subject_id')
            ->join('classrooms', 'classrooms.id', '=', 'contracts.classroom_id')
//            ->groupBy('teacher_id')
            ->where('contracts.year','=', $year)
            ->groupBy('stakeholders.id')
            ->groupBy('semester')
            ->orderBy('subjects.code')
            ->get();

        return $record;
    }

    public function getContractById($id)
    {
        $year = Config::where('slug','=','tahun-ajar')->first()->value;

        $record = DB::table('contracts')
            ->select('contracts.*','stakeholders.nama as teacher', 'subjects.subject', 'subjects.grade', 'subjects.code',
                'classrooms.id as classroom_id', 'classrooms.classroom')
            ->join('stakeholders', 'stakeholders.id', '=', 'contracts.teacher_id')
            ->join('subjects', 'subjects.id', '=', 'contracts.subject_id')
            ->join('classrooms', 'classrooms.id', '=', 'contracts.classroom_id')
            ->where('contracts.year','=', $year)
            ->where('contracts.id', '=', $id)
            ->first();

        return $record;
    }

    public function getContractByClassroom($id)
    {
        $year = Config::where('slug','=','tahun-ajar')->first()->value;

        $record = DB::table('contracts')
            ->select('contracts.*','stakeholders.nama as teacher', 'subjects.subject', 'subjects.grade', 'subjects.code',
                'classrooms.id as classroom_id', 'classrooms.classroom')
            ->join('stakeholders', 'stakeholders.id', '=', 'contracts.teacher_id')
            ->join('subjects', 'subjects.id', '=', 'contracts.subject_id')
            ->join('classrooms', 'classrooms.id', '=', 'contracts.classroom_id')
            ->where('contracts.year','=', $year)
            ->where('classrooms.id', '=', $id)
            ->get();

        return $record;

    }

}