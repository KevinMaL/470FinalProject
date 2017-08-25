<li id="blog-{{ $blog->id }}">

    <a href="{{ route('blog', $user->id )}}">
        <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="gravatar"/>
    </a>

    <span class="user">
        <a href="{{ route('blog', $user->id )}}">{{ $user->name }}</a>
    </span>

    <span class="timestamp">
        {{ $blog->created_at->diffForHumans() }}
    </span>

    <span class="content">{{ $blog->content }}</span>

    @can('destroy', $blog)
        <form action="{{ route('blog.destroy', $blog->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-sm btn-danger blog-delete-btn">Delete</button>
        </form>
    @endcan
</li>