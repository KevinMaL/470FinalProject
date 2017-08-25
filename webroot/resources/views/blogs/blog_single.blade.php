@extends('layouts.app')

@section('headers')

@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
            <div class="panel-heading">Blog: {{$blog->title}}</div>

                <div class="panel-body">
                    <div class="avatar">
                        <img src="{{$user->profile->avatar}}">
                    </div>
                    <div class="name">
                        {{$user->name}}
                    </div>
                    <div class="blog-body">
                    {!! $blog['content'] !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
