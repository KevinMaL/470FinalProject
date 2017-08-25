<?php
namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Group;
use App\GroupMember;
use App\Post;

class GroupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function joinedGroup()
    {
        $id = Auth::user()->id;

        //some logic retrive the groups the user is belong to

        $rtn = GroupMember::where('user_id',$id)->get()->toArray();
        $group_ids = array();
        foreach($rtn as $item){
            $group_ids[] = $item['group_id'];
        }
        $groups = Group::find($group_ids);

        return view('group.joinedgroups', [
            'groups' => $groups
        ]);
    }
    public function viewGroup($id){
        $group = Group::find($id);
        $member_ids = array();
        $rtn = $group->groupMember->toArray();
        foreach($rtn as $item){
            $member_ids[] = $item['user_id'];
        }
        $users = User::whereIn('id',$member_ids)->paginate(9,['*'],'member');
        $time = \Carbon\Carbon::now();
        $posts = Post::where('group_id',$id)->where('parent_id',0)->paginate(10,['*'],'post');;
        //$blogs
        $events = $group->getEvents()->paginate(5,['*'],'event');
        //$plans =
        $admins = $group->getAdmins()->get();
        return view('group.group')->with(compact('users','time','events','posts','group','admins'));
    }



    public function getFeaturedGroup(){
        $groups = Group::all();
        $groups->getIterator()->uasort( function ($a, $b) { return strcmp($b->memberCount(), $a->memberCount()); });

        return $groups;
    }

    public function viewGroupPost($group_id,$post_id){
        $posts = [];


        $max_depth = Post::where('root_id',$post_id)->orderBy('node_depth','desc')->first()->node_depth;

        $posts[] = Post::where('root_id',$post_id)->where('node_depth',0)->first();
        for($depth = 1; $depth <= $max_depth; $depth++){
            $level_posts = Post::where('root_id',$post_id)->where('node_depth',$depth)->get();
            foreach($level_posts as $post){

                $parent_id = $post->parent_id;
                foreach($posts as $key => $value){
                    if($value->id == $parent_id){
                        array_splice( $posts, $key+1, 0, [$post] );
                    }
                }
            }
        }

        return view('group.view_post_thread')->with(compact('posts'));
    }

    public function replyPost($group_id,$post_id,Request $request){
        $user_id = Auth::user()->id;

        $validator = Validator::make($request->all(), [
           'post_body' => 'required|max:200',
        ]);
        if ($validator->fails()) {
          return redirect()->back()
              ->withInput()
          ->withErrors($validator);
        }
        Post::newReply($post_id,$request->post_body,$user_id);
        return redirect()->back();
    }

    public function newPost($group_id,Request $request){
        $user_id = Auth::user()->id;

        $validator = Validator::make($request->all(), [
           'post_body' => 'required|max:200',
        ]);
        if ($validator->fails()) {
          return redirect()->back()
              ->withInput()
          ->withErrors($validator);
        }
        Post::newPost($group_id,$request->post_body,$user_id);
        return redirect()->back();
    }
}
