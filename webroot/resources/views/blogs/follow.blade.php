<div class="follow">
    <a href="{{ route('followings', $user->id) }}">
        <strong id="following" class="blog">
            {{ count($user->followings) }}
        </strong>
        followings
    </a>
    <a href="{{ route('followers', $user->id) }}">
        <strong id="followers" class="blog">
            {{ count($user->followers) }}
        </strong>
        fans
    </a>
    <a href="{{ route('blog', $user->id) }}">
        <strong id="blogs" class="blog">
            {{ $user->blogs()->count() }}
        </strong>
        blog
    </a>
</div>