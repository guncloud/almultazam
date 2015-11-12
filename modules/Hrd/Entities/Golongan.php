<?php namespace Modules\Hrd\Entities;
   
use App\Stakeholder;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model {

    protected $guarded = ['id'];

    public function stakeholder()
    {
        return $this->hasOne('App\Stakeholder');
    }
}