@extends('layouts.app')

@section('content')
<div>
  {{$group->name}}
</div>


<div>
  {{$members->count()}}
</div>


@foreach ($members as $member)
<div>
  <a href="{{'/user/' . $member->user_id}}">{{$member->user->name}}</a>
</div>
@endforeach
@endsection
