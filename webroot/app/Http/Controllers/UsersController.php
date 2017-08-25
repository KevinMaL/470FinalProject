<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;

class UsersController extends Controller
{

    public function show($id)
    {
        $user = User::findOrFail($id);
        $statuses = $user->statuses()
            ->orderBy('created_at', 'desc')
            ->paginate(30);
        return view('users.show', compact('user', 'statuses'));
    }

    public function allUsers()
    {
        $users = User::orderBy('id')->paginate(20);

        return view('group.allusers', [
            'users' => $users
        ]);
    }
    public function promoteAdmin($user_id)
    {
      $user = User::find($user_id);
      $user->is_admin = 1;
      $user->save();

      return redirect()->back();
    }
      public function revokeAdmin($user_id)
    {
      $user = User::find($user_id);
      $user->is_admin = 0;
      $user->save();

      return redirect()->back();
    }
}
