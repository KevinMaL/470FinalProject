@extends('layouts.app')

@section('headers')
<script>
$(document).ready(function(){
    jQuery('.btn-new-thread').click(function(i,e){
        jQuery('.form-new-post').toggle();
    });

    jQuery('.new-admin-button').click(function(i,e){
        jQuery('.form-new-admin').toggle();
    });

    jQuery('.new-member-button').click(function(i,e){
        jQuery('.form-new-member').toggle();
    });
});
</script>
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
            <div class="panel-heading">Group Posts: {{$group->name}}</div>

                <div class="panel-body">
                    <button type="button" class="btn btn-primary btn-new-thread"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;New Thread</button>
                    <form style="display:none;" action="{{ route('new_post', ['group_id' => request()->segment(2)])}}" method="POST" class="form-horizontal form-new-post">
                        @include('common.errors')
                          {{ csrf_field() }}
                          <div class="form-group">
                                <div class="col-md-10">
                                      <textarea class="form-control" rows="5"  name="post_body"></textarea>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success">
                                      <i class="fa fa-btn fa-mail"></i>Send
                                    </button>
                                </div>
                            </div>
                        </form>
                    <div class="post-list">
                    @foreach($posts as $post)
                        <div class="thread-item">
                            <span>
                                <div class='main-post'><a href="{{$post->getLink()}}">{{$post->post_body}}</a></div>
                                <span>({{$post->reply_count}} replies)</span>
                                <i style="color:red;">new</i>
                            </span>
                            <div>
                            Last Update: {{$post->updated_at}}<br>
                            By <a href="{{$post->getAuthor()->link()}}">{{$post->getAuthor()->name}}</a>
                            </div>
                            <hr>
                        </div>
                    @endforeach
                    {{$posts->appends(['event' => $events->currentPage()])->appends(['member' => $users->currentPage()])->links()}}
                    </div>
                </div>
            </div>
            <!--
            <div class="panel panel-default">
            <div class="panel-heading">Group Blogs: Group Name 1</div>

                <div class="panel-body">
                    <button type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;New Blog</button>
                    <div class="blog-list">
                        <div class="blog-item">
                            <span>
                                <a href="">Blog 1</a>
                            </span>
                            <span style="float:right;">
                            Last Update: {{$time}}<br>
                            By <a href="">Admin</a>
                            </span>
                        </div>
                        <hr>
                        <div class="blog-item">
                            <span>
                                <a href="">The Basic How-tos</a>
                            </span>
                            <span style="float:right;">
                            Last Update: {{$time}}<br>
                            By <a href="">Admin</a>
                            </span>
                        </div>
                        <hr>
                        <div class="blog-item">
                            <span>
                                <a href="">Blog 2</a>
                            </span>
                            <span style="float:right;">
                            Last Update: {{$time}}<br>
                            By <a href="">Admin</a>
                            </span>
                        </div>
                        <hr>
                    </div>
                </div>

            </div>
             -->
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Group Owner</div>
                <div class="panel-body">
                    <div class="user-list" style="display: flex; flex-wrap: wrap; padding-top:15px">
                        <div class="user-list-item" style="flex-grow: 0;width: 33%; text-align:center;">
                            <div>
                            <img src="{{$group->getOwner()->getProfile()->avatar}}" style="width:64px; height:64px;">
                            </div>
                            <a href="{{'/user/' . $group->getOwner()->id}}">{{$group->getOwner()->name}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Group Admins</div>
                <div class="panel-body">
                    @if($group->isAdmin())
                    <button type="button" class="btn btn-primary new-admin-button"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add Admin</button>

                    <form style="display:none;" action="{{ route('new_group_admin', ['group_id' => request()->segment(2)])}}" method="POST" class="form-horizontal form-new-admin">
                        @include('common.errors')
                        {{ csrf_field() }}
                        <div class="form-group">
                                <div class="col-md-12">
                                      <input class="form-control" name="admin_name">
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">
                                      <i class="fa fa-btn fa-check"></i>Submit
                                    </button>
                                </div>
                        </div>
                    </form>
                    @endif
                    <div class="user-list" style="display: flex; flex-wrap: wrap; padding-top:15px">
                        @foreach ($admins as $user)
                        <div class="user-list-item" style="flex-grow: 0;width: 33%; text-align:center;">
                            <div>
                            <img src="{{$user->getProfile()->avatar}}" style="width:64px; height:64px;">
                            </div>
                            <a href="{{'/user/' . $user->id}}">{{$user->name}}</a>
                            <form action="{{ route('remove_group_admin', ['group_id' => $group->id,'user_id' => $user->id])}}" method="POST" class="form-horizontal ">
                                @include('common.errors')
                                {{ csrf_field() }}

                                @if($group->isAdmin())
                                <button type="submit" class="btn btn-danger">
                                  <i class="fa fa-btn fa-times"></i>Revoke
                                </button>

                                @endif
                            </form>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Members</div>
                <div class="panel-body">


                    @if($group->isAdmin())
                    <button type="button" class="btn btn-primary new-member-button"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Invite Member</button>

                    <form style="display:none;" action="{{ route('new_group_member', ['group_id' => request()->segment(2)])}}" method="POST" class="form-horizontal form-new-member">
                        @include('common.errors')
                        {{ csrf_field() }}
                        <div class="form-group">
                                <div class="col-md-12">
                                      <input class="form-control" name="member_name">
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">
                                      <i class="fa fa-btn fa-check"></i>Submit
                                    </button>
                                </div>
                        </div>
                    </form>
                    @endif

                    <div class="user-list" style="display: flex; flex-wrap: wrap; padding-top:15px">
                        @foreach ($users as $user)
                        <div class="user-list-item" style="flex-grow: 0;width: 33%; text-align:center;">
                            <div>
                            <img src="{{$user->getProfile()->avatar}}" style="width:64px; height:64px;">
                            </div>
                            <a href="{{'/user/' . $user->id}}">{{$user->name}}</a>

                            <form action="{{ route('kick_member', ['group_id' => $group->id,'user_id' => $user->id])}}" method="POST" class="form-horizontal ">
                                @include('common.errors')
                                {{ csrf_field() }}

                                @if($group->isAdmin())
                                <button type="submit" class="btn btn-danger">
                                  <i class="fa fa-btn fa-times"></i>Kick
                                </button>

                                @endif
                            </form>

                        </div>
                        @endforeach
                        {{ $users->appends(['post' => $posts->currentPage()])->appends(['event' => $events->currentPage()])->links() }}
                    </div>
                </div>
            </div>
            <!--
            <div class="panel panel-default">

                <div class="panel-heading">Shared Plans</div>
                <div class="panel-body">
                    <button type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add New Plan</button>
                    <div class="plan-list" style="text-align:center;">
                        <div class="plan-item">
                            <div class="plan-title" style="padding:10px;"><a href="">HHIT Training</a></div>
                            <button type="button" class="btn btn-secondary"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;Add to Calendar</button>
                            <button type="button" class="btn btn-primary"><i class="fa fa-thumbs-up aria-hidden="true"></i>&nbsp;Like</button>
                        </div>
                        <div class="plan-item">
                            <div class="plan-title" style="padding:10px;"><a href="">Weight Losing</a></div>
                            <button type="button" class="btn btn-secondary"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;Add to Calendar</button>
                            <button type="button" class="btn btn-primary"><i class="fa fa-thumbs-up aria-hidden="true"></i>&nbsp;Like</button>
                        </div>
                        <div class="plan-item">
                            <div class="plan-title" style="padding:10px;"><a href="">Body Building</a></div>
                            <button type="button" class="btn btn-secondary"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;Add to Calendar</button>
                            <button type="button" class="btn btn-primary"><i class="fa fa-thumbs-up aria-hidden="true"></i>&nbsp;Like</button>
                        </div>
                    </div>
                </div>
            </div>
            -->
            <div class="panel panel-default">
                <div class="panel-heading">Event List</div>
                <div class="panel-body">
                    @foreach($events as $event)
                    <div class=event" style="padding:20px; text-align:center;">
                        <img style="float:left;height:36px; width:36px;" src="/assets/images/calendar.png">
                        <div><a href="{{$event->getLink()}}">{{$event->title}}</a></div>
                        <div style="font-style:italic;">Time: {{$event->event_start}}</div>
                        <div><i class="fa fa-map-marker" aria-hidden="true"></i><a href="{{$event->getLink()}}">&nbsp;{{$event->address}}</a></div>


                         @if(!$event->hasMe())
                        <form action="{{ route('add_me_to_event', $event->id) }}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Sign Me Up</button>
                        </form>

                        @else
                        <form action="{{ route('remove_me_from_event', $event->id) }}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Remove Me From List</button>
                        </form>

                        @endif
                    </div>
                    <hr>
                    @endforeach
                    {{$events->appends(['member' => $users->currentPage()])->appends(['post' => $posts->currentPage()])->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
