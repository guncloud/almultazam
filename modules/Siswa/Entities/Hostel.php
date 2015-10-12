<?php namespace Modules\Siswa\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Hostel extends Model {

    protected $guarded = ['id'];

    public function getAll()
    {
        $data = DB::table('hostels')
            ->select('hostels.id as id', 'hostels.hostel', 'hostels.teacher_id', 'hostels.code',
                'stakeholders.id as stakeholer_id', 'stakeholders.nama')
            ->join('stakeholders','stakeholders.id','=','hostels.teacher_id')
            ->get();

        return $data;
    }

    public function getOne($id)
    {
        $data = DB::table('hostels')
            ->where('hostels.id','=', $id)
            ->join('stakeholders','stakeholders.id','=','hostels.teacher_id')
            ->first();

        return $data;
    }

}