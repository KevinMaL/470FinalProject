@extends('layouts.app')

@section('headers')

@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @foreach ($threads as $thread)
            <div class="panel panel-default">
            @if (Auth::user()->id == $thread[0]["receiver_id"])
            <div class="panel-heading">Conversation with {{$thread[0]['name']}}
            <a href='/user/message/thread/{{$thread[0]["sender_id"]}}'>
            @else
            <div class="panel-heading">Conversation with {{$thread[0]['other_name']}}
            <a href='/user/message/thread/{{$thread[0]["receiver_id"]}}'>
            @endif
            <button type="button" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;view</button>
            </a>
            </div>

                <div class="panel-body">
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
            @endforeach
            {{ $threads->links() }}
        </div>


        <div class="col-md-4">
            <div class="panel panel-default">
              <div class="panel-heading">Actions</div>
                <div class="panel-body">
                    <form action="{{ route('read_all_message')}}" method="POST" class="form-horizontal">
                     {{ csrf_field() }}


                    <button type="submit" class="btn btn-success">
                    <i class="fa fa-btn fa-check"></i>Set all to Read
                    </button>

                    </form>

                    <hr>
                    <a href= "{{ route('new_message')}}">
                    <button type="submit" class="btn btn-success">
                    <i class="fa fa-btn fa-plus"></i>New Message
                    </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
