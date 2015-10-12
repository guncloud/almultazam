<?php namespace Modules\Siswa\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public function classrooms(){
        return $this->belongsToMany('Modules\Siswa\Entities\Classroom')->withPivot('year');
    }

    public function achievements()
    {
        return $this->hasMany('Modules\Siswa\Entities\Achievement');
    }

    public function violations()
    {
        return $this->hasMany('Modules\Siswa\Entities\Violation');
    }

    public function attedances()
    {
        return $this->hasMany('Modules\Siswa\Entities\Attedance');
    }

    public function scores()
    {
        return $this->hasMany('Modules\Siswa\Entities\Score');
    }

    public function ekskuls()
    {
        return $this->belongsToMany('Modules\Siswa\Entities\Ekskul', 'student_ekskul');
    }
}