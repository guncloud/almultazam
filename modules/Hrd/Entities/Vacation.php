<?php namespace Modules\Hrd\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vacation extends Model {

    protected $guarded = ['id'];

    public function stakeholder()
    {
        return $this->belongsTo('App\Stakeholder');
    }

    public function getVacation($req)
    {
        $year = date('Y');

        $query = DB::table('vacations')
            ->select('vacations.id', 'vacations.start', 'vacations.end', 'vacations.info', 'stakeholders.nama as pegawai')
            ->join('stakeholders', 'stakeholders.id', '=', 'vacations.stakeholder_id');

        if($req['bulan'] && $req['bulan'] != 'null'){
            $query->where('start', 'LIKE', $year.'-'.$req['bulan'].'-%');
        }

        if($req['date']){
            $query->where('start', '<=', $req['date'])->where('end', '>=', $req['date']);
        }

        if($req['pegawai']){
            $query->where('stakeholders.id', '=', $req['pegawai']);
        }

        $rec = $query->get();

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