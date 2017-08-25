@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Latest Blogs</div>

                <div class="panel-body">
                    @foreach($blogs as $key => $blog)
                    <div class="row">
                        <div class="col-md-2">
                            <div class="blog-avatar">
                                <img style="height:64px; width:64px;" src="{{$blog->getAuthor()->getProfile()->avatar}}">
                            </div>
                            <div class="blog-author">
                                <a href="">{{$blog->getAuthor()->name}}</a>
                            </div>
                        </div>
                        <div class="col-md-10" style="padding:0;">
                            <div class="blog-title">
                                {{$blog->title}}
                            </div>
                            <div style="font-style:italic;">Last Update: {{$blog->updated_at}}</div>
                            <div class="latest-blog">
                                {{ str_limit(strip_tags($blog->content), 150, '...') }}<a style="float:right;" href="{{ route('single_blog', $blog->id) }}">Read More</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    {{$blogs->links()}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Actions</div>
                <div class="panel-body">
                    <a href="/blog/{{Auth::user()->id}}">
                        <button type="submit" class="btn btn-success">
                          <i class="fa fa-btn fa-plus"></i>New Blog
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
