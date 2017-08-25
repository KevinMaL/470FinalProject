<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class BMI extends Model
{
    public function user(){
    	return $this->belongsTO('App\User');
    }
    protected $table = 'bmis';
}
