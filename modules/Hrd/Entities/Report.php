<?php namespace Modules\Hrd\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Report extends Model {

    protected $guarded = ['id'];

    public function stakeholder()
    {
        return $this->belongsTo('App\Stakeholder');
    }
}