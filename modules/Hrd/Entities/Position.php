<?php namespace Modules\Hrd\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Position extends Model {

    protected $guarded = ['id'];

    public function stakeholders()
    {
        return $this->belongsToMany('/app/Stakeholder');
    }

}