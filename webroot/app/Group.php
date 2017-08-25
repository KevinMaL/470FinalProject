<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GroupAdmin;
use Auth;

class Group extends Model
{
    public function groupMember()
    {
        return $this->hasMany('App\GroupMember');
    }
    public function getAdmins()
    {
        $relations = GroupAdmin::where('group_id',$this->id)->get();
        $admin_ids = [];
        foreach($relations as $item){
            $admin_ids[] = $item['user_id'];
        }
        $admins = User::whereIn('id',$admin_ids);
        return $admins;
    }
    public function assignAdmin($user_id)
    {
        $test = GroupAdmin::where('user_id',$user_id)->where('group_id',$this->id)->get();
        if($test->count() == 0){
          GroupAdmin::create([
            'user_id' => $user_id,
            'group_id' => $this->id,
            ]);
          return true;
        }else{
          return false;
        }
    }
    public function removeAdmin($user_id)
    {
        $admins = GroupAdmin::where('user_id',$user_id)->where('group_id',$this->id)->get();
        foreach($admins as $admin){
            $admin->delete();
        }
    }
    public function link()
    {
        return '/group/' .$this->id;
    }

    public function memberCount()
    {
        return GroupMember::where('group_id',$this->id)->count();
    }

    public function getEvents()
    {
        $events = Event::where('group_id',$this->id);
        return $events;
    }
    public function getOwner()
    {
        return User::find($this->owner_id);
    }
    public function isAdmin()
    {
        $user = Auth::user();
        $admins = GroupAdmin::where('user_id',$user->id)->where('group_id',$this->id)->get();
        return $admins->count()>0 || $this->owner_id == $user->id;
    }
}
