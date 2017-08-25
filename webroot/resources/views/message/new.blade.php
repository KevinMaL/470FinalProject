@extends('layouts.app')

@section('headers')

@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
            <div class="panel-heading">New Message</div>



                @include('common.errors')
                <form action="{{ route('send_new_message')}}" method="POST" class="form-horizontal">
                  {{ csrf_field() }}
                  <div class="form-group">
                        <div class="col-md-12">
                        <label>Send to:</label>
                            <input name="target_name">
                        </div>
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
        </div>
    </div>
</div>

@endsection
