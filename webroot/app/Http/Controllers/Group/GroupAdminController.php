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
use App\GroupAdmin;

class GroupAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.group');
    }


    public function allGroups()
    {
        $groups = Group::orderBy('name')->get();

        return view('group.allgroups', [
            'groups' => $groups
        ]);
    }

    public function manageGroup($id)
    {
        $group = Group::find($id);
        $members = $group->groupMember;

        return view('group.managegroup', [
            'members' => $members,
            'group' => $group
        ]);
    }

    public function newAdmin($group_id,Request $request)
    {
      $to_user = User::where('name',$request->admin_name)->first();
      if(!$to_user){
        return redirect()->back()->withErrors('No user found.');
      }

      $validator = Validator::make($request->all(), [
          'admin_name' => 'required',
      ]);

      if ($validator->fails()) {
          return redirect()->back()
              ->withInput()
          ->withErrors($validator);
      }



      $admin = new GroupAdmin();
      $admin->user_id = $to_user->id;
      $admin->group_id = $group_id;
      $admin->save();

      return redirect()->back();
    }

    public function removeAdmin($group_id,$user_id)
    {
        $admins = GroupAdmin::where('group_id',$group_id)->where('user_id',$user_id)->get();
        foreach($admins as $admin){
            $admin->delete();
        }
        return redirect()->back();
    }

    public function newMember($group_id,Request $request)
    {

        $to_user = User::where('name',$request->member_name)->first();
          if(!$to_user){
            return redirect()->back()->withErrors('No user found.');
          }

          $validator = Validator::make($request->all(), [
              'member_name' => 'required',
          ]);

          if ($validator->fails()) {
              return redirect()->back()
                  ->withInput()
              ->withErrors($validator);
          }



          $admin = new GroupMember();
          $admin->user_id = $to_user->id;
          $admin->group_id = $group_id;
          $admin->save();
        return redirect()->back();
    }
    public function removeMember($group_id,$user_id)
    {

        $admins = GroupMember::where('user_id',$user_id)->where('group_id',$group_id)->get();
        foreach($admins as $admin){
            $admin->delete();
        }

        return redirect()->back();
    }

}
