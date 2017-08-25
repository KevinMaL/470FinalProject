@extends('layouts.admin')

@section('content')
  @foreach ($groups as $group)
    <div>
    <a href="{{'/group/' . $group->id}}">{{$group->name}}</a> |
    <a href="{{'/admin/group/' . $group->id}}">Manage</a>
    </div>
  @endforeach
@endsection
