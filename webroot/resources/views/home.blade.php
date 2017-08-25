@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Latest Blogs</div>

                <div class="panel-body">
                    @if($blogs->count() > 0)
                        @foreach($blogs as $key => $blog)
                        <div class="row">
                            <div class="col-md-2">
                                <div class="blog-avatar">
                                    <img style="height:64px; width:64px;" src="{{$blogAuthors[$key]->getProfile()->avatar}}">
                                </div>
                                <div class="blog-author">
                                    <a href="">{{$blogAuthors[$key]->name}}</a>
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
                    @endif
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                @if (Auth::check())
                My Upcoming Event
                @else
                Most Recent Event
                @endif
                </div>
                <div class="panel-body">
                    @if($event)
                    <div class="upcoming-event" style="padding:20px; text-align:center;">
                        <img style="height:96px; width:96px;" src="/assets/images/calendar.png">
                        <div><a href="">{{$event->title}}</a></div>
                        <div style="font-style:italic;">Time: {{$event->event_start}}</div>
                        <div><i class="fa fa-map-marker" aria-hidden="true"></i><a href="">&nbsp;{{$event->address}}</a></div>
                    </div>
                    @endif
                </div>
            </div>
           @if (Auth::check())

           <div class="panel panel-default">
                <div class="panel-heading">My Groups</div>

                <div class="panel-body">
                    @if($user_groups->count() > 0)
                    @foreach ($user_groups as $group)
                    <div class="row">
                        <div class="col-md-4">
                            <div class="group-icon">
                                <a href="{{url($group->link())}}">
                                    <img style="height:64px; width:64px;" src="{{$group->icon}}">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8" style="padding:0;">
                            <div class="group-name">
                                <a href="{{url($group->link())}}">{{$group->name}}</a>
                            </div>
                            <div class="group-description">
                                {{$group->description}}
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    @endif
                    {{$user_groups->links()}}
                </div>
            </div>
        @else
            <div class="panel panel-default">
                <div class="panel-heading">Featured Groups</div>
                <!-- The 2 groups with largest number of members will be shown here -->
                <div class="panel-body">
                    <div class="group" style="overflow:hidden;">
                        <div style="width:25%; float:left;" class="group-icon">
                            <a href="{{url($featured_group[0]->link())}}">
                            <img style="height:64px; width:64px;" src="{{$featured_group[0]->icon}}">
                            </a>
                        </div>
                        <div style="width:75%; float:right;">
                            <a href="{{url($featured_group[0]->link())}}">{{$featured_group[0]->name}}</a>
                            <div>Members: {{$featured_group[0]->memberCount()}}</div>
                        </div>
                    </div>
                    <div class="group" style="overflow:hidden;">
                        <div style="width:25%; float:left;" class="group-icon">
                            <a href="{{url($featured_group[0]->link())}}">
                            <img style="height:64px; width:64px;" src="{{$featured_group[1]->icon}}">
                            </a>
                        </div>
                        <div style="width:75%; float:right;">
                            <a href="{{url($featured_group[1]->link())}}">{{$featured_group[1]->name}}</a>
                            <div>Members: {{$featured_group[1]->memberCount()}}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        </div>
    </div>
</div>
@endsection
