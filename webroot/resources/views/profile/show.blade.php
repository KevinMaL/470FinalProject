@extends('layouts.app')

@section('headers')
  @include('common.calendar')
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
            <div class="panel-heading">Profile: {{$user->name}}</div>

                <div class="panel-body">
                    Email: {{$user->email}}
                    <div>
                    <img style="width:64px; height:64px;" src="{{$user->getProfile()->avatar}}">
                    {{$user->getProfile()->bio}}
                  </div>
                </div>
            </div>
            <div class="panel panel-default">
            <div class="panel-heading">Calendar</div>

                <div class="panel-body">
                   {!! $calendar->calendar() !!}
                   {!! $calendar->script() !!}
                </div>
            </div>
        </div>

        <div class="col-md-4">
            @if( request()->segment(2) == "me")
            <div class="panel panel-default">
                <div class="panel-heading">Actions</div>
                <div class="panel-body">
                    <a href="/user/me/edit">
                        <button class="btn btn-danger"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Edit Profile</button>
                    </a>
                </div>
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Event List</div>
                <div class="panel-body">
                    @foreach($event_list as $event)
                    <div class=event" style="padding:20px; text-align:center;">
                        <img style="float:left;height:36px; width:36px;" src="/assets/images/calendar.png">
                        <div><a href="{{$event->getLink()}}">{{$event->title}}</a></div>
                        <div style="font-style:italic;">Time: {{$event->event_start}}</div>
                        <div><i class="fa fa-map-marker" aria-hidden="true"></i><a href="{{$event->getLink()}}">&nbsp;{{$event->address}}</a></div>
                        @if( request()->segment(2) == "me")
                        <form action="{{ route('remove_me_from_event', $event->id) }}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Remove Me From List</button>
                        </form>
                        @endif
                    </div>
                    <hr>
                    @endforeach
                    {{$event_list->appends(['group' => $user_groups->currentPage()])->links()}}
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Groups</div>
                <div class="panel-body">
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
                    {{$user_groups->appends(['event' => $event_list->currentPage()])->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
