@extends('layouts.app')

@section('headers')
<script>
$(document).ready(function(){
    jQuery('.post-link a').click(function(i,e){
        $(this).parent().parent().find('.form-post-reply').toggle();
    });
});
</script>

@endsection


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Post Thread</div>

                <div class="panel-body">
                    @foreach ($posts as $post)

                    <div class="post-indentation" style="position:relative;  ">
                        <div class="text" style="border:1px solid #aaa; margin-top: -1px;margin-left:{{$post->node_depth * 5 + 20 }}px; padding: 10px 0 10px 20px;">
                            <div class="post-body">
                            {{$post->post_body}}
                            </div>
                            <div class="post-time">
                            Posted at: {{$post->created_at}}
                            </div>
                            <div class="post-author">
                            By: <a href="{{$post->getAuthor()->link()}}">{{$post->getAuthor()->name}}</a>
                            </div>
                            <div class="post-link">
                                <a href="#reply-post">Reply</a>
                            </div>

                            <form style="display:none;" action="{{ route('reply_post', ['target_id' => $post->id,'group_id' => request()->segment(2)])}}" method="POST" class="form-horizontal form-post-reply">
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
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

        </div>

    </div>
</div>
@endsection
