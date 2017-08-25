@extends('layouts.app')
@section('title', $user->name)
@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="col-md-12">
                <div class="col-md-offset-2 col-md-8">
                    <section class="user_info">
                        @include('blogs.user_info', ['user' => Auth::user()])
                    </section>
                    <section class="follower">
                        @include('blogs.follow', ['user' => Auth::user()])
                    </section>
                </div>
            </div>
            <div class="col-md-12">
                @if (Auth::check())
                    @include('blogs._follow_form')
                @endif

                    @if (count($feed_items))
                        <ol class="blogs">
                            @foreach ($feed_items as $blog)
                                @include('blogs._blog', ['user' => $blog->user])
                            @endforeach
                            {!! $feed_items->render() !!}
                        </ol>
                    @endif
            </div>
        </div>
    </div>
@stop