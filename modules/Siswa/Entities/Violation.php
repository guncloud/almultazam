<?php namespace Modules\Siswa\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Violation extends Model {

    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsTo('Modules\Siswa\Entities\Student');
    }

}