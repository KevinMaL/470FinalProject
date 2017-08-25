<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['plan_name'];

    public function user(){
    	return $this->belongsTO('App\User');
    }

    public function planItems(){
      return $this->hasMany('App\PlanItem');
    }



}
