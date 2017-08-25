<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Follow;
use App\Blog;
use Auth;


class FollowController extends Controller
{

    public function followings($id)
    {
        $user = User::findOrFail($id);
        $users = $user->followings()->paginate(30);
        $title = 'followerings';
        return view('blogs.show_follow', compact('users', 'title'));
    }

    public function followers($id)
    {
        $user = User::findOrFail($id);
        $users = $user->followers()->paginate(30);
        $title = 'fans';
        return view('blogs.show_follow', compact('users', 'title'));
    }

    public function __construct()
    {
        $this->middleware('auth', [
            'store', 'destroy'
        ]);
    }

    public function store($id)
    {
        $user = User::findOrFail($id);

        if (Auth::user()->id === $user->id) {
            return redirect('/');
        }

        if (!Auth::user()->isFollowing($id)) {
            Auth::user()->follow($id);
        }

        return redirect()->route('blog', $id);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (Auth::user()->id === $user->id) {
            return redirect('/');
        }

        if (Auth::user()->isFollowing($id)) {
            Auth::user()->unfollow($id);
        }

        return redirect()->route('blog', $id);
    }
}