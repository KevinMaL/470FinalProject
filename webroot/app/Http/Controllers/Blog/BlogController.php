<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Blog;
use App\User;
use Auth;


class BlogController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $blogs = $user->blogs()
            ->orderBy('created_at', 'desc')
            ->paginate(30);
        $feed_items = [];
        if (Auth::check()) {
            $feed_items = Auth::user()->feed()->paginate(30);
        }

        return view('blogs.show', compact('user', 'blogs', 'feed_items'));
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);

        Auth::user()->blogs()->create([
            'content' => $request->content
        ]);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $blogs = Blog::findOrFail($id);
        $this->authorize('destroy', $blogs);
        $blogs->delete();
        session()->flash('success', 'Blog deleted！');
        return redirect()->back();
    }

    public function all()
    {
        $blogs = Blog::orderBy('updated_at', 'desc')
            ->paginate(10);
        return view('blogs.all_blogs', compact('blogs'));
    }

    public function show_info($id)
    {
        $user = User::findOrFail($id);
        $blogs = $user->blogs()
            ->orderBy('created_at', 'desc')
            ->paginate(30);
        $feed_items = [];
        if (Auth::check()) {
            $feed_items = Auth::user()->feed()->paginate(30);
        }

        return view('blogs.show_info', compact('user', 'blogs', 'feed_items'));

    }

    public function single_blog($blog_id)
    {
        $blog = Blog::find($blog_id);
        $user = User::find($blog->user_id);
        return view('blogs.blog_single', compact('blog','user'));
    }
}
