<?php namespace Modules\Siswa\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ekskul extends Model {

    protected $guarded = ['id'];

    public function getAll()
    {
        $rec = DB::table('ekskuls')
            ->select('stakeholders.*', 'ekskuls.id as ekskul_id', 'ekskuls.code', 'ekskuls.ekskul')
            ->join('stakeholders','stakeholders.id','=','ekskuls.teacher_id')
            ->get();

        return $rec;
    }

    public function students()
    {
        return $this->hasMany('Modules\Siswa\Entities\Student', 'student_ekskul');
    }

}