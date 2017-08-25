<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanItem extends Model
{
    protected $fillable = ['item_name','item_body'];

     public function plan(){
    	return $this->belongsTO('App\Plan');
    }
}
