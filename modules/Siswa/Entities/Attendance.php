<?php namespace Modules\Siswa\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Modules\Siswa\Entities\Student;

class Attendance extends Model {

    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsTo('Student');
    }

}