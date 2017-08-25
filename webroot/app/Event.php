<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Event extends Model
{
    public function getLink(){
      //return "<a href='/event/". $this->id ."'>".$this->title."</a>";
      return "/event/" . $this->id;
    }
    public function getUsers(){
        $relations = UserEvent::where('event_id',$this->id)->get();
        $user_ids = [];
        foreach($relations as $item){
            $user_ids[] = $item['user_id'];
        }
        $users = User::whereIn('id',$user_ids);
        return $users;
    }
    public function hasMe(){
        $me = Auth::user();
        $users = $this->getUsers()->get();
        $rtn = false;
        foreach($users as $user){
            if($user->id == $me->id){
                $rtn = true;
            }
        }
        return $rtn;
    }
}
