<?php namespace Modules\Siswa\Entities;
   
use Illuminate\Database\Eloquent\Model;

class StudentEkskul extends Model {

    protected $guarded = ['id'];

    protected $table = 'student_ekskul';

}