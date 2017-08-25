@if (count($feed_items))
    <ol class="blogs">
        @foreach ($feed_items as $blog)
            @include('blogs._blog', ['user' => $blog->user])
        @endforeach
        {!! $feed_items->render() !!}
    </ol>
@endif