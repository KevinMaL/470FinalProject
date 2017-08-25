<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function setRead(){
      $this->has_read = 1;
      $this->save();
    }
}
