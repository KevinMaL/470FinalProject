<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Profile;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne('App\Profile','user_id','id');
    }

    //Blogs and fans

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function getProfile()
    {
        $profile = $this->profile;
        if(!$profile){
            $profile = new Profile;
            $profile->user_id = $this->id;
            $profile->avatar = "/assets/images/default-avatar.png";
            $profile->bio = "This user has not input the bio yet.";
            $profile->save();
            $this->profile = $profile;
        }
        return $profile;
    }

    public function feed()
    {
        $user_ids = Auth::user()->followings->pluck('id')->toArray();
        array_push($user_ids, Auth::user()->id);
        return Blog::whereIn('user_id', $user_ids)
            ->with('user')
            ->orderBy('created_at', 'desc');
    }

    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    public function followers()
    {
        return $this->belongsToMany(User::Class, 'followers', 'user_id', 'follower_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::Class, 'followers', 'follower_id', 'user_id');
    }

    public function follow($user_ids)
    {
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids, false);
    }

    public function unfollow($user_ids)
    {
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }

    public function isFollowing($user_id)
    {
        return $this->followings->contains($user_id);
    }

    public function link()
    {
        return "/user/" . $this->id;
    }
    public function getGroups()
    {
        $relations = GroupMember::where('user_id',$this->id)->get();
        $group_ids = [];
        foreach($relations as $item){
            $group_ids[] = $item['group_id'];
        }
        $groups = Group::whereIn('id',$group_ids);
        return $groups;
    }
    public function getEvents()
    {
        $relations = UserEvent::where('user_id',$this->id)->get();
        $event_ids = [];
        foreach($relations as $item){
            $event_ids[] = $item['event_id'];
        }
        $events = Event::whereIn('id',$event_ids);
        return $events;
    }
    public function getPlans()
    {

        $plans = Plan::where('user_id',Auth::user()->id)->get();

        return $plans;
    }
    public function isAdminGroup($group_id){
        $user_id = Auth::user()->id;
        $results = GroupAdmin::where('group_id',$group_id)->where('user_id',$user_id)->get();

        return $results->count() > 0;
    }
}
