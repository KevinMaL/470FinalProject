@extends('layouts.app')

@section('content')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="/templateEditor/ckeditor/ckeditor.js"></script>

<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="col-md-8">
            <section class="blog_form">
                @include('blogs.blog_form')
            </section>
        </div>

        <aside class="col-md-4">
            <section class="user_info">
                @include('blogs.user_info', ['user' => Auth::user()])
            </section>
            <section class="follower">
                @include('blogs.follow', ['user' => Auth::user()])
            </section>
        </aside>

        <div class="col-md-12">
            @if (Auth::check())
                @include('blogs._follow_form')
            @endif

            <h3>Blog list</h3>
                @include('blogs.feed')
        </div>
    </div>
</div>
@stop