@extends('layouts.app')

@section('headers')

@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">

            @if($messages->count() == 0)
                No unread Messages.
            @endif
            @foreach ($messages as $key => $message)
            <div class="panel panel-default">
            <div class="panel-heading">Message From {{$senders[$key]['name']}}
                <a href='/user/message/thread/{{$message["sender_id"]}}'>
                <button type="button" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;view</button>
                </a>
            </div>
                <div class="panel-body">
                    <div class="message">
                        <div class="avatar">
                            <img src="{{$senders[$key]['avatar']}}">
                        </div>
                        <div class="name">
                        {{$senders[$key]['name']}}
                        </div>
                        <div class="message-body">
                        {{$message['message_body']}}
                        <br>
                        <i>{{$message['created_at']}}&nbsp;<span class="new-message new">new</span></i>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {{ $messages->links() }}
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
