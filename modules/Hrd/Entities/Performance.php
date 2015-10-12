<?php namespace Modules\Hrd\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Modules\Hrd\Entities\Indicator;

class Performance extends Model {

    protected $guarded = ['id'];

    public function indicator()
    {
        return $this->belongsTo('indicator');
    }
}