<?php namespace Modules\Siswa\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Language extends Model {

    protected $guarded = ['id'];

    public function getAll()
    {
        $rec = DB::table('languages')
            ->select('languages.*', 'stakeholders.id as stakeholder_id', 'stakeholders.nama as teacher')
            ->join('stakeholders', 'stakeholders.id', '=', 'languages.teacher_id')
            ->get();

        return $rec;
    }

}