<?php namespace Modules\Hrd\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model {

    protected $guarded = ['id'];

    public function performances()
    {
        return $this->hasMany('Modules\Hrd\Entities\Performance');
    }

}