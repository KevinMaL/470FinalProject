<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\User;
use Auth;
use App\Event;
use App\Group;
use App\GroupMember;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user = Auth::user();
        $featured_group = app('App\Http\Controllers\Group\GroupController')->getFeaturedGroup();
        $user_groups = [];
        $plans = [];
        $now = \Carbon\Carbon::now();
        if(is_null($current_user)){
            $event = Event::where('event_start','>',$now)->latest()->first();
            $plan = [];
        }else{
            $user_groups = $current_user->getGroups()->paginate(3,['*'],'group');
            $event = $current_user->getEvents()->where('event_start','>',$now)->latest()->first();
            $plan = [];
        }
        $blogs = Blog::latest()->take(3)->get();
        $blogAuthors = array();
        foreach($blogs as $blog){
            $blogAuthors[] = User::find($blog->user_id);
        }
        return view('home')->with(compact('plans','blogs','blogAuthors','event','featured_group','user_groups'));
    }

     public function viewAllGroups(){
        $current_user = Auth::user();
        $user_groups = [];
         $groups = Group::orderBy('name')->paginate(5,['*'],'group');
         $featured_group = app('App\Http\Controllers\Group\GroupController')->getFeaturedGroup();
         if(is_null($current_user)){
         }else{
            $user_groups = $current_user->getGroups()->paginate(3,['*'],'my_group');
         }
         return view('group.view_all_groups')->with(compact('groups','featured_group','user_groups'));
    }

}
