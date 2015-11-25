<?php namespace Modules\Siswa\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Teacher extends Model {

    protected $table = 'stakeholders';
    protected $guarded = ['id'];

    public function getTeachers()
    {
        $teachers = DB::table('stakeholders')
            ->select('stakeholders.*', 'divisions.id as div_id','divisions.division', 'divisions.slug')
            ->join('divisions', 'divisions.id', '=', 'stakeholders.division_id')
            ->where('divisions.slug', '=', 'smpit-al-multazam')
//            ->where('stakeholders.nama', 'LIKE', '%'.$q.'%')
            ->where('stakeholders.deleted_at', '=', null)
            ->get();

        return $teachers;
    }

    public function search($q)
    {
        $teachers = DB::table('stakeholders')
            ->select('stakeholders.*', 'divisions.id as div_id','divisions.division', 'divisions.slug')
            ->join('divisions', 'divisions.id', '=', 'stakeholders.division_id')
            ->where('divisions.slug', '=', 'smpit-al-multazam')
            ->where('stakeholders.nama', 'LIKE', '%'.$q.'%')
            ->where('stakeholders.deleted_at', '=', null)
            ->get();

        return $teachers;
    }
}