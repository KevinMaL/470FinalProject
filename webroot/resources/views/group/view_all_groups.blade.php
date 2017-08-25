@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">All Groups</div>

                <div class="panel-body">
                    @foreach ($groups as $group)
                    <div class="row">
                        <div class="col-md-2">
                            <div class="group-icon">
                                <a href="{{url($group->link())}}">
                                    <img style="height:64px; width:64px;" src="{{$group->icon}}">
                                </a>
                            </div>
                            Admins:
                            <div class="group-admin">
                                @if($group->getAdmins()->count() == 0)
                                    There is no admin in the group.
                                @endif
                                @foreach ($group->getAdmins()->get() as $admin)
                                <a href="{{ url($admin->link())}}">{{$admin->name}}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-10" style="padding:0;">
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
                    {{$groups->appends(['my_group' => $user_groups->currentPage()])->links()}}
                </div>
            </div>

        </div>
        <div class="col-md-4">

        @if (Auth::check())
           <div class="panel panel-default">
                <div class="panel-heading">My Groups</div>

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
                    {{$user_groups->appends(['group' => $groups->currentPage()])->links()}}
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
