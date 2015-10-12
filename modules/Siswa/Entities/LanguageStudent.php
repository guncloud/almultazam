<?php namespace Modules\Siswa\Entities;
   
use Illuminate\Database\Eloquent\Model;

class LanguageStudent extends Model {

    protected $guarded = ['id'];
    protected $table = 'language_student';
}