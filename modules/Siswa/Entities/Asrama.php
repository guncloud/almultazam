<?php namespace Modules\Siswa\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Asrama extends Model {

    protected $table = 'asrama';
    protected $guarded = ['id'];

    public function getAsrama()
    {
        $rec = DB::table('asrama')
            ->select('*')
            ->join('stakeholders', 'stakeholders.id', '=', 'asrama.teacher_id')
            ->join('divisions', 'divisions.id', '=', 'stakeholders.division_id')
            ->where('divisions.slug', '=', 'smpit-al-multazam')
            ->get();

        return $rec;
    }
}