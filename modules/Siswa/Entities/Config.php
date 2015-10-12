<?php namespace Modules\Siswa\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Config extends Model {

    protected $guarded = ['id'];

    public function getYear()
    {
        return Config::where('slug', '=', 'tahun-ajar')->first()->value;
    }

}