<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stakeholder extends Model
{
    use SoftDeletes;

    protected $dates = ['delete_at'];
    protected $guarded = ['id'];

    public function division()
    {
        return $this->belongsTo('App\Division');
    }

    public function reports()
    {
        return $this->hasMany('Modules\Hrd\Entities\Report');
    }

    public function vacations()
    {
        return $this->hasMany('Modules\Hrd\Entities\Vacation');
    }

    public function positions()
    {
        return $this->belongsToMany('Modules\Hrd\Entities\Position');
    }
}
