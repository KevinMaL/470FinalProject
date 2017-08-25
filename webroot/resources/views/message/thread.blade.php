@extends('layouts.app')

@section('headers')

@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
            <div class="panel-heading">Conversation with {{$sender['name']}}</div>

                <div class="panel-body" style="height:400px; overflow-y:scroll;">
                @foreach ($thread as $message)
                    <div class="message {{$message['receive'] ? 'receive' : 'send'}}">
                        <div class="avatar">
                            <img src="{{$message['avatar']}}">
                        </div>
                        <div class="name">
                        {{$message['name']}}
                        </div>
                        <div class="message-body">
                        {{$message['message_body']}}
                        <br>
                        <i>{{$message['created_at']}}&nbsp;<span class="new-message {{$message['has_read'] ? 'read' : 'new'}}">new</span></i>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
            @include('common.errors')
            <form action="{{ route('send_message', ['to_uid' => request()->segment(4)])}}" method="POST" class="form-horizontal">
              {{ csrf_field() }}
              <div class="form-group">
                    <div class="col-md-10">
                          <textarea class="form-control" rows="5"  name="message_body"></textarea>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success">
                          <i class="fa fa-btn fa-mail"></i>Send
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
            <div class="panel-heading">Actions</div>
            <div class="panel-body">
                    <form action="{{ route('remove_thread',['to_uid' => request()->segment(4)])}}" method="POST" class="form-horizontal">
                     {{ csrf_field() }}


                    <button type="submit" class="btn btn-danger">
                    <i class="fa fa-btn fa-trash-o"></i>Remove Thread
                    </button>

                    </form>

                </div>
        </div>
    </div>
</div>

@endsection
