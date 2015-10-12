<?php namespace Modules\Hrd\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vacation extends Model {

    protected $guarded = ['id'];

    public function stakeholder()
    {
        return $this->belongsTo('App\Stakeholder');
    }

    public function getVacation($date)
    {
        $rec = DB::table('vacations')
            ->select('vacations.id', 'vacations.start', 'vacations.end', 'vacations.info', 'stakeholders.nama as pegawai')
            ->where('start', '<=', $date)
            ->where('end', '>=', $date)
            ->join('stakeholders', 'stakeholders.id', '=', 'vacations.stakeholder_id')
            ->get();

        return $rec;
    }

    public function getAllVacation()
    {
        $rec = DB::table('vacations')
            ->select('vacations.id', 'vacations.start', 'vacations.end', 'vacations.info', 'stakeholders.nama as pegawai')
            ->join('stakeholders', 'stakeholders.id', '=', 'vacations.stakeholder_id')
            ->get();

        return $rec;
    }


}